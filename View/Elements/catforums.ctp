<div style="padding:4px">
<?php
$username = $Element[0]["User"]["username"];
//foreach ($Element[0]["Catforum"] as $key => $val) {
      echo $this->Html->link($this->Html->image('static/blog_forums.gif', array('alt'=> $username."'s Forums", 'title'=> $username."'s Forums")), 
              '/catforums/display/'.$username.'/'.$Element[0]["Catforum"][0]['user_id'], array('class'=>"chiki"), null, null, false) . '<br />';
//}
?>
</div>

