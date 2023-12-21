# ansible

PlayBook для автоматической установки почтового сервера 

Что не работает автоматически
	Получение сертификатов от Let s script  (при отключении vpn и запуска команды он может получить надо настроить правильную маршрутизацию )
		пока запускаем вручную certbot certonly --standalone --rsa-key-size 4096 -d mail.juraev72.ru -d imap.juraev72.ru -d smtp.juraev72.ru -m test@juraev72.ru --agree-tos	 
	Не проходит автоматически Configure and Setup Postfixadmin
		надо ручками добавлять $CONF['setup_password'] =    и создавать админскую запись 
	на странице https://domain/webmail/installer/ Roundcube Webmail Installer надо 
	ручками нажимать кнопку Initilize database 
	Удалить папочку /var/www/html/webmail/installer

Установка производиться с помощью playbook-ов

mail-server.yml основной  плейбук из которого принимаются все переменные и запуск остальных плейбуков

chrony.yml  настраивает правильное время 

port.yml  открывает порты 

pkg.yml  устанавливает необходимые пакеты

ssl.yml  устанавливает certbot и запрашивает сертификаты 

postfix.yml  настраивает службу postfix  копирует шаблоны 

dovecot.yml  настраивает службу dovecot  копирует шаблоны 

mariadb.yml  устанавливает службу MariaDB  создает необходимые базы и пользователей

postfixadmin.yml  устанавливает и запускает пакет postfixadmin

roundcube.yml  устанавливает и запускает пакет roundcube

handlers.yml  перезапускает службы


