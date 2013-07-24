<?php
if ( $this->Session->check('Auth.User') ):
    echo $this->Html->div('barra', 'Hey you are already logged in! ;-)');
else:
    echo $this->Gags->imgLoad('charging2');
    echo $this->Gags->ajaxDiv('updater').$this->Gags->divEnd('ipdater');

    echo $this->Html->div('spaced', null, array('id'=>'form_register'));
    echo $this->Form->create(); 
    ?>
    <fieldset>
    <legend>Recover password</legend>     
    <?php 
    echo $this->Html->para(Null,  'Type the email used on your account:');
    echo $this->Form->input('Recover.email', array('size' => 20, 'maxlength' => 45, 'value'=>'@')); 
    echo '<br /><br />';
     
    echo $this->Js->submit('Send', array('url' => '/recovers/check/', 
                                         'update'=>'#updater',
                                         'evalScripts' => True,
                                         'before'      => $this->Gags->ajaxBefore('updater', 'charging2'),
                                         'complete'    => $this->Gags->ajaxComplete('updater', 'charging2') ));
    ?>
    </fieldset>
    </form>
    </div>
<?php
endif;
?>
