<?php 
 echo $javascript->link('fckeditor/fckeditor'); 

 echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
 echo $this->Html->addCrumb('Downloads', '/admin/downloads/listing');  
 echo $this->Html->getCrumbs(' > '); 
 echo $this->Html->div('title_section', 'Downloads');

 echo $this->Form->create('Download');
?>
<fieldset>
<legend>New Download</legend>
<table>
<tr>
  <td>
      <?php echo $this->Form->input('Download.title', array('size' => 40, 'maxlength' => 50)); ?>
   </td>
  <td>
  <?php
       echo $this->Form->label('Download.catdownload_id', 'Software Category' );
      echo $this->Form->select('Download.catdownload_id', $catdownloads, null, array(), false);
  ?>
  </td>
  <td>
         <?php echo $this->Form->input('Download.url', array('size' => 40, 'maxlength' => 200, "value"=>"http://")); ?>
     </td>
</tr>
<tr>
<td colspan="3">
  <?php echo $this->Form->label('Download.Description', 'Description:');
        echo $this->Form->textarea('Download.description', array("cols"=>80, "rows"=>45)); 
        echo $fck->load('Download.description', 'Karamelo'); 
        echo $this->Form->error('Download.description');
   ?>
</td>
</tr>
<tr>
<td colspan="3">
  <?php echo $this->Form->end('Save'); ?>
</fieldset>
</form>
</td></tr></table>
