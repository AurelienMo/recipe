@api
@api_products

Feature: I need to be able to get list of product with type product filter or not

  Background:
    Given I load following file "products/list.yml"

  Scenario: [Fail] Missing lang parameter
    When I send a "GET" request to "/api/products"
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "lang": [
            "Language is required"
        ]
    }
    """

  Scenario: [Success] Submit request with lang & no datas under type products filter
    When I send a "GET" request to "/api/products?lang=fr&typesProduct=56"
    Then the response status code should be 204
    And the response should be empty

  Scenario: [Success] Submit request with lang & no filters
    When I send a "GET" request to "/api/products?lang=fr"
    Then the response status code should be 200
    And the JSON node "root" should have 15 elements
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "$ref": "#/definitions/product"
      },
      "definitions": {
        "product":{
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
            "typeProduct": {
              "type": "integer",
              "required": true
            }
          }
        }
      }
    }
    """

  Scenario: [Success] Submit request with lang & filters type product 1
    When I send a "GET" request to "/api/products?lang=fr&typesProduct=1,12"
    Then the response status code should be 200
    And the JSON node "root" should have 5 elements
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "$ref": "#/definitions/product"
      },
      "definitions": {
        "product":{
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
            "typeProduct": {
              "type": "integer",
              "required": true
            }
          }
        }
      }
    }
    """