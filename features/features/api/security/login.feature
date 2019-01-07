@api
@api_security

Feature: As an anonymous user, I need to be able to obtain token to authenticate on API

  Background:
    Given I load following file "security/user.yml"

  Scenario: [Success] Obtain Bearer token
    When Send auth request with method "POST" request to "/api/login_check" with username "johndoe" and password "12345678"
    Then the response status code should be 200
    And the JSON node "token" should exist
    And the JSON node "user.firstname" should be equal to "John"
    And the JSON node "user.lastname" should be equal to "Doe"
    And the JSON node "user.email" should be equal to "johndoe@yopmail.com"
    And the JSON node "user.roles" should have 1 element
    And the JSON node "user.group" should be null

  Scenario: [Fail] Fail auth with invalid credentials
    When Send auth request with method "POST" request to "/api/login_check" with username "janedoe" and password "123456789"
    Then the response status code should be 401
    And the JSON node "code" should be equal to "401"
    And the JSON node "message" should be equal to "Identifiants invalides. Merci de vérifier votre identifiant et mot de passe."

  Scenario: [Success] Obtain Bearer token
    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
    When Send auth request with method "POST" request to "/api/login_check" with username "johndoe" and password "12345678"
    Then the response status code should be 200
    And the JSON node "token" should exist
    And the JSON node "user.roles" should have 2 element
    And the JSON node "user.group" should not be null
    And the JSON node "user.group.name" should be equal to "Group John Doe"