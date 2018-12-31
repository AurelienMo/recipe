@api
@api
  Feature: I need to be able to get list product's type

    Background:
      Given I load following file "products/list.yml"

    Scenario: [Fail] Missing lang parameter
      When I send a "GET" request to "/api/types-product"
      Then the response status code should be 400
      And the JSON should be equal to:
      """
      {
          "lang": [
              "Language is required"
          ]
      }
      """

    Scenario: [Success] Submit request & obtain list type of product.
      When I send a "GET" request to "/api/types-product?lang=fr"
      Then the response status code should be 200
      And the JSON node "root" should have 33 elements