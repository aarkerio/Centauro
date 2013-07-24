<h2>About me</h2>

<div style="padding:7px;margin:10px;border:1px dotted gray;">
<?php
//die( var_dump($blog) );
    echo  $this->Html->div('title_section', 'Here I am');
    echo  $data['User']['name']  . ' <br />';
    echo  $data['User']['cv']    . ' <br />';
    echo  $this->Html->image('avatars/'.$data['User']['avatar'], array('alt' => $data['User']['name'], 'title' =>$data['User']['name'])) . ' ';
?> 
</div>
