<?php
  
  //Importe la libreria PEAR
  require_once 'DB.php';
  
  //Datos de la BD
  $user='postgres';
  $pass='chamuko';
  $host='localhost';
  $db_name='DBTEST';
  $conn = "pgsql://$user:$pass@$host/$db_name";
  
  $conn = DB::connect($conn, true);
  
  $action=$_REQUEST['action'];
  
  if ( $action == "agregar" ) {
    
   $nombre=$_POST['nombre'];
   
   $email=$_POST['email'];
   
   $sql="INSERT INTO tb_usuarios (id, nombre, email) VALUES (NEXTVAL('tb_usuarios_id_seq'), '$nombre', '$email')";
   
   // echo $sql . "<br />";
   
   $conn->query($sql);
   
     echo "
     <SCRIPT language='JavaScript'>
     <!--
           alert('¡Usuario agregado!');
          
          // document.location.href = 'pgsql.php';
  	-->
     </script>
   ";
    
   }
   
   if ( $action == "borrar" ) {
    
   $id=$_GET['id'];
   
   $sql="DELETE FROM tb_usuarios WHERE id=$id;";
   
   $conn->query($sql);
   
     echo "
     <SCRIPT language='JavaScript'>
     <!--
           alert('¡Registro borrado!');
       
       document.location.href = 'pgsql.php';
  	-->
     </script>
   ";
    
   }
   ?>

<html>
<head>
<title> :: PHP PGSQL ::</title>
</head>
<body bgcolor="#f4ffe5">

<?

echo '<h2 align="center">PHP y PostgreSQL</h2>';


echo '<h3 align="center">Lista de usuarios</h3>';

echo '<table align="center" border="1" width="50%">';

echo '<tr><td><b>Nombre</b></td><td><b>Email</b></td><td>&nbsp;</td></tr>';

//Query
$sql="SELECT * FROM tb_usuarios";

$result = $conn->query($sql);

//Checamos que no haya error
if (DB::isError($result)) {

die ($result->getMessage());

}

// Se hace un loop a través del result

$filas = $result->numRows();

for ($i=0; $i < $filas; $i++){

$estaFila = $result->fetchRow();

$id = $estaFila[0];

$nombre = $estaFila[1];

$email = $estaFila[2];

?>

<tr><td><?= $nombre ?></td><td><?= $email ?></td><td><a href="pgsql.php?action=borrar&id=<?= $id ?>">Borrar</a></td></tr>
 
<?
} //Fin del loop
?>

</table>
<br /><br />
<h3 align="center">Agregar usuario</h3>
<form action="pgsql.php" method="post">
<input type="hidden" name="action" value="agregar" />
<table align="center" border="1" width="50%">
<tr>
<td><input type="text" name="nombre" value="Pancho López" /></td>
<td><input type="text" name="email" value="correo@gmail.com" /></td> 
<td><input type="submit" value="Agregar" /></td></tr>
</table>
</form>

<?
// Cierro la conexión con Postgresql
$conn->disconnect();
?>
</body>
</html>
