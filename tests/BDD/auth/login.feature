Feature: login

    I want to login to the application

    Scenario: Login to the application
      Given I am on the login page
      When I enter my username and password
      Then I should be logged in
      And I should see my dashboard

    Scenario: Login to the application with invalid credentials
      Given I am on the login page
      When I enter my username and invalid password
      Then I should not be logged in
      And I should see an error message
      And I should see the login page again

