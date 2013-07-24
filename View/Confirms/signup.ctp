<div style="padding:12px;margin:15px;border:1px dotted gray ">
<?php
 if ( isset($msg) ):
    echo $msg . '<br />';
    echo $this->Html->link(__('Now you can login', True), '/users/login');   
 else:
     echo __('The registration process has failed miserably', True);
 endif;
?>
</div>
