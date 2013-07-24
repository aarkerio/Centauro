<h1>Display Tag </h1>
<ul>
<?php

//print_r($data);

foreach ($data as $v)
{
  echo "<li>".$this->Html->link($v["Entry"]['title'], '/users/entry/'.$Element[0]["User"]["username"].'/'.$v["Entry"]["id"]) . "</li>"; 
}
?>
</ul>


