<h1>Blogger Profile</h1>
<?php
// armo mi query
$q = 'SELECT id, username, email FROM usuarios WHERE id=1';

$results = $mdb2->query($q);

while ($user = $results->fetchRow())
{  
   echo '<div class="wrapnew">';
      echo '<div class="news_title">'  . $user['username']  . '</div>';
      echo '<div class="news_le">'     . $post['email'] . '</div>';
	  echo '<div>'    . $post['id'] . '</div>';
   echo '</div>';
}
?>
