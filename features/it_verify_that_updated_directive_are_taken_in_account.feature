Feature: It verify that the updated directive are taken into account.

    Scenario: Test

    Given I am on "/memory_limit"
    Then I should see "1234M"

    Given I am on "/max_execution_time"
    Then I should see "123456"
