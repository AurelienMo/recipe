@api
@api_stock_product
@api_stock_product_update

Feature: I need to be able to update stock for a given product and given group
  Background:
    Given I load following file "security/user.yml"
    And I load following group:
      | name           | owner   |
      | Group John Doe | johndoe |
      | Group Jane Doe | janedoe |
    And I load following file "products/list.yml"

  Scenario: [Fail] Submit request with anonymous user
    When I send a "PUT" request to "/api/groups/1/stock-product/1"
    Then the response status code should be 401
    And the JSON node "message" should be equal to "Merci de vous authentifier."

  Scenario: [Fail] Submit request with wrong user for a given group
    When After authentication on url "/api/login_check" with method "POST" as user "janedoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/1" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'êtes pas autorisé aux informations de ce groupe"

  Scenario: [Fail] Submit request with invalid group
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/5/stock-product/1" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Le groupe n'existe pas."

  Scenario: [Fail] Submit request with invalid stock product
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/10" with body:
    """
    """
    Then the response status code should be 404
    And the JSON node "message" should be equal to "Ce produit n'est pas présent dans votre stock."

  Scenario: [Fail] Submit request with no payload
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/1" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "quantity": [
            "La quantité doit être spécifiée."
        ]
    }
    """

  Scenario: [Fail] Try to update stock product for another my group
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
      | Group Jane Doe | 1        | Product 8        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/2" with body:
    """
    {
        "quantity": 10
    }
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "Vous n'avez pas les droits pour modifier le stock de ce produit."

  Scenario: [Success] Update stock product with quantity 0.
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
      | Group Jane Doe | 1        | Product 8        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/1" with body:
    """
    {
        "quantity": 0
    }
    """
    Then the response status code should be 200
    And the JSON should be valid according to this schema:
    """
    {
        "type": "object",
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
        },
        "definitions": {
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

  Scenario: [Success] Update stock product with quantity greather than 0
    And I load following stock product:
      | group          | quantity | product          |
      | Group John Doe | 1        | Product 6        |
      | Group Jane Doe | 1        | Product 8        |
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "PUT" request to "/api/groups/1/stock-product/1" with body:
    """
    {
        "quantity": 8
    }
    """
    Then the response status code should be 200
    And the JSON should be valid according to this schema:
    """
    {
        "type": "object",
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
        },
        "definitions": {
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