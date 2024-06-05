sudo apt-get -y update
sudo apt-get -y upgrade
sudo apt-get -y install nginx
sudo mkdir -p /data/static/releases/test /data/static/shared
echo "This is a test" | sudo tee /data/static/releases/test/index.html
sudo ln -sf /data/static/releases/test/ /data/static/current
sudo chown -hR ubuntu:ubuntu /data/
sudo sed -i '38i\\tlocation /xxx_static/ {\n\t\talias /data/static/current/;\n\t}\n' /etc/nginx/sites-available/default
sudo service nginx start
