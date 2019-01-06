@api
@api_stock_product
@api_stock_product_add

Feature: I need to be able to add a product to stock product for my group

  Background:
    Given I load following file "security/user.yml"
    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
    And I load following file "products/list.yml"

  Scenario: [Fail] Submit request without authentication
    When I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 401
    And the JSON node "message" should be equal to "Merci de vous authentifier."

  Scenario: [Fail] Submit request with a wrong user for given group
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé aux informations de ce groupe"

  Scenario: [Fail] Submit request with not existing group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/5/stock-product" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Le groupe n'existe pas."

  Scenario: [Fail] Submit request without product's id and without new product datas
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    {
        "quantity": 10
    )
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "": [
            "Vous devez spécifier un identifiant de produit ou créer un nouveau produit."
        ]
    }
    """

  Scenario: [Fail] Submit request without quantity
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    {
        "productId": "1"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "quantity": [
            "La quantité a ajouté est requise."
        ]
    }
    """

  Scenario: [Fail] Submit request with a product already exist in group stock product
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    {
        "productId": 6,
        "quantity": 10
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "productId": [
            "Le produit est déjà présent dans les stocks, nous vous invitons à mettre à jour le stock du produit concerné."
        ]
    }
    """

  Scenario: [Success] Submit request with exist product id
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    {
        "productId": 1,
        "quantity": 5
    }
    """
    Then the response status code should be 201
    And the JSON should be valid according to this schema:
    """
    {
        "type": "array",
        "items": {
            "$ref": "#/definitions/StockItemOutput"
        },
        "definitions": {
            "StockItemOutput": {
                "type": "object":
                "properties": {
                    "id": {
                        "type": "integer",
                        "required": true
                    },
                    "product": {
                        "type": "object",
                        "$ref": "#/definitions/ProductOutput"
                    },
                    "quantity": {
                        "type": "number",
                        "required": true
                    }
                }
            },
            "ProductOutput": {
                "type": "object",
                "properties": {
                    "id": {
                        "type": "integer",
                        "required": true
                    },
                    "name": {
                        "type": "string",
                        "required": true
                    },
                    "slug": {
                        "type": "string",
                        "required": true
                    },
                    "typeProduct": {
                        "type": "integer",
                        "required": true
                    },
                    "typeQuantity": {
                        "type": "integer",
                        "required": true
                    }
                }
            }
        }
    }
    """

  Scenario: [Success] Submit request with new product
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/groups/1/stock-product" with body:
    """
    {
        "quantity": 5,
        "product": {
            "name": "Product 17",
            "typeProduct": 16,
            "typeQuantity": 5
        }
    }
    """
    Then the response status code should be 201
    And the JSON should be valid according to this schema:
    """
    {
        "type": "array",
        "items": {
            "$ref": "#/definitions/StockItemOutput"
        },
        "definitions": {
            "StockItemOutput": {
                "type": "object":
                "properties": {
                    "id": {
                        "type": "integer",
                        "required": true
                    },
                    "product": {
                        "type": "object",
                        "$ref": "#/definitions/ProductOutput"
                    },
                    "quantity": {
                        "type": "number",
                        "required": true
                    }
                }
            },
            "ProductOutput": {
                "type": "object",
                "properties": {
                    "id": {
                        "type": "integer",
                        "required": true
                    },
                    "name": {
                        "type": "string",
                        "required": true
                    },
                    "slug": {
                        "type": "string",
                        "required": true
                    },
                    "typeProduct": {
                        "type": "integer",
                        "required": true
                    },
                    "typeQuantity": {
                        "type": "integer",
                        "required": true
                    }
                }
            }
        }
    }
    """