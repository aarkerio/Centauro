<title>Tabla usuarios</title>
</head>

<table style="border:1px solid green">
<tr><td></td><td>Nombre</td><td>Email</td><td></td>
<?php

// simple select queries
$users = $mdb2->queryAll('SELECT * FROM users');

foreach ($users as $user)
{
   echo '<tr><td>' . $user['name'] . '</td><td>' . $user['email'] .'</td><td>'.delButton($user['id'], 'users').'</td></tr>';
}

?>

</table>
