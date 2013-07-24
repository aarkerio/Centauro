<?php echo $this->Html->scriptStart(); ?>
 function maximus() 
 {
   var maxchars = 199;
   campo = document.getElementById('WaydingTask');
   
   if (campo.value.length > maxchars)
   {
      alert('Too much data in the text box! Please remove '+ (campo.value.length - maxchars)+ ' characters');
      return false; 
   } 
   //alert('dsfsdfssda');
   return true;
 }

 function limpia() 
 {
   campo = document.getElementById('WaydingTask');
   campo.value = "";
 }
<?php
echo $this->Html->scriptEnd();
//var_dump($waydings);

$Wayds = $this->requestAction('waydings/lastWaydings');

echo $this->Html->image('static/qehac.gif', array('alt'=>'Que estas haciendo?', 'title'=>'Que estas haciendo?', 'style'=>'margin-right:5px 0 10px 0'));

if ($this->Session->check('Auth.User')):
echo $this->Gags->imgLoad('cargando');

 echo $this->Form->create();
 echo $this->Form->textarea('Wayding.task', array('cols' => 20, 'rows' => 3, 'wrap'=>'hard','class'=>'waydingform', 
     'onblur'=>"if (this.value=='') this.value='Que estas haciendo?';", 'onfocus'=>"if (this.value=='Que estas haciendo?') this.value='';"));
     echo $this->Js->submit('Send', array(
                                     'url'         => '/waydings/addwayd',
                                     'class'       => 'waydingform',
                                     'update'      => '#estuve',
				                     'condition'   => 'maximus()',
                                     'evalScripts' => True,
                                     'before'      =>  $this->Gags->ajaxBefore('estuve', 'cargando'),
                                     'complete'    =>  $this->Gags->ajaxComplete('estuve', 'cargando').'limpia();'
                                          )
                           );
  echo '</form><br />';
endif;
echo$this->Gags->ajaxDiv('estuve');

foreach ($Wayds as  $val):
      echo $this->Html->link($this->Html->image('avatars/'.$val['User']['avatar'], array('alt'=>$val['User']['username'], 'title'=>$val['User']['username'], 
                                                                                         'width'=>20, 'style'=>'margin-right:5px')),  '/blog/' .$val['User']['username'], array('escape'=>False));
      
      echo '<span style="font-size:6pt;font-weight:bold">'.$val['User']['username'] .' est&aacute;:</span> <br />';
      echo '<span style="font-size:7pt;">'.Sanitize::html($val['Wayding']['task']) .'</span> <br />';
      echo '<span style="font-size:6pt;">'.$this->Time->timeAgoInWords($val['Wayding']['created']) .'</span><br /><br />';
endforeach;
echo $this->Html->link('Que estuvimos haciendo >>', '/waydings/display', array('style'=>'font-size:7pt'));
echo $this->Gags->divEnd('estuve');

# ? > EOF

