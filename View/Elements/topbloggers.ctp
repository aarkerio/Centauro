<?php

$top = $this->requestAction('users/topBloggers');

if ( count($top) > 0):
   echo $this->Html->div('menumain', 'Top  bloggers');
endif;


foreach ($top as $val):
   #$total=count($val['Comentblog']);
   echo $this->Html->div(null, $this->Html->link($val[0]['username'], 
                          '/blog/'.$val[0]['username']) . 
                           ' <span style="font-size:6pt">'.$val[0]['count'].'</span>', 
                           array('style'=>'margin-top:4px;padding-left:2px;text-align:left;')
                   );
endforeach;
    
# ? > EOF
