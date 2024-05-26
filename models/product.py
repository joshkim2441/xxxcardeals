#!/usr/bin/python3
""" holds class Product"""
import models
from models.basemod import BaseModel, Base
from os import getenv
import sqlalchemy
from sqlalchemy import Column, String, ForeignKey
from sqlalchemy.orm import relationship


class Product(BaseModel, Base):
    """Representation of state """
    if models.storage_t == "db":
        __tablename__ = 'tbl_product'
        name = Column(String(255), nullable=False)

    else:
        name = ""

    def __init__(self, *args, **kwargs):
        """initializes state"""
        super().__init__(*args, **kwargs)

    if models.storage_t != "db":
        @property
        def products(self):
            """getter for list of product instances"""
            product_list = []
            all_products = models.storage.all(Product)
            for product in all_products.values():
                if product.id == self.id:
                    product_list.append(product)
            return product_list

