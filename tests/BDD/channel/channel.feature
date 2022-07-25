Feature: Kelola channel

    I want to manage channel

    Scenario: Create channel
        Given I want to create channel
        When I fill the form with valid data
        Then I should see the channel created successfully
        And I should see the channel in the list

    Scenario: Failed create channel, field empty
        Given I want to create channel
        When I fill the form with invalid data
        Then I should see the channel failed to create
        And I should see the error message
        And I should not see the channel in the list

    Scenario: import channel data with excel
        Given I want to import channel data with excel
        When I fill the form with valid data
        Then I should see the channel imported successfully
        And I should see the channel in the list
        And I should see the channel in the list with the imported data

    Scenario: Failed import channel data with excel, field empty
        Given I want to import channel data with excel
        When I fill the form with invalid data
        Then I should see the channel failed to import
        And I should see the error message
        And I should not see the channel in the list
        And I should not see the channel in the list with the imported data

    Scenario: search channel data
        Given I want to search channel data
        When I fill the form with valid data
        Then I should see the channel data

