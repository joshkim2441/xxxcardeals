#!/usr/bin/python3
""" Test .get() and .count() methods
"""
from models import storage
from models.product import Product

print("All objects: {}".format(storage.count()))
print("Product objects: {}".format(storage.count(Product)))

first_state_id = list(storage.all(Product).values())[0].id
print("First state: {}".format(storage.get(Product, first_state_id)))


