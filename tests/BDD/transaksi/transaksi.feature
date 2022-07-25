Feature: Kelola transaksi

    I want to manage transaksi

    Scenario: Create transaksi
        Given I want to create transaksi
        When I fill the form with valid data
        Then I should see the transaksi created successfully
        And I should see the transaksi in the list

    Scenario: Failed create transaksi, field empty
        Given I want to create transaksi
        When I fill the form with invalid data
        Then I should see the transaksi failed to create
        And I should see the error message
        And I should not see the transaksi in the list

    Scenario: import transaksi data with excel
        Given I want to import transaksi data with excel
        When I fill the form with valid data
        Then I should see the transaksi imported successfully
        And I should see the transaksi in the list
        And I should see the transaksi in the list with the imported data

    Scenario: Failed import transaksi data with excel, field empty
        Given I want to import transaksi data with excel
        When I fill the form with invalid data
        Then I should see the transaksi failed to import
        And I should see the error message
        And I should not see the transaksi in the list
        And I should not see the transaksi in the list with the imported data

    Scenario: Get Detail transaksi data
        Given I want to get transaksi data
        When I fill the form with valid data
        Then I should see the transaksi data
        And I should see the transaksi in the list

    Scenario: search transaksi data
        Given I want to search transaksi data
        When I fill the form with valid data
        Then I should see the transaksi data
