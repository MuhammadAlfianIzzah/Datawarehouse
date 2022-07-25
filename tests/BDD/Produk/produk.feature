Feature: Kelola produk

    I want to manage produk

    Scenario: Create produk
        Given I want to create produk
        When I fill the form with valid data
        Then I should see the produk created successfully
        And I should see the produk in the list

    Scenario: Failed create produk, field empty
        Given I want to create produk
        When I fill the form with invalid data
        Then I should see the produk failed to create
        And I should see the error message
        And I should not see the produk in the list

    Scenario: import produk data with excel
        Given I want to import produk data with excel
        When I fill the form with valid data
        Then I should see the produk imported successfully
        And I should see the produk in the list
        And I should see the produk in the list with the imported data

    Scenario: Failed import produk data with excel, field empty
        Given I want to import produk data with excel
        When I fill the form with invalid data
        Then I should see the produk failed to import
        And I should see the error message
        And I should not see the produk in the list
        And I should not see the produk in the list with the imported data

    Scenario: Get produk data
        Given I want to get produk data
        When I fill the form with valid data
        Then I should see the produk data
        And I should see the produk in the list

    Scenario: search produk data
        Given I want to search produk data
        When I fill the form with valid data
        Then I should see the produk data
