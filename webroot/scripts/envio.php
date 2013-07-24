<?php
  /*
  CREATE TABLE centa_pedidos (
  id serial PRIMARY KEY,
  estado int,
  nombre varchar(60),
  email varchar(30),
  direccion1 varchar(50),
  direccion2 varchar(50),
  cp varchar(5),
  pais varchar(20),
  talla varchar(20),
  modelo varchar(30),
  color varchar(30),
  comentario text,
  fecha date
  );
  */
  
  die();
  include("../inc/connexion.inc.php");
  
  $nombre     = $_POST['nombre'];
  
  $email      = $_POST['email'];
  
  $direccion1 = $_POST['direccion1'];
  
  $direccion2 = $_POST['direccion2'];
  
  $pais       = $_POST['pais'];
  
  $cp         = $_POST['cp'];
  
  $color      = 'negra'; //$_POST['color'];
  
  $talla      = $_POST['talla'];
  
  $modelo     = 'sin-modelo'; //$_POST['modelo'];
  
  $discos     = 'sin discos'; //$_POST['discos'];
  
  $comentario = $_POST['comentario'];
  
  $hoy = date("d-m-Y"); //dia mes y año
  
  $sql="INSERT INTO centa_pedidos (estado,  nombre,  email,  direccion1,  direccion2, cp, pais, talla,  modelo,  color, comentario, fecha) VALUES (1, '$nombre', '$email', '$direccion1', '$direccion2', '$cp', 'MX', '$talla', '$modelo', '$color', '$comentario', '$hoy')";
  
  
  //die($sql);
  
  $conn->query($sql);
  
  mail("manuel@mononeurona.org", "Pedido Linux Kit", "Pedido de:  $nombre --  $direccion1 $direccion2");
  
     echo "
     <script language='javascript'>
     <!--
           alert('¡Gracias por tu donación, confirmaremos tu pedido en poco tiempo!');
          
          document.location.href = '../index.php';
  	-->
     </script>
   ";


// Cierro la conexión con Postgresql
$conn->disconnect();
?>
