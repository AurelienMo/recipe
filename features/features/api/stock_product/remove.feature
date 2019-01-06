@api
@api_stock_product
@api_stock_product_delete

Feature: As ROLE_GROUP_MODERATOR, I need to be able to remove completely a product from stock
  Background:
    Given I load following user:
      | firstname      | lastname | username | email               | password | role                 |
      | John           | Doe      | johndoe  | johndoe@yopmail.com | 12345678 | ROLE_GROUP_OWNER     |
      | Jane           | Doe      | janedoe  | janedoe@yopmail.com | 12345678 | ROLE_SUPER_ADMIN     |
      | Foo            | Bar      | foobar   | foobar@yopmail.com  | 12345678 | ROLE_GROUP_MODERATOR |
      | Bar            | Foo      | barfoo   | barfoo@yopmail.com  | 12345678 | ROLE_GROUP_MEMBER    |
    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
      | Group Jane Doe | janedoe |
    And I load following file "products/list.yml"
    And I add following member to group:
      | username | group          |
      | foobar   | Group John Doe |
      | barfoo   | Group John Doe |
  Scenario: [Fail] Try to remove a product from stock with anonymous user
    When I send a "DELETE" request to "/api/groups/1/stock-product/1"
    Then the response status code should be 401
    And the JSON node "message" should be equal to "Merci de vous authentifier."

  Scenario: [Fail] Try to remove a product on not existing group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/5/stock-product/1" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Le groupe n'existe pas."

  Scenario: [Fail] Submit request with wrong user for a given group
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "DELETE" request to "/api/groups/1/stock-product/1" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé aux informations de ce groupe"

  Scenario: [Fail] Try to remove a not existing stock product
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "DELETE" request to "/api/groups/1/stock-product/10" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Ce produit n'est pas présent dans votre stock."

  Scenario: [Fail] Try to remove a stock product of another my group
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "DELETE" request to "/api/groups/2/stock-product/1" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Le stock de ce produit n'appartient pas à votre groupe."

  Scenario: [Fail] Try to remove a stock product with insufficient permissions. ROLE_GROUP_MEMBER
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "barfoo" with password "12345678", I send a "DELETE" request to "/api/groups/1/stock-product/1" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'avez pas les droits suffisants pour supprimer le produit du stock"

  Scenario: [Success] Successful remove a product with ROLE_GROUP_OWNER
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "DELETE" request to "/api/groups/1/stock-product/1" with body:
    """
    """
    Then the response status code should be 204
    And the response should be empty

  Scenario: [Success] Successful remove a product with ROLE_GROUP_OWNER
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "foobar" with password "12345678", I send a "DELETE" request to "/api/groups/1/stock-product/1" with body:
    """
    """
    Then the response status code should be 204
    And the response should be empty