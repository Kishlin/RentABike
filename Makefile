include .env
-include .env.local

CACHE=composer-cache composer node-cache node
VOL_CACHE?=$(shell docker volume inspect -f '{{ index .Mountpoint }}' cache)

.env.local:
	@touch .env.local

docker-compose.yaml:
	@cp docker-compose.yaml.dist docker-compose.yaml
	@sed -i "s/<DOCKER_USER_ID>/$(shell $(shell echo id -u ${USER}))/g" $@
	@sed -i "s/<DOCKER_USER>/$(shell echo ${USER})/g" $@
	@sed -i 's/<REMOTE_HOST>/$(shell hostname -I | grep -Eo "192\.168\.[0-9]{,2}\.[0-9]+" | head -1)/g' $@

api/.env:
	@cp api/.sample-env api/.env

.docker-cache:
	@touch .docker-cache
	@docker volume create --name=cache;

cache: $(CACHE)
$(CACHE): .docker-cache
	@if [ ! -d "$(VOL_CACHE)/$@" ]; then \
	sudo mkdir -pm 777 $(VOL_CACHE)/$@; \
	fi;

.INTERMEDIATE: .docker-cache

.PHONY: help setup start stop

help:
	@echo "Run make install"

setup: .env.local docker-compose.yaml api/.env

start: setup $(CACHE)
	@docker-compose pull --ignore-pull-failures --quiet &>/dev/null
	@docker-compose up -d --remove-orphans

start_working: start
	@docker-compose exec php composer install

stop:
	@docker-compose down

.PHONY: db.connect php.bash clean

db.connect:
	@docker-compose exec postgres /bin/bash -c 'psql -U $$POSTGRES_USER'

php.bash:
	@docker-compose exec php /bin/bash

clean:
	@if [ -f "./docker-compose.yaml" ]; then \
		docker-compose down; \
	fi;
	@rm -rf docker-compose.yaml api/.env api/var/* api/vendor
