<?PHP
 ob_start;   //"despejo" el cabezal

 $puntos = ( $_POST['1A'] + $_POST['2A'] + $_POST['3A'] +  $_POST['4A'] + 
 $_POST['5A'] + $_POST['6A'] + $_POST['7A'] + $_POST['8A'] + $_POST['9A'] + 
 $_POST['10A'] + $_POST['11A'] + $_POST['12A'] +  $_POST['13A'] +  
 $_POST['14A'] + $_POST['15A'] + $_POST['16A'] +  $_POST['17A'] +  
 $_POST['18A'] + $_POST['19A'] +  $_POST['20A'] + 
 $_POST['21A'] +  $_POST['22A'] ); 
 
 
 
 if ( $puntos < 66 ) {
         echo "Tu puntaje fue de: " . $puntos . "<br>";
	 echo "Es usted un joto";
 
 }
 
 if ( $puntos < 66 ) {
         echo "Tu puntaje fue de: " . $puntos . "<br>";
	 echo "Prometes, pero tienes aspectos jotiles que hay que trabajar";
 
 }
 
 if ( $puntos > 90 ) {
         echo "Tu puntaje fue de: " . $puntos . "<br>";
	 echo "Macho!!";
 
 }
 
?>

