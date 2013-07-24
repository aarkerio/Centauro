<?php
 if ( !$this->Session->check('Auth.User') ):
	   echo $this->Html->link(
                            $this->Html->image('admin/mn-nuevo.gif', array('alt'=>'Nuevo?', 'title'=>'Nuevo?')), '#', 
                            array("onclick"=>"window.open('/helps/tour','mywindow','width=600,height=600')"), null, null, fa
?>