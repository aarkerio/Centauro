<?php
//die(print_r($data));
//print_r($this->Session->read());

echo "Foro: " . $this->Html->link($data[0]["Forum"]['title'], '/forums/display/'.$data[0]["Forum"]['title'].'/'. $Element[0]["User"]["username"].'/'. $Element[0]["User"]["id"].'/'.$data[0]["Topic"]["forum_id"]) . "<br />";

echo "<h2>Topic: " . $data[0]["Topic"]["subject"] . "</h2>";

//die(print_r($data));

echo $this->Html->link($this->Html->image('static/post_reply.gif', array('alt'=>"Post Reply", 'title'=>"Post Reply")), 
'/topics/add/'.$Element[0]["User"]["username"].'/'.$data[0]["Forum"]['title'].'/'.$data[0]["Topic"]["forum_id"].'/'.$Element[0]["User"]["id"].'/'.$data[0]["Topic"]["id"], null, null, false);
//aarkerio/CakePHP/7/1/1
echo $this->Html->link($this->Html->image('static/new_post.gif', array('alt'=>"New topic", 'title'=>"New topic")),
                             '/topics/add/'.$Element[0]["User"]["username"].'/'.$data[0]["Forum"]['title'].'/'.$data[0]["Topic"]["forum_id"].'/'.$Element[0]["User"]["id"], 
                             null, null, false);
  
  echo '<div style="border:1px dotted gray;padding:4px;margin-bottom:15px">';
    foreach ($data as $val)
    {
       echo '<div style="padding:4px;border-top:1px solid #598b37;">';
       echo '<div style="padding:4px;background-color:#c2c3cc;"><b>' . $val["Topic"]["subject"] .'</b>    &nbsp;' . $val["User"]["username"] . ' wrote: </div>';
       echo '<div style="padding:6px;background:white url(/img/static/grey-gradient.jpg) top repeat-x">' . $val["Topic"]["message"] . '</div>';
       echo '<div style="padding:4px;font-size:6pt">' . $val["Topic"]["created"] . '</div>';
       echo '</div>';
     }
  echo '</div>';
  
//show extra buttons if page is large
if ( count($data) > 3)
{
  echo $this->Html->link($this->Html->image('static/post_reply.gif', array('alt'=>"Post Reply", 'title'=>"Post Reply")), 
  '/topics/add/'.$Element[0]["User"]["username"].'/'.$data[0]["Forum"]['title'].'/'.$data[0]["Topic"]["forum_id"].'/'.$Element[0]["User"]["id"].'/'.$data[0]["Topic"]["id"], null, null, false);
  //aarkerio/CakePHP/7/1/1
  echo $this->Html->link($this->Html->image('static/new_post.gif', array('alt'=>"New topic", 'title'=>"New topic")),
                             '/topics/add/'.$Element[0]["User"]["username"].'/'.$data[0]["Forum"]['title'].'/'.$data[0]["Topic"]["forum_id"].'/'.$Element[0]["User"]["id"], 
                             null, null, false);
}
  
?>
