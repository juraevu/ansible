

для правлильной работы необходимо отключить SELinux
nano /etc/selinux/config
заменить на SELINUX=disabled
Обязательно перезагрузить 

#То что не получилось реализовать в playbook e

Для очистки таблиц (но сохранением структуры) boarding_passes, Bookings.
Вводим
psql -U student -d fortests -h 127.0.0.1
вводим пароль 
далее команды для очищения таблиц
TRUNCATE bookings CASCADE;
TRUNCATE boarding_passes CASCADE;


Для работы pgadmin
запускаем
/usr/pgadmin4/bin/setup-web.sh
вводом электронную почту для входа 
вводим 2 раза пароль 
это данные для входа в веб интерфейс pgadmin
http://ip-адрес/pgadmin4
