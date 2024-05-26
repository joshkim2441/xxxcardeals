#!/usr/bin/python
""" holds class Place"""
import models
from models.basemod import BaseModel, Base
from os import getenv
import sqlalchemy
from sqlalchemy import Column, String, Integer, Float, ForeignKey, Table
from sqlalchemy.orm import relationship

if models.storage_t == 'db':
    sale_products = Table('sale_products', Base.metadata,
                          Column('product_id', String(60),
                                 ForeignKey('products.id', onupdate='CASCADE',
                                            ondelete='CASCADE'),
                                 primary_key=True),
                          Column('user_id', String(60),
                                 ForeignKey('amenities.id', onupdate='CASCADE',
                                            ondelete='CASCADE'),
                                 primary_key=True))


class Sale(BaseModel, Base):
    """Representation of Place """
    if models.storage_t == 'db':
        __tablename__ = 'sale'
        product_id = Column(String(60), ForeignKey('products.id'), nullable=False)
        user_id = Column(String(60), ForeignKey('users.id'), nullable=False)
        name = Column(String(128), nullable=False)
        description = Column(String(1024), nullable=True)
        product_user = relationship("Product",
                               backref="product",
                               cascade="all, delete, delete-orphan")
        users = relationship("User",
                                 secondary=product_user,
                                 viewonly=False)
    else:
        product_id = ""
        user_id = ""
        name = ""
        description = ""

    def __init__(self, *args, **kwargs):
        """initializes Place"""
        super().__init__(*args, **kwargs)

    if models.storage_t != 'db':
        @property
        def products(self):
            """getter attribute returns the list of product instances"""
            from models.product import Product
            product_list = []
            all_products = models.storage.all(Product)
            for product in all_products.values():
                if product.id == self.id:
                    product_list.append(product)
            return product_list
