<?PHP
$titulo = "Pron�stico";

// Tomo las variables que envio el formulario 
$dia=$_POST['dia'];
$mes=$_POST['mes'];
$year=$_POST['year'];
$sexo=$_POST['sexo'];

//Saludo para dama o caballero 
if ( $sexo == "h" ) {
      $saludo = "Estimado caballero";
      $ev = 71; // Esperanza de vida hombre
   } else {
      $ev = 76; // Esperanza de vida mujer
      $saludo = "Distinguida dama";
   }


//lo ponemos todo en d�as
$FechaNac = ($year * 365) + ($mes * 30) + $dia;

//los valores actuales
$AA=date("Y"); //el a�o actual
$MA=date("m"); //el mes actual
$DA=date("d"); //el dia actual

//En dias
$FechaHoy = ($AA * 365) + ($MA * 30) + $DA;

echo "La Fecha de Nacimiemto en dias es " . $FechaNac . " y la fecha de hoy en dias es " . $FechaHoy. "<br />";

//Restamos los dias  
$FF =  ( $FechaHoy - $FechaNac ); 

//Lo convertimos a a�os y lo restamos a la esperanza de vida
$AREST = $ev - ( $FF / 365 );

//Si fuma, restamos 6 a�os a los a�os que le restan por vivir
if ( isset($_POST['fuma']) ) {
   $AREST = ($AREST - 6);
   }
 
 //Le damos formato de dos digitos
 $AREST = number_format($AREST, 2);

?>

<html>
<head><title> <?= $titulo ?> </title></head>
<body>
<h2 align="center"><?= $titulo ?></h1>

<p align="center"> <b><?= $saludo ?></b>: le informamos que ha vivido <?= $FF ?> d�as y que seg�n el INEGI de M�xico, <br /> 
a usted le restan <?= $AREST ?> a�os de vida. Aprov�chelos!!!</p>
<?
if ( isset($_POST['fuma']) ) {
   echo '<p align="center">Y por favor, deje de fumar.</p>';
   }

?>

<p align="center"><a href="formulario.php"><< Regresar</a></p> 

</body>
</html>
