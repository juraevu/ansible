 <head>  <title>Enter bookid to display data - creating a simple web application</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
li {list-style: none;}
</style>
</head>
<body>
<h2>Введите номер бронирования</h2>
<ul>
<form name="display" action="bookings.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li><input type="submit" name="submit" /></li>
</form>
</ul>
</body>
</html>

<?php

$db = pg_connect("host=127.0.0.1 port=5432 dbname={{ db_name }} user={{ db_user }} password={{ db_password }}");
$result = pg_query($db, "SELECT b.book_ref, b.book_date, t.ticket_no, t.passenger_name, t.passenger_id, t.contact_data, b.total_amount FROM bookings b INNER JOIN tickets t ON b.book_ref = t.book_ref WHERE b.book_ref = '$_POST[bookid]'");
while ($row = pg_fetch_row($result)) {
  echo "$row[0] | $row[1] | $row[2] | $row[3] | $row[4] | $row[5] | $row[6]";
  echo "<br />\n";
}
?>
