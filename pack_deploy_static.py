#!/usr/bin/python3
"""
Fabric script that creates and
distributes an archive to the web servers

execute: fab -f pack_deploy_static.py deploy -i ~/.ssh/id_rsa -u ubuntu
"""

from fabric.api import *
from datetime import datetime
import os
env.user = 'ubuntu'
env.key_filename = "~/id_rsa"
env.hosts = ['34.232.53.167', '54.89.195.92']


def do_pack():
    """ Generates a .tgz archive from contents
    of the web_static folder
    """
    tm = datetime.now()
    tm_ft = tm.strftime("%Y%m%d%H%M%S")
    if not os.path.isdir("versions"):
        local("mkdir versions")
    file_path = "versions/docs_{}.tgz".format(tm_ft)
    result = local("tar -cvzf {} docs".format(file_path))
    if result.failed:
        return None
    archive_size = os.stat(file_path).st_size
    print("docs packed: {} -> {} Bytes".format(file_path, archive_size))
    return file_path


def do_deploy(archive_path):
    """distributes an archive to the web servers"""
    if not os.path.exists(archive_path):
        return False
    try:
        file_n = archive_path.split("/")[-1]
        no_ext = file_n.split(".")[0]
        path = "/data/docs/releases/"
        put(archive_path, '/tmp/')
        run('mkdir -p {}{}/'.format(path, no_ext))
        run('tar -xzf /tmp/{} -C {}{}/'.format(file_n, path, no_ext))
        run('rm /tmp/{}'.format(file_n))
        run('mv {0}{1}/docs/* {0}{1}/'.format(path, no_ext))
        run('rm -rf {}{}/docs'.format(path, no_ext))
        run('rm -rf /data/docs/current')
        run('ln -s {}{}/ /data/docs/current'.format(path, no_ext))
        return True
    except Exception:
        return False


def deploy():
    """
        deploy function that creates/distributes an archive
    """
    archive_path = do_pack()
    if archive_path is None:
        print("do_pack failed")
        return False
    return do_deploy(archive_path)

