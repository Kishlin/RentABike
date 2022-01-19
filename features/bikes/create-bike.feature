Feature: Create a bike

  Scenario: the bike is created
    When a client creates a bike
    Then the bike should be persisted
