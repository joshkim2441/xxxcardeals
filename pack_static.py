#!/usr/bin/python3
"""
Fabric script that generates a tgz archive from the contents of the static
folder of the xXx car deals repo
"""

import paramiko
from datetime import datetime
from fabric.api import local
from os.path import isdir

def do_pack():
    """ Generates a .tgz archive from contents
    of the static folder
    """
    tm = datetime.now()
    tm_ft = tm.strftime("%Y%m%d%H%M%S")
    if not os.path.isdir("versions"):
        local("mkdir versions")
    file_path = "versions/static_{}.tgz".format(tm_ft)
    result = local("tar -cvzf {} static".format(file_path))
    if result.failed:
        return None
    archive_size = os.stat(file_path).st_size
    print("static packed: {} -> {} Bytes".format(file_path, archize_size))
    return file_path
