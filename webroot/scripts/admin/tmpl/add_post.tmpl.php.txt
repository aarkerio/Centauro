
<h1>New post</h1>

<form action="inc/add_post.inc.php" method="post"> 

<input type="hidden" name="id" />

<input type="text" name="title" /><br />

Tema:
<select name="theme_id">
<?php

$res = $mdb2->query('SELECT id, theme FROM themes ORDER BY theme');

while ($theme = $res->fetchRow())
{  
   echo '<option value="'.$theme['id'].'">'. $theme['theme'] . '</option>';
}
?>
</select><br />

<textarea name="body" cols="60" rows="15"></textarea><br />

<input type="checkbox" name="status" value="1" /><br />


<input type="submit" value="Save" />
</form>
