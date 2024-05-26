#!/usr/bin/python3
""" objects that handle all default RestFul API actions for Sales """
from models.product import Product
from models.user import User
from models.sale import Sale
from models import storage
from api.v1.views import app_views
from flask import abort, jsonify, make_response, request
from flasgger.utils import swag_from


@app_views.route('/cities/<product_id>/sales', methods=['GET'],
                 strict_slashes=False)
@swag_from('documentation/sale/get_sales.yml', methods=['GET'])
def get_sales(product_id):
    """
    Retrieves the list of all sale objects of a product
    """
    product = storage.get(Product, product_id)

    if not product:
        abort(404)

    sales = [sale.to_dict() for sale in product.sales]

    return jsonify(sales)


@app_views.route('/sales/<sale_id>', methods=['GET'], strict_slashes=False)
@swag_from('documentation/sale/get_sale.yml', methods=['GET'])
def get_sale(sale_id):
    """
    Retrieves a sale object
    """
    sale = storage.get(Sale, sale_id)
    if not sale:
        abort(404)

    return jsonify(sale.to_dict())


@app_views.route('/sales/<sale_id>', methods=['DELETE'],
                 strict_slashes=False)
@swag_from('documentation/sale/delete_sale.yml', methods=['DELETE'])
def delete_sale(sale_id):
    """
    Deletes a sale Object
    """

    sale = storage.get(Sale, sale_id)

    if not sale:
        abort(404)

    storage.delete(sale)
    storage.save()

    return make_response(jsonify({}), 200)


@app_views.route('/cities/<product_id>/sales', methods=['POST'],
                 strict_slashes=False)
@swag_from('documentation/sale/post_sale.yml', methods=['POST'])
def post_sale(product_id):
    """
    Creates a sale
    """
    product = storage.get(Product, product_id)

    if not product:
        abort(404)

    if not request.get_json():
        abort(400, description="Not a JSON")

    if 'user_id' not in request.get_json():
        abort(400, description="Missing user_id")

    data = request.get_json()
    user = storage.get(User, data['user_id'])

    if not user:
        abort(404)

    if 'name' not in request.get_json():
        abort(400, description="Missing name")

    data["product_id"] = product_id
    instance = Sale(**data)
    instance.save()
    return make_response(jsonify(instance.to_dict()), 201)


@app_views.route('/sales/<sale_id>', methods=['PUT'], strict_slashes=False)
@swag_from('documentation/sale/put_sale.yml', methods=['PUT'])
def put_sale(sale_id):
    """
    Updates a sale
    """
    sale = storage.get(Sale, sale_id)

    if not sale:
        abort(404)

    data = request.get_json()
    if not data:
        abort(400, description="Not a JSON")

    ignore = ['id', 'user_id', 'product_id', 'created_at', 'updated_at']

    for key, value in data.items():
        if key not in ignore:
            setattr(sale, key, value)
    storage.save()
    return make_response(jsonify(sale.to_dict()), 200)


@app_views.route('/sales_search', methods=['POST'], strict_slashes=False)
@swag_from('documentation/sale/post_search.yml', methods=['POST'])
def sales_search():
    """
    Retrieves all sale objects depending of the JSON in the body
    of the request
    """

    if request.get_json() is None:
        abort(400, description="Not a JSON")

    data = request.get_json()

    if data and len(data):
        states = data.get('states', None)
        products = data.get('products', None)
        amenities = data.get('amenities', None)

    if not data or not len(data) or (not products):
        sales = storage.all(sale).values()
        list_sales = []
        for sale in sales:
            list_sales.append(sale.to_dict())
        return jsonify(list_sales)

    list_sales = []
    if states:
        states_obj = [storage.get(Product, p_id) for p_id in products]
        for state in states_obj:
            if state:
                for product in state.products:
                    if product:
                        for sale in product.sales:
                            list_sales.append(sale)

    sales = []
    for p in list_sales:
        d = p.to_dict()
        d.pop('products', None)
        sales.append(d)

    return jsonify(sales)

