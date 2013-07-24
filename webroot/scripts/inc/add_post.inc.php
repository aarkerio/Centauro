<?php
include_once 'conexion.inc.php';

 $title     = pg_escape_string($_POST['title']);
 $body      = pg_escape_string($_POST['body']);
 $theme_id  = pg_escape_string($_POST['theme_id']);

 $q = "INSERT INTO posts (title, body, theme_id) VALUES ('" . $title . "', '" . $body . "', " . $theme_id . ")";

 $result = $mdb2->query($q);

 if (!$result) 
 {
            exit("Error with query: " . $q);
 }
?>
<script language="javascript">
<!--
    
alert('Post agregado');
         
document.location.href = '../portal.php';
-->
</script>