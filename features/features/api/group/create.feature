@api
@api_group
@api_group_create

Feature: I need to be able to create a group

  Background:
    Given I load following file "security/user.yml"
    And I load following group:
    | name           | owner   |
    | Group John Doe | johndoe |

  Scenario: [Fail] Submit request without authentication
    When I send a "POST" request to "/api/groups" with body:
    """
    {
        "name": "Groupe Test"
    }
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to the string "Vous n'êtes pas autorisé à accéder à cette information."

  Scenario: [Fail] Submit request with existing groupe name
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "POST" request to "/api/groups" with body:
    """
    {
        "name": "Group John Doe"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "": [
            "Ce nom de groupe est indisponible."
        ]
    }
    """

  Scenario: [Fail] Submit request with user attached a group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups" with body:
    """
    {
        "name": "Group 2 John Doe"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
          "owner": [
              "Vous êtes déjà attaché à un groupe."
          ]
      }
    """

  Scenario: [Success] Submit request with good datas & empty group
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "POST" request to "/api/groups" with body:
    """
    {
        "name": "Group Jane Doe"
    }
    """
    Then the response status code should be 201
    And the JSON should be equal to:
    """
    {
        "id": 2,
        "name": "Group Jane Doe",
        "slug": "group-jane-doe",
        "owner": {
            "id": 2,
            "firstname": "Jane",
            "lastname": "Doe",
            "roles": [
                "ROLE_SUPER_ADMIN",
                "ROLE_GROUP_OWNER"
            ]
        },
        "members": [
            {
                "id": 2,
                "firstname": "Jane",
                "lastname": "Doe",
                "roles": [
                    "ROLE_SUPER_ADMIN",
                    "ROLE_GROUP_OWNER"
                ]
            }
        ]
    }
    """