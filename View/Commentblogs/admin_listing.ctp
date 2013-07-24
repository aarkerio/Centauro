<?php
# die(debug($data));
$this->Html->addCrumb('Control Panel', '/admin/entries/start'); 
echo $this->Html->getCrumbs(' / '); 

echo $this->Html->div('title_section', 'Comments on your blog');

$i = 1;
foreach ($data as $val):
    $bg = ($i%2==0) ? "#e2e2e2" : "#fff";
    $i++;
    echo '<div style="margin:8px 2px 8px 2px;padding:5px;border:1px dotted gray;background-color:'.$bg.'">';
    
    echo  $this->Html->link($val['Entry']['title'], '/entries/view/'.$this->Session->read('Auth.User.username') .'/'.$val['Entry']['id'], array('style'=>"font-size:14pt;font-weight:bold")) . "<br />";
    
    if ( $val['Commentblog']['user_id'] == 0 ): # the user does not belong to portal, or not was logged in
        $user = '<b>' . $val['Commentblog']['username'] . '</b>';
    else:
        $user = $this->Html->link($val['Commentblog']['username'], '/blog/'.$val['Commentblog']['username']);
    endif;
    
    echo '<p style="font-size:8pt;font-weight:bold">On ' . $val['Commentblog']['created'] . '  ' . $user ."  wrote: </p>"; 
    echo  nl2br(Sanitize::html($val['Commentblog']['comment'])) . '<br /><br />';
    echo  '<div style="float:right">'.$this->Gags->sendEdit($val['Commentblog']['id'], 'commentblogs'). "</div>";
    
    echo  $this->Gags->confirmDel($val['Commentblog']['id'], 'commentblogs') . '<br />';
    echo '</div>';
endforeach;

# ? > EOF