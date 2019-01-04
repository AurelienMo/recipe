@api
@api_products
@api_products_update

Feature: I need to be able to request an update on product

  Background:
    Given I load following file "products/add.yml"
    And I load following file "security/user.yml"

  Scenario: [Fail] Submit request to update product with invalid typeProduct & invalid typeQuantity
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/products/1" with body:
    """
    {
        "typeProduct": 900,
        "typeQuantity": 400
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "typeProduct": [
            "Cette catégorie de produit n'existe pas."
        ],
        "typeQuantity": [
            "Ce type de conditionnement n'existe pas ou n'est pas disponible pour ce produit."
        ]
    }
    """

  Scenario: [Fail] Submit request to update on invalid product
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/products/49" with body:
    """
    {
        "name": "Product 49"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "productId": [
            "Le produit demandé n'existe pas."
        ]
    }
    """

  Scenario: [Success] Submit request to update product with name only
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/products/1" with body:
    """
    {
        "name": "Product updated"
    }
    """
    Then the response status code should be 200
    And the JSON should be equal to:
    """
    {
        "id": 1,
        "name": "Product updated",
        "slug": "product-updated",
        "typeProduct": 1,
        "typeQuantity": 9
    }
    """

  Scenario: [Success] Submit request to update product with name, product's type and product's type quantity
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/products/1" with body:
    """
    {
        "name": "Product updated",
        "typeProduct": 3,
        "typeQuantity": 4
    }
    """
    Then the response status code should be 200
    And the JSON should be equal to:
    """
    {
        "id": 1,
        "name": "Product updated",
        "slug": "product-updated",
        "typeProduct": 3,
        "typeQuantity": 4
    }
    """

  Scenario: [Success] Submit request to update product with same name, same product's type and same product's type quantity
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/products/1" with body:
    """
    {
        "name": "Product 1",
        "typeProduct": 1,
        "typeQuantity": 9
    }
    """
    Then the response status code should be 204
    And the response should be empty