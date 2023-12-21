
Zabbix-server устанавливается осуществляется из под докера 

Прежде устанавливаем Docker

sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
sudo apt install docker-ce
sudo systemctl status docker

Дальше устанавливаем Zabbix

настравиваем сеть

docker network create --subnet 172.20.0.0/16 --ip-range 172.20.240.0/20 zabbix-net 

Устанавливаем mysql server

docker run --name mysql-server -t \
             -e MYSQL_DATABASE="zabbix" \
             -e MYSQL_USER="zabbix" \
             -e MYSQL_PASSWORD="zabbix_pwd" \
             -e MYSQL_ROOT_PASSWORD="root_pwd" \
             --network=zabbix-net \
             --restart unless-stopped \
             -d mysql:8.0 \
             --character-set-server=utf8 --collation-server=utf8_bin \
             --default-authentication-plugin=mysql_native_password

Устанавливаем zabbix-java-gateway

docker run --name zabbix-java-gateway -t \
             --network=zabbix-net \
             --restart unless-stopped \
             -d zabbix/zabbix-java-gateway:alpine-6.0-latest 


docker run --name zabbix-server-mysql -t \
             -e DB_SERVER_HOST="mysql-server" \
             -e MYSQL_DATABASE="zabbix" \
             -e MYSQL_USER="zabbix" \
             -e MYSQL_PASSWORD="zabbix_pwd" \
             -e MYSQL_ROOT_PASSWORD="root_pwd" \
             -e ZBX_JAVAGATEWAY="zabbix-java-gateway" \
             --network=zabbix-net \
             -p 10051:10051 \
             --restart unless-stopped \
             -d zabbix/zabbix-server-mysql:alpine-6.0-latest

Устанавливаем веб интерфейс

docker run --name zabbix-web-nginx-mysql -t \
             -e ZBX_SERVER_HOST="zabbix-server-mysql" \
             -e DB_SERVER_HOST="mysql-server" \
             -e MYSQL_DATABASE="zabbix" \
             -e MYSQL_USER="zabbix" \
             -e MYSQL_PASSWORD="zabbix_pwd" \
             -e MYSQL_ROOT_PASSWORD="root_pwd" \
             --network=zabbix-net \
             -p 80:8080 \
             --restart unless-stopped \
             -d zabbix/zabbix-web-nginx-mysql:alpine-6.0-latest

docker run --name zabbix-web-nginx-mysql -t \
             -e ZBX_SERVER_HOST="zabbix-server-mysql" \
             -e DB_SERVER_HOST="mysql-server" \
             -e MYSQL_DATABASE="zabbix" \
             -e MYSQL_USER="zabbix" \
             -e MYSQL_PASSWORD="zabbix_pwd" \
             -e MYSQL_ROOT_PASSWORD="root_pwd" \
             --network=zabbix-net \
             -p 80:8080 \
             --restart unless-stopped \
             -d zabbix/zabbix-web-nginx-mysql:alpine-6.0-latest

Установка Zabbix-agenta

	Ubuntu
		sudo apt install --yes zabbix-agent
		в файле /etc/zabbix/zabbix_agentd.conf 
		меняем Server=your.server.ip.address
		и ServerActive=your.server.ip.address на свои
		sudo systemctl enable --now zabbix-agent
		systemctl restart zabbix-agent 		

	Centos 7
		yum install zabbix-agent
		в файле /etc/zabbix_agentd.conf  редактируем строку Server=127.0.0.1  ставим ip zabbix-server
		systemctl enable zabbix-agent  
		systemctl start zabbix-agent





