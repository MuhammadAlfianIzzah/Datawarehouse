Feature: Register

    I want to register a new user

    Scenario: Register a new user
        Given I am on the register page
        When I fill in the form with valid information
        And I press register
        Then I should be logged in
        And I should see a success message

    Scenario: Register a new user with an existing email
        Given I am on the register page
        When I fill in the form with an existing email
        And I press register
        Then I should see an error message
        And I should not be logged in
        And I should see a failure message

    Scenario: Register failed, field empty
        Given I am on the register page
        When I fill in the form with an empty field
        And I press register
        Then I should not be registered
        And I should see an error message
        And I should see a failure message
