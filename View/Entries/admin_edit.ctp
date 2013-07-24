<?php 
$editor = $this->Session->read('Auth.User.fck'); # editor enabled?
#$helps = $this->Session->read('Auth.User'); # helps enabled
#debug($helps);

if ( $editor ):
    echo $this->Html->script('ckeditor/ckeditor'); 
endif;
echo $this->Html->div('spaced');
 
$this->Html->addCrumb('Control Tools', '/admin/entries/start');  
$this->Html->addCrumb('Entries', '/admin/entries/listing'); 
echo $this->Html->getCrumbs(' > ');

echo $this->Form->create('Entry', array('action' => 'edit'));  
if (!empty($this->request->data) && isset($this->request->data['Entry']['id'])): 
    echo $this->Form->input('Entry.id', array('type'=>'hidden'));
    $legend = __('Edit Entry');
else:
    $legend = __('New Entry');
endif;
?>
<fieldset>
<legend><?php echo $legend; ?></legend>
<table>
<tr>
  <td>
  <?php echo $this->Form->input('Entry.title', array('size' => 40, 'maxlength' => 50)); ?>
  </td><td>
  <?php   echo $this->Form->input('Entry.themeblog_id', array('options'=>$themes));   ?>
  </td><td>
  <?php echo $this->Gags->setImages(); ?>
  </td>
</tr>
<tr>
<!-- TAGS -->
<tr>
<td colspan="3" id="nuevo">
     <?php echo $this->Form->input('Entry.tags', array('size' => 100, 'maxlength' => 100, 'readonly'=>'readonly')); ?>
</td></tr>
<tr><td colspan="3">
<?php
  foreach ($etis as $T):
        $t = trim($T);
        echo $this->Html->link(trim($t), '#header', array("onclick"=>"addTag('$t')", "style"=>"font-size:7pt")) . " ";
  endforeach;
?>
</td>
</tr>
<!-- TAGS END -->
<td colspan="3">
<?php 
   echo $this->Form->input('Entry.body', array('cols'=>90, 'rows'=>35, 'label'=>False));
   if ( $editor ):   
       echo $this->Ck->load('EntryBody', 'Karamelo');
   endif;
?>
</td>
</tr>
<tr>
 <td>
      <?php echo $this->Form->input('Entry.status', array('type'=>'checkbox', 'value'=>'1')); ?>
  </td>
  <td>
      <?php echo $this->Form->input('Entry.discution',array('type'=>'checkbox', 'value' => '1')); ?>
   </td>
   <td>
      <?php echo $this->Form->input('Entry.end',array('type'=>'checkbox','value' => '1')); ?>
   </td>
</tr>
<tr>
<td colspan="3">
  <?php echo $this->Form->end('Save'); ?>
</fieldset>
</td></tr>
</table>
