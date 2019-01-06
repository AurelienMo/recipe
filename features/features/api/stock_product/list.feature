@api
@api_stock_product
@api_stock_product_list

Feature: I need to be able to get list stock product for my group

  Background:
    Given I load following file "security/user.yml"
    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
    And I load following file "products/list.yml"

  Scenario: [Fail] Submit request without authentication
    When I send a "GET" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 401

  Scenario: [Fail] Submit request with a wrong user for the given group
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "GET" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé aux informations de ce groupe"

  Scenario: [Fail] Submit request on not found group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/groups/5/stock-product" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Le groupe n'existe pas."


  Scenario: [Success] Submit request & return no datas
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 204
    And the response should be empty

  Scenario: [Success] Submit request & return datas according type product filter
    And I load following stock product:
    | group          | quantity | product          |
    | Group John Doe | 10       | Product 1        |
    | Group John Doe | 1        | Product 6       |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/groups/1/stock-product?typesProduct=2" with body:
    """
    """
    Then the response status code should be 200
    And the JSON node "root" should have 1 element
    And the JSON should be equal to:
    """
    [
        {
            "id": 2,
            "product": {
                "id": 6,
                "name": "Product 6",
                "slug": "product-6",
                "typeProduct": 2,
                "typeQuantity": 2
            },
            "quantity": 1
        }
    ]
    """
  Scenario: [Success] Submit request & return datas without type product filter
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 10       | Product 1        |
      | Group John Doe | 1        | Product 6       |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 200
    And the JSON node "root" should have 2 elements
    And the JSON should be equal to:
    """
    [
        {
            "id": 1,
            "product": {
                "id": 1,
                "name": "Product 1",
                "slug": "product-1",
                "typeProduct": 1,
                "typeQuantity": 9
            },
            "quantity": 10
        },
        {
            "id": 2,
            "product": {
                "id": 6,
                "name": "Product 6",
                "slug": "product-6",
                "typeProduct": 2,
                "typeQuantity": 2
            },
            "quantity": 1
        }
    ]
    """