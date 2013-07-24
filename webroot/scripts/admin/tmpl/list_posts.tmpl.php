<table>
<tr><td></td><td>Title</td><td>Created</td><td>Status</td><td></td></tr>
<?php

require_once 'inc/myfunctions.inc.php';

// armo mi query
$q = 'SELECT p.id, p.title, p.body, p.created, t.theme FROM posts AS p, themes AS t WHERE p.theme_id=t.id ORDER BY t.id DESC LIMIT 20';
//$q='SELECT * FROM posts';

//exit($q); //depuro 

$results = $mdb2->query($q);

while ($post = $results->fetchRow())
{ 
  // var_dump($post);  //depuro
   echo '<tr>';
      echo '<td>'     . editButton($post['id'], 4)      . '</td>';
      echo '<td>'     . $post['title']    . '</td>';
      echo '<td>'     . $post['body']     . '</td>';
      echo '<td>'     . $post['created']  . '</td>';
      echo '<td>'     . delButton($post['id'], 'posts')      . '</td>';
   echo '</tr>';
}
?>
</table>
