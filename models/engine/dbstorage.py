#!/usr/bin/python3
""" Contains the File Storage class """
import os
import models
from sqlalchemy import create_engine
from sqlalchemy.orm import scoped_session
from sqlalchemy.orm import sessionmaker
from sqlalchemy.orm import relationship
from models.basemod import BaseModel
from models.product import Product
from models.basemod import Base
from models.user import User

user = os.getenv('XXX_MYSQL_USER')
pwd = os.getenv('XXX_MYSQL_PWD')
host = os.getenv('XXX_MYSQL_HOST')
db = os.getenv('XXX_MYSQL_DB')
env = os.getenv('XXX_ENV')
classes = {"User": User, "product": Product}


class DBStorage:
    """ Representation of a database storage engine"""

    __engine = None
    __session = None

    def __init__(self):
        """ The class DBStorage constructor """
        DB_URL = "mysql+mysqldb://{}:{}@{}:3306/{}".format(
            user, pwd, host, db
        )
        self.__engine = create_engine(DB_URL, pool_pre_ping=True)
        if env == 'test':
            Base.metadata.drop_all(self.__engine)

    def all(self, cls=None):
        """ Method to return a dictionary of objects """
        if cls is None:
            objs = self.__session.query(User).all()
            objs.extend(self.__session.query(User).all())
        else:
            if type(cls) == str:
                cls = eval(cls)
            objs = self.__session.query(cls)
        return {"{}.{}".format(type(o).__name__, o.id): o for o in objs}

    def new(self, obj):
        """ Inserts the object to current database session """
        if obj is not None:
            try:
                self.__session.add(obj)
                self.__session.flush()
                self.__session.refresh(obj)
            except Exception as ex:
                self.__session.rollback()
                raise ex

    def delete(self, obj=None):
        """ Removes an object from database storage """
        if obj is not None:
            self.__session.query(type(obj)).filter(
                type(obj).id == obj.id).delete(
                synchronize_session=False
            )

    def reload(self):
        """ Create current database session """
        Base.metadata.create_all(self.__engine)
        sess_factory = sessionmaker(bind=self.__engine,
                                    expire_on_commit=False)
        self.__session = scoped_session(sess_factory)()

    def save(self):
        """ Commit the session changes to the database """
        self.__session.commit

    def close(self):
        """ Close the storage engine """
        self.__session.close()

    def get(self, cls, id):
        """
        Returns the object based on the class name and its ID, or
        None if not found
        """
        if cls not in classes.values():
            return None

        all_cls = models.storage.all(cls)
        for value in all_cls.values():
            if (value.id == id):
                return value

        return None

    def count(self, cls=None):
        """
        count the number of objects in storage
        """
        all_class = classes.values()

        if not cls:
            count = 0
            for clas in all_class:
                count += len(models.storage.all(clas).values())
        else:
            count = len(models.storage.all(cls).values())

        return count
