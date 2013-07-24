<?php
echo $this->Html->div(null, null, array('style'=>'width:50%;margin:0 auto 0 auto;border:1px dotted orange;padding:15px'));

if ( isset($error) ):
        echo '<span style="color:red;padding:7px;">Error: no such key.</span>';
endif;

if ( isset($pwd) ):
    echo '<span style="color:blue;padding:7px;">Your new password is <b>' . $pwd . '</b>, don\'t lose  it! ;-)</span> <br />';
    
    echo $this->Html->link('login', '/users/login');
endif;
?>
</div>
