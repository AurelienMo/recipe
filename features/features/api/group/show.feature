@api
@api_group
@api_group_show

Feature: As an auth user, I need to be able to get group information
  Background:
    Given I load following user:
      | firstname      | lastname | username | email               | password | role                 |
      | John           | Doe      | johndoe  | johndoe@yopmail.com | 12345678 | ROLE_GROUP_OWNER     |
      | Jane           | Doe      | janedoe  | janedoe@yopmail.com | 12345678 | ROLE_SUPER_ADMIN     |
      | Foo            | Bar      | foobar   | foobar@yopmail.com  | 12345678 | ROLE_GROUP_MEMBER    |
      | Bar            | Foo      | barfoo   | barfoo@yopmail.com  | 12345678 | ROLE_GROUP_MEMBER    |

    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
      | Group John Doe | foobar  |
    And I add following member to group:
      | username | group          |
      | foobar   | Group John Doe |

  Scenario: [Fail] Try to get group informations with an anonymous user
    When I send a "GET" request to "/api/groups/1"
    Then the response status code should be 401
    And the JSON node "message" should be equal to "Merci de vous authentifier."

  Scenario: [Fail] Try to get group informations with invalid group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/groups/4" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Le groupe n'existe pas."

  Scenario: [Fail] Try to get group informations with user not attached to group
    When After authentication on url "/api/login_check" with method "POST" as user "barfoo" with password "12345678", I send a "GET" request to "/api/groups/1" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé aux informations de ce groupe"

  Scenario: [Success] Obtain group informations with user in group
    When After authentication on url "/api/login_check" with method "POST" as user "foobar" with password "12345678", I send a "GET" request to "/api/groups/1" with body:
    """
    """
    Then the response status code should be 200
    And the JSON node "id" should be equal to 1
    And the JSON node "name" should be equal to "Group John Doe"
    And the JSON node "slug" should be equal to "group-john-doe"
    And the JSON node "owner" should not be null
    And the JSON node "members" should have 2 elements

  Scenario: [Success] Obtain group informations with user as ROLE_SUPER_ADMIN
  Scenario: [Success] Obtain group informations with user in group
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "GET" request to "/api/groups/1" with body:
    """
    """
    Then the response status code should be 200
    And the JSON node "id" should be equal to 1
    And the JSON node "name" should be equal to "Group John Doe"
    And the JSON node "slug" should be equal to "group-john-doe"
    And the JSON node "owner" should not be null
    And the JSON node "members" should have 2 elements