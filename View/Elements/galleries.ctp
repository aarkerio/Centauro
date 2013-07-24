<?php
$data = $this->requestAction('/galleries/listing/'.$blogger_id);
#die(debug($data));
if ( $data  ):
    echo  $this->Html->div(Null, $this->Html->image('admin/your-galleries.png', array('alt'=>'Mis Albums', 'title'=>'Mis albums')),
                      array('style'=>'margin:10px 0 0 0;text-align:center;'));
    echo '<div style="padding:2px"><ul>';
    foreach ($data as $val):
        echo '<li>'.$this->Html->link($val['Gallery']['title'], '/photos/display/'.$username.'/'.$val['Gallery']['id'], 
                 array('class'=>'chiki', 'title'=>'Galeria '.$val['Gallery']['title'])) . '</li>';
    endforeach;
    echo '</ul></div>';
endif;
# ? > EOF
