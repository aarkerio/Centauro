<?php
die(var_dump($data));
echo '<div>';
echo $this->Html->link($this->Html->image('statics/new_topic.gif', array('alt'=>"New topic", 'title'=>"New topic")), '/topics/add/'.$blog[0]["User"]["id"].'/'.$phorum_id, false, false, null); 
echo '</div>';
echo '<div style="padding:5px;border:1px dotted black;background-color:#c0c0c0;margin:10px 5px 10px 5px">';
    
foreach ($data as $key => $val) {
    echo '<div> Title:<a href="/topics/display/'.$blog[0]["User"]["id"].'/'.$phorum_id.'/'.$data[$key]['Topic']['id'].'">' . $data[$key]['Topic']['subject'].'</a></div>'; 
}
echo '</div>';

if (count($data) == 0)
{
   echo '<p>There is no topics on this phorum, add new clicking over <b>New Topic</b></p>';
}

echo '<div>';
echo $this->Html->link($this->Html->image('static/new_topic.gif', array('alt'=>"New topic", 'title'=>"New topic")), '/topics/add/'.$blog[0]["User"]["id"].'/'.$phorum_id, false, false, null); 
echo '</div>';

?>
