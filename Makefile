include .env
-include .env.local

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

CACHE=composer-cache composer node-cache node
VOL_CACHE?=$(shell docker volume inspect -f '{{ index .Mountpoint }}' cache)

# Env
.env.local:
	@touch .env.local

# 🐘 Composer
.PHONY: composer-install
composer-install: CMD=install

.PHONY: composer-update
composer-update: CMD=update

.PHONY: composer-require
composer-require: CMD=require
composer-require: INTERACTIVE=-ti --interactive

.PHONY: composer-require-module
composer-require-module: CMD=require $(module)
composer-require: INTERACTIVE=-ti --interactive

.PHONY: composer
composer-install composer-update composer-require composer-require-module: .env.local .docker-cache
	@docker run --rm $(INTERACTIVE) --volume $(current-dir):/app --user $(id -u):$(id -g) \
		composer:2 $(CMD) \
			--ignore-platform-reqs \
			--no-ansi

##> Project
docker-compose.yaml:
	@cp docker-compose.yaml.dist docker-compose.yaml
	@sed -i "s/<DOCKER_USER_ID>/$(shell $(shell echo id -u ${USER}))/g" $@
	@sed -i "s/<DOCKER_USER>/$(shell echo ${USER})/g" $@

.docker-cache:
	@touch .docker-cache
	@docker volume create --name=cache;

vendor: composer-install

cache: $(CACHE)
$(CACHE): .docker-cache
	@if [ ! -d "$(VOL_CACHE)/$@" ]; then \
	sudo mkdir -pm 777 $(VOL_CACHE)/$@; \
	fi;

.INTERMEDIATE: .docker-cache

.PHONY: help setup start stop clean

help:
	@echo "Run make start_working"

setup: .env.local docker-compose.yaml vendor

start: setup $(CACHE)
	@docker-compose up -d --remove-orphans
	@echo "All services should be running"
	@echo "    Rent A Bike backend: http://localhost:8030/monitoring/check-health"
	@echo "    Backoffice  backend: http://localhost:8040/monitoring/check-health"
	@echo "Ports may differ if overridden in the .env.local file."

stop:
	@docker-compose down

clean:
	@if [ -f "./docker-compose.yaml" ]; then \
		docker-compose down; \
	fi;
	@sudo rm -rf docker-compose.yaml vendor

##> Helpers
.PHONY: db.connect tests.usecases tests.src.isolated tests.src.contract tests.src tests
.PHONY: tests.backoffice tests.backoffice.driving tests.backoffice.functional tests.backoffice.integration
.PHONY: tests.rentabike tests.rentabike.functional tests.rentabike.integration

db.connect:
	@docker-compose exec postgres /bin/bash -c 'psql -U $$POSTGRES_USER'

tests.usecases:
	@echo "Running Use Case Tests for src/"
	@docker-compose exec backoffice-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/behat --config /rentabike/behat-config.yml --suite use_case_tests
	@echo ""

tests.src.isolated:
	@echo "Running Isolated Tests for the src/ folder"
	@docker-compose exec rentabike-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/phpunit.xml --testsuite isolated
	@echo ""

tests.src.contract:
	@echo "Running Contract Tests for the src/ folder"
	@docker-compose exec rentabike-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/phpunit.xml --testsuite contract
	@echo ""

tests.src: tests.src.isolated tests.src.contract

tests.backoffice.driving:
	@echo "Running Driving Tests for the Backoffice App"
	@rm -rf apps/backoffice/backend/var/cache/test
	@docker-compose exec backoffice-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/apps/backoffice/backend/phpunit.xml --testsuite driving
	@echo ""

tests.backoffice.functional:
	@echo "Running Functional Tests for the Backoffice App"
	@rm -rf apps/backoffice/backend/var/cache/test
	@docker-compose exec backoffice-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/apps/backoffice/backend/phpunit.xml --testsuite functional
	@echo ""

tests.backoffice.integration:
	@echo "Running Integration Tests for the Backoffice App"
	@rm -rf apps/backoffice/backend/var/cache/test
	@docker-compose exec backoffice-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/apps/backoffice/backend/phpunit.xml --testsuite integration
	@echo ""

tests.backoffice: tests.backoffice.driving tests.backoffice.functional tests.backoffice.integration

tests.rentabike.functional:
	@echo "Running Functional Tests for the Rent A Bike App"
	@rm -rf apps/backoffice/rentabike/var/cache/test
	@docker-compose exec rentabike-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/apps/rentabike/backend/phpunit.xml --testsuite functional
	@echo ""

tests.rentabike.integration:
	@echo "Running Integration Tests for the Rent A Bike App"
	@rm -rf apps/backoffice/rentabike/var/cache/test
	@docker-compose exec rentabike-backend php -d xdebug.mode=off \
		/rentabike/vendor/bin/phpunit -c /rentabike/apps/rentabike/backend/phpunit.xml --testsuite integration
	@echo ""

tests.rentabike: tests.rentabike.functional tests.rentabike.integration

tests: tests.usecases tests.src tests.backoffice tests.rentabike