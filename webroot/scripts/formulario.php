<?PHP

$titulo = "Mi primer formulario";

?>
<html>
<head><title> <?= $titulo ?> </title></head>
<body>
<h1 align="center">Formulario</h1>
<form action="calcula.php" method="post">
<p align="center">Fecha de nacimiento:
<input type="text" name="dia" value="00" size="2" maxlength="2">
<select name="mes">
<option value="1">Ene</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Abr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Ago</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dic</option>
</select> 
<input type="text" name="year" value="19??" size="4" maxlength="4">
</p>

<p align="center"> Sexo: <select name="sexo">
<option value="h">Hombre</option>
<option value="m">Mujer</option>
</select>
</p>

<p align="center"> &#191;Usted fuma?: <input type="checkbox" name="fuma" value="1"></p>

<p align="center"><input type="submit" name="boton" value="Enviar"></p>

</form>
</html>
