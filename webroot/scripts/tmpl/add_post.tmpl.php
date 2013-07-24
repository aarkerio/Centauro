<?php
// armo mi query
$q = 'SELECT id, theme FROM themes ORDER BY theme';

$posts = $mdb2->queryAll($q);

?>

<form action="inc/add_post.inc.php" method="post">

<p>Title:</p>
<p><input type="text" name="title" size="20" /></p>
<p>Theme:<br />
<select name="theme_id">
<?php
foreach ($themes as $theme)
{  
   echo '<option value="'.$theme.'">' . $theme['email'] . '</div>';
}
?>
</select>
</p>

<p>
<textarea cols="30" rows="20"> </textare> 
</p>
<p>Publicado:</br>
<input type="checkbox" value="1" /></p>

<input type="submit" value="Enviar" />
</form>