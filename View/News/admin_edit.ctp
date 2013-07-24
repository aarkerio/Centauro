<?php 
 #exit(debug($this->Session->read('Auth.User.ck')));
 echo $this->Html->script('ckeditor/ckeditor'); 

 $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 $this->Html->addCrumb('News', '/admin/news/listing'); 
 echo $this->Html->getCrumbs(' > '); 

 echo $this->Form->create('News', array('action'=>'edit'));
 if ( isset($this->request->data['News']['id']) ): 
      echo $this->Form->hidden('News.id');
     $legend = __('Edit new');
 else:
     $legend = __('Add new');
 endif;
?>

<fieldset>
<legend>Edit new</legend>
<table>
<tr>
  <td><?php echo $this->Form->input('News.title', array('size' => 25, 'maxlength'=>80, 'class'=>'required')); ?></td>
  <td><?php echo $this->Form->input('News.theme_id', array('type'=>'select')); ?></td>
  <td><?php echo $this->Form->input('News.reference', array('size' => 25, 'maxlength' => 200, 'label'=>'Reference')); ?></td>
  <td><?php echo $this->Gags->setImages(); ?></td>
</tr>
<tr><td colspan="4">
<?php 
   echo $this->Form->textarea('News.body', array('cols'=>80, 'rows'=>65));
   echo $this->Ck->load('NewsBody', 'Karamelo'); 
   echo $this->Form->error('News.body');
 ?>

</td></tr><tr>
<td><?php echo $this->Form->input('News.status',array('value' => '1', 'type'=>'checkbox', 'label'=>'Published')); ?></td>
<td><?php echo $this->Form->input('News.comments', array('type'=>'checkbox', 'label'=>'Allow comments')); ?></td>
<td colspan="2">
   <?php  echo $this->Form->input('News.end',array('value' => '1', 'label'=>'Finish edition', 'type'=>'checkbox')); 
?></td>
</tr>
<tr><td colspan="4">
  <?php echo $this->Form->end('Save');  ?>
</fieldset>
</td></tr>
</table>
