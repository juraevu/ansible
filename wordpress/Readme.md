Установка WordPress с помощю Docker на Ubuntu 


Устанавливаем  docker 

sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
sudo apt install docker-ce
sudo systemctl status docker
sudo apt  install docker-compose

скачиваем файил  docker-compose.yaml

и запускаем команду docker-compose up -d

после установки требуется подождать пару минут 

Сайт доступен по адресу http://ip-адрес:8000/wp-admin/install.php
