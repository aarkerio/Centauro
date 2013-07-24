<?php

require_once 'inc/myfunctions.inc.php';

// armo mi query
$q = 'SELECT p.id, p.title, p.theme_id, p.status, p.body, p.created, t.theme FROM posts AS p, themes AS t WHERE p.theme_id=t.id AND p.id='.$_GET['post_id'];
//$q='SELECT * FROM posts';

//exit($q); //depuro 

$results = $mdb2->query($q);

$post = $results->fetchRow();

?>
<form action="inc/update_post.inc.php" method="post"> 
<input type="hidden" name="id" value="<?php echo $post['id']; ?>" />

<input type="text" name="title" value="<?php echo $post['title']; ?>" /><br />

Tema:
<select name="theme_id">
<?php

$res = $mdb2->query('SELECT id, theme FROM themes ORDER BY theme');

while ($theme = $res->fetchRow())
{
   $selected = ($theme['id'] == $post['theme_id']) ? ' selected="selected"' : '';
   
   echo '<option value="'.$theme['id'].'" '.$selected.'>'. $theme['theme'] . '</option>';
}
?>
</select><br />

<textarea name="body" cols="60" rows="15"><?php echo $post['body']; ?></textarea><br />

<input type="checkbox" name="status" value="1" /><br />


<input type="submit" value="Save" />
</form>
