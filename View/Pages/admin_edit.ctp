<?php 
echo $this->Html->script('ckeditor/ckeditor');
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('Sections', '/admin/pages/sections'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Form->create('Page', array('action' => 'edit')); 

if (!empty($this->data) && isset($this->data['Page']['id'])): 
    echo $this->Form->hidden('Page.id');
      $legend = __('Edit Page');
else:
      $legend = __('New Page');
endif;
?>
<fieldset>
<legend><?php echo $legend; ?></legend>
<table style="margin:0 auto 0 auto;border-collapse:collapse">
<tr>
  <td>
    <?php echo $this->Form->input('Page.title', array('size' => 40, 'maxlength' => 100)); ?>
  </td>
  <td>
  <?php    echo $this->Form->input('Page.section_id',array('type'=>'select'));   ?>
</td>
<td>
  <?php 
   $display = array(1=>'En cintillo', 2=>'En pagina y cintillo', 3=>'No desplegar');
   echo $this->Form->input('Page.display', array('type'=>'select','options'=> $display));  
  ?>
</td>
  <td> 
       <?php echo $this->Gags->setImages(); ?>
  </td>
</tr>
<tr><td colspan="4">
  <?php 
   echo $this->Form->input('Page.body', array('type'=>'textarea','cols'=>100, 'rows'=>40, 'label'=>False));
   if ( $this->Session->read('Auth.User.fck')):
       echo $this->Ck->load('PageBody', 'Karamelo'); 
   endif;
  ?> 
  </td>
</tr>
<tr>
  <td><?php echo $this->Form->input('Page.status', array('value' => '1', 'type'=>'checkbox', 'label'=>'Published')); ?> </td>
  <td><?php echo $this->Form->input('Page.cv',array('type'=>'checkbox', 'label'=>'SHow my CV', 'value' => '1')); ?> </td>
  <td><?php echo $this->Form->input('Page.discussion',array('type'=>'checkbox', 'label'=>'Allow comments', 'value' => '1')); ?> </td>
  <td><?php echo $this->Form->input('Page.end',  array('type'=>'checkbox', 'label'=>'End edition', 'value' => '1')); ?> </td>
</tr>
<tr><td colspan="4"><?php echo $this->Form->end('Send'); ?></td>
</fieldset>
 </td>
 </tr>
</table>
