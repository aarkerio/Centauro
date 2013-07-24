<?php
#die(debug($data));
$this->set('title_for_layout',  $blogger['User']['username'] . '\'s Blog');

foreach ($data as $val):  
    $user_id   =  $val['Entry']['user_id'];
    $link      =  '/entries/view/'.$blogger['User']['username'].'/'.$val['Entry']['id'];
    echo '<h3>'.$this->Html->link($val['Entry']['title'],$link,array('class'=>'title')) . '</h3>';
    echo $this->Html->div('date_entry', $val['Entry']['created']);
    echo '<h4>'. $val['Themeblog']['title'].'</h4>';
    $bodyText = preg_replace('=\(.*?\)=is', '', $val['Entry']['body']);
    $bodyText = $this->Text->truncate($bodyText, 400, array(
                                                            'ending' => '...',
                                                            'exact'  => True,
                                                            'html'   => True,
                                                            ));

    echo $this->Html->div('body_entry', $bodyText);
    
    $pl = 'Permalink: http://' . $_SERVER['SERVER_NAME'] . $link;
    
    echo $this->Html->para(null, $this->Html->link($pl,$link, array('style'=>'font-size:7pt')));
    
    if ( $val['Entry']['discution'] == 1):
        echo $this->Html->div(NUll, $this->Html->link('Add comment ('.count($val['Commentblog']).')', $link, array('style'=>'font-size:7pt')), 
                              array('id'=>'new_comment'));
    endif;
    echo '<hr />';
endforeach;

$this->Paginator->options(array('url' => $blogger['User']['username']));

$t  = $this->Html->div(null,$this->Paginator->prev('«'. __('Previous').' ',Null,null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(null, $this->Paginator->next(' '.__('Next').' »', Null, null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));
# ? > EOF