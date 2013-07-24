<?php

$message = $this->requestAction('messages/chkMessage'); 

if ( $message ):
    echo $this->Html->div(null, 
                   $this->Html->link($this->Html->image('static/new_message.gif', 
                               array('alt'=>'You have a new message', 'title'=>'You have a new message')), 
	      '/admin/messages/listing', null, null, false),
                array('style'=>'position:absolute;top:25px;right:300px;padding:4px')
    );
    endif;
?>