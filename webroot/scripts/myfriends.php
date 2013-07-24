
<a href="pgphp1.php">Add new friend</a>

<?php

$conn = pg_connect('host=localhost dbname=contacts user=contacts password=firstphp');

if (!$conn) {
  echo "An error occured.\n";
  exit;
}

$result = pg_query($conn, "SELECT firstname, surname, emailaddress FROM friends");

if (!$result) {
  echo "An error occured.\n";
  exit;
}

while ($row = pg_fetch_row($result)) 
{
  echo "Firstname:" .  $row[0]  ." surname: " . $row[1] . " E-mail: " . $row[2];
  echo "<br />\n";
}

?> 
