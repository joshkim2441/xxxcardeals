#!/usr/bin/python3
"""
initialize the models package
"""

from os import getenv


storage_t = getenv("XXX_TYPE_STORAGE")

if storage_t == "db":
    from models.engine.dbstorage import DBStorage
    storage = DBStorage()
else:
    from models.engine.filestorage import FileStorage
    storage = FileStorage()
storage.reload()
