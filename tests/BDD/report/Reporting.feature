Feature: reporting

    I want to reporting data

    Scenario: reporting data by brand
        Given visit the reporting page
        When I select the year
        Then I should see the data for that year
        And I should see the data for that year in the table

    Scenario: Export data reporting by year
        Given visit the reporting page
        When I select the year
        Then I should see the data for that year
        And I should see the data for that year in the table
        When I click the export button
        Then I should see the data for that year in the export file

    Scenario: reporting data by brand
        Given visit the reporting page
        When I select the brand
        Then I should see the data for that brand
        And I should see the data for that brand in the table

    Scenario: Export data reporting by brand
        Given visit the reporting page
        When I select the brand
        Then I should see the data for that brand
        And I should see the data for that brand in the table
        When I click the export button
        Then I should see the data for that brand in the export file

    Scenario: reporting data by channel
        Given visit the reporting page
        When I select the channel
        Then I should see the data for that channel
        And I should see the data for that channel in the table

    Scenario: Export data reporting by channel
        Given visit the reporting page
        When I select the channel
        Then I should see the data for that channel
        And I should see the data for that channel in the table
        When I click the export button
        Then I should see the data for that channel in the export file
