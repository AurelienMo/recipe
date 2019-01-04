@api
@api_list_product
@api_products

Feature: I need to be able to get list of product with type product filter or not

  Background:
    Given I load following file "products/list.yml"
    And I load following file "security/user.yml"

  Scenario: [Success] Submit request no datas under type products filter
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/products?typesProduct=56" with body:
    """
    """
    Then the response status code should be 204
    And the response should be empty

  Scenario: [Success] Submit request no filters
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/products" with body:
    """
    """
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
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/products?typesProduct=1,12" with body:
    """
    """
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