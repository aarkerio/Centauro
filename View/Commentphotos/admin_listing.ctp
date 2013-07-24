<?php
# die(debug($data));
$this->Html->addCrumb('Control Panel', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' > '); 
echo $this->Html->div('title_section', 'Comments on your photos');

$i = 1;
foreach ($data as $val):
    $bg = ($i%2==0) ? '#e2e2e2' : '#fff';
    $i++;
    echo '<div style="margin:8px 2px 8px 2px;padding:5px;border:1px dotted gray;background-color:'.$bg.'">';
    echo  $this->Html->link($val['Photo']['title'], '/photos/view/'.$this->Session->read('Auth.User.username') .'/'.$val['Photo']['id'], array('style'=>'font-size:14pt;font-weight:bold')) . '<br />';
    
    if ( $val['Comentphoto']['user_id'] == 0 ): # the user does not belong to portal, or not was logged
        $user =  '<b>' . $val['Comentphoto']['username'] . '</b>';
    else:
        $user =  $this->Html->link($val['Comentphoto']['username'], '/blog/'.$val['Comentphoto']['username']);
    endif;
    
    echo '<p style="font-size:8pt;font-weight:bold">On ' . $val['Comentphoto']['created'] . '  ' . $user .'  wrote: </p>';
    echo  nl2br($val['Comentphoto']['coment']) . '<br /><br />';    
    echo  '<div style="float:right">'.$this->Gags->sendEdit($val['Comentphoto']['id'], 'comentphotos'). '</div>';   
    echo  $this->Gags->confirmDel($val['Comentphoto']['id'], 'comentphotos') . "<br />";
    echo '</div>';
endforeach;

# ? > EOF