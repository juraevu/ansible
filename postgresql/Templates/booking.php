<head>  <title>Enter bookid to display data - creating a simple web application</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
li {list-style: none;}
</style>
</head>
<body>
<h2>Введите номер бронирования</h2>
<ul>
<form name="display" action="booking.php" method="POST" >
<li>ID брони:</li><li><input type="text" name="bookid" /></li>
<li>Сумма:</li><li><input type="text" name="amount" /></li>
<li>Номер билета:</li><li><input type="text" name="ticket_no" /></li>
<li>Паспорт:</li><li><input type="text" name="id_pass" /></li>
<li>ФИО:</li><li><input type="text" name="name" /></li>
<li>Рейс:</li><li><input type="text" name="flight" /></li>
<li>Класс:</li><li><input type="text" name="class" /></li>
<li><input type="submit" name="submit" /></li>
</form>
</ul>
</body>
</html>

<?php

$db = pg_connect("host=127.0.0.1 port=5432 dbname={{ db_name }} user={{ db_name }} password={{ db_password }}");

$result = pg_query($db, "BEGIN; INSERT INTO bookings (book_ref, book_date, total_amount) VALUES ('$_POST[bookid]', bookings.now(), '$_POST[amount]'); INSERT INTO tickets (ticket_no, book_ref, passenger_id, passenger_name) VALUES ('$_POST[ticket_no]', '$_POST[bookid]', '$_POST[id_pass]', '$_POST[name]'); INSERT INTO ticket_flights (ticket_no, flight_id, fare_conditions, amount) VALUES ('$_POST[ticket_no]', '$_POST[flight]', '$_POST[class]', '$_POST[amount]'); COMMIT;");
?>
