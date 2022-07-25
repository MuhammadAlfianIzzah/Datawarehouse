Feature: Kelola brand

    I want to manage brand

    Scenario: Create brand
        Given I want to create brand
        When I fill the form with valid data
        Then I should see the brand created successfully
        And I should see the brand in the list

    Scenario: Failed create brand, field empty
        Given I want to create brand
        When I fill the form with invalid data
        Then I should see the brand failed to create
        And I should see the error message
        And I should not see the brand in the list

    Scenario: import brand data with excel
        Given I want to import brand data with excel
        When I fill the form with valid data
        Then I should see the brand imported successfully
        And I should see the brand in the list
        And I should see the brand in the list with the imported data

    Scenario: Failed import brand data with excel, field empty
        Given I want to import brand data with excel
        When I fill the form with invalid data
        Then I should see the brand failed to import
        And I should see the error message
        And I should not see the brand in the list
        And I should not see the brand in the list with the imported data

    Scenario: Get brand data
        Given I want to get brand data
        When I fill the form with valid data
        Then I should see the brand data
        And I should see the brand in the list

    Scenario: search Brand data
        Given I want to search brand data
        When I fill the form with valid data
        Then I should see the brand data
