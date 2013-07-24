<html>
<head>
    <title>Array en Forma :: PHP</title>
<head>
<body>

<br />
<b>Selecciona tus postres favoritos:</b><br /><br />
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<input name="postre[]" type="checkbox" value="Helado de Vainilla">Helado de vanilla<br />
<input name="postre[]" type="checkbox" value="Pastel de Chocolate">Pastel de Chocolate<br />
<input name="postre[]" type="checkbox" value="Pay de elote">Pay de elote<br />
<input name="postre[]" type="checkbox" value="Bubulubu">Bubulubu<br />
<input name="postre[]" type="checkbox" value="Duraznos en almibar">Duraznos en almibar<br />
<input name="postre[]" type="checkbox" value="Fresas con crema">Fresas con crema<br />
<input name="send" type="submit" id="send" value="Enviar!">
</form>

<?php
if (isset($_POST['postre']))
{
   $postre = $_POST['postre'];
   $n        = count($postre);
   $i        = 0;

   echo "Tus postres favoritos son: \r\n" .
        "<ol>";
   while ($i < $n)
   {
      echo "<li>{$postre[$i]}</li> \r\n";
      $i++;
   }
   echo "</ol><br />
   <a href=\"http://www.mononeurona.org/index.php?idp=418\"> << Regresa</a><br />";
}

?>


</body>
</html>
