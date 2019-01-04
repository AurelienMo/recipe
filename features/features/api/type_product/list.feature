@api
@api_type_product
@api_type_product_list
  Feature: I need to be able to get list product's type

    Background:
      Given I load following file "products/list.yml"
      And I load following file "security/user.yml"

    Scenario: [Fail] Forbidden access
      When I send a "GET" request to "/api/types-product"
      Then the response status code should be 403
      And the JSON node "message" should be equal to "Vous n'êtes pas autorisé à accéder à cette information."
    Scenario: [Success] Submit request & obtain list type of product.
      When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "GET" request to "/api/types-product" with body:
      """
      """
      Then the response status code should be 200
      And the JSON node "root" should have 33 elements