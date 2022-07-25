Feature: Logout

    I want to Logout from the application

    Scenario: Logout from the application
        Given I click on the logout button
        Then I should see the login page
        And I should see the message "You have been logged out"




