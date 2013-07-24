<?php 
echo $this->Html->div(null, null, array('style'=>'margin:12px auto;padding:15px;border:1px dotted orange;'));
echo $this->Form->create(); 
?>
 <fieldset>
     <legend style="font-size:16pt;color:orange;">Add Quick new</legend>
<?php 
echo $this->Form->input('Quick.title', array('size'=>40, 'maxlength'=>100, 'between'=>': <br />'));
echo $this->Form->input('Quick.reference', array('size'=>50, 'maxlength'=>300, 'value'=>'http://', 'between'=>': <br />'));
echo $this->Form->input('Quick.theme_id', array('options'=>$themes, 'label'=>False));
echo $this->Js->submit('Send', array('url'         => '/quicks/addquick', 
                                       'update'      => '#quicks',
                                       'evalScripts' => True,
                                       'before'      => $this->Gags->ajaxBefore('quicks', 'loading_quick'),';timedMsg();',
                                       'complete'    => $this->Gags->ajaxComplete('quicks', 'loading_quick').';timedMsg();'
));
 echo $this->Form->end(); 
 ?>
</fieldset>
</div>
<?php 
echo $this->Js->writeBuffer();
# ? > 