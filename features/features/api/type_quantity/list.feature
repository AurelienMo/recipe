@api
@api_type_quantity
@api_type_quantity_list

Feature: I need to be able to get list type quantity

  Background:
    Given I load following file "products/list.yml"
    And I load following file "security/user.yml"

  Scenario: [Fail] Forbidden access
    When I send a "GET" request to "/api/types-quantity"
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé à accéder à cette information."

  Scenario: [Success] List type quantity
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/types-quantity" with body:
    """
    {
    }
    """
    Then the response status code should be 200
    And the JSON node "root" should have 9 elements