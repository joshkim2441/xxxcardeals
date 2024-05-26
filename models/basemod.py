#!/usr/bin/python3
"""
Contains class BaseModel
"""

from datetime import datetime
import models
from os import getenv
import sqlalchemy
from sqlalchemy import Column, Integer, String, DateTime
from sqlalchemy.ext.declarative import declarative_base
import uuid

time = "%Y-%m-%dT%H:%M:%S.%f"

Base = declarative_base

class BaseModel:
    """A base class for all xxx models"""
    id = Column(Integer, primary_key=True)
    create_date = Column(DateTime, nullable=False, default=datetime.now())
    update_date = Column(DateTime, nullable=False, default=datetime.now())

    def __init__(self, *args, **kwargs):
        """Instantiates a new model"""
        if not kwargs:
            self.id = str(uuid.uuid4())
            self.create_date = self.update_date = datetime.now()
        else:
            if 'update_date' in kwargs:
                kwargs['update_date'] = datetime.strptime(kwargs['update_date'],
                                                         '%Y-%m-%dT%H:%M:%S.%f'
                                                         )
            else:
                self.update_date = datetime()
            if 'create_date' in kwargs:
                kwargs['create_date'] = datetime.strptime(kwargs['create_date'],
                                                         '%Y-%m-%dT%H:%M:%S.%f'
                                                         )
            else:
                self.create_date = datetime.now()
            if 'id' not in kwargs:
                self.id = str(uuid.uuid4())
            self.__dict__.update(kwargs)

    def __str__(self):
        """Returns a string representation of the instance"""
        d = self.__dict__.copy()
        d.pop("_sa_instance_state", None)
        return "[{}] ({}) {}".format(type(self).__name__, self.id, d)

    def save(self):
        """Updates updated_at with current time when instance is changed"""
        self.update_date = datetime.now()
        models.storage.new(self)
        models.storage.save()

    def to_dict(self, save_fs=None):
        """returns a dictionary containing all keys/values of the instance"""
        new_dict = self.__dict__.copy()
        if "create_date" in new_dict:
            new_dict["create_date"] = new_dict["create_date"].strftime(time)
        if "update_date" in new_dict:
            new_dict["update_date"] = new_dict["update_date"].strftime(time)
        new_dict["__class__"] = self.__class__.__name__
        if "_sa_instance_state" in new_dict:
            del new_dict["_sa_instance_state"]
        if save_fs is None:
            if "password" in new_dict:
                del new_dict["password"]
        return new_dict

    def delete(self):
        """ Delete the current instance from storage """
        models.storage.delete(self)
