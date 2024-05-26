#!/usr/bin/python3
""" Products Module """
import models
from uuid import uuid4
from models import storage
from os import getenv
from flask import Flask, render_template
from models.product import Product
from sqlalchemy.orm import relationship
from models.basemod import BaseModel, Base
from sqlalchemy import Column, String, Integer, DateTime
from sqlalchemy import ForeignKey

app = Flask(__name__)

@app.teardown_appcontext
def teardown(exc):
    """ remove the current SQLAlchemy session """
    storage.close()


@app.route("/products_list", strict_slashes=False)
def products_list():
    """ Displays an HTML page with a list of all
    product objects in DBStorage
    """
    cache_id = str(uuid4())
    products = storage.all(Product).values()
    products = sorted(products, key=lambda k: k.name)
    return render_template("product_list.html", products=products)

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=5000)
