@api
@api_products

Feature: I need to be able to add a product

  Background:
    Given I load following file "products/add.yml"

  Scenario: [Fail] Submit request with empty payload
    When I send a "POST" request to "/api/products" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "name": [
            "Vous devez spécifier un nom de produit."
        ],
        "typeProduct": [
            "Vous devez associer le produit à une catégorie de produit."
        ],
        "typeQuantity": [
            "Vous devez choisir un type de conditionnement pour l'ajout d'un produit."
        ]
    }
    """

  Scenario: [Fail] Submit request with already exist product
    When I send a "POST" request to "/api/products" with body:
    """
    {
        "name": "Product 1",
        "typeProduct": 1,
        "typeQuantity": 1
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "": [
            "Ce produit existe déjà en base de donnée."
        ]
    }
    """

  Scenario: [Fail] Submit request with not found type product and not found type quantity
    When I send a "POST" request to "/api/products" with body:
    """
    {
        "name": "Product 15",
        "typeProduct": 115,
        "typeQuantity": 200
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

  Scenario: [Success] Submit request with good datas
    When I send a "POST" request to "/api/products" with body:
    """
    {
        "name": "Product 16",
        "typeProduct": 1,
        "typeQuantity": 1
    }
    """
    Then the response status code should be 201
    And the JSON should be equal to:
    """
    {
        "id": 6,
        "name": "Product 16",
        "slug": "product-16",
        "typeProduct": 1,
        "typeQuantity": 1
    }
    """