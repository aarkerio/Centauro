<div class="title_section">Podcasts</div>

<?php

//die(var_dump($data));

foreach ($data as $key=>$val)
  {
  echo "<div class=\"wrapnew\">";
  echo "<div class=\"news_title\">". $val['Podcasts']['title']   . "</div>";
  echo "<div class=\"news_date\">" . $val['Podcasts']['created'] . "</div>";
  echo "<div class=\"news_body\">";
  
  echo  $val['Podcasts']['description']    . "</div>";
  
  echo "</div>";
 }
?>




