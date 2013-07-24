
<?php echo $this->Html->script('fckeditor/fckeditor'); ?> 

<div class="spaced">

<?php echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); ?> 
<?php echo $this->Html->addCrumb('Sections', '/admin/pages/sections'); ?> 
<?php echo $this->Html->getCrumbs(' / '); ?>

<?php echo $this->Form->create('/admin/pages/edit/','post'); ?>
<?php echo $this->Form->hidden('Page.id'); ?>

<fieldset>
<legend>Edit new</legend>
<table style="margin:0 auto 0 auto;border-collapse:collapse">
<tr>
  <td>
    <?php 
        echo $this->Form->label('Page.title', 'Title' ); 
        echo $this->Form->input('Page.title', array('size' => 40, 'maxlength' => 100));
        echo $this->Form->error('Page.title', 'Title is required.'); 
    ?>
  </td>
  <td>
   <?php
        echo $this->Form->label('Page.section_id', 'Section:' );
        echo $this->Form->select('Page.section_id', $sections, null, null, null, false); 
   ?>
</td>
<td>
  <?php 
     $display = array(1=>"En cintillo", 2=>"En pagina y cintillo", 3=>"No desplegar");
     echo $this->Form->label('Page.display', 'Title:');
     echo $this->Form->select('Page.display', $display, 2, null, null, false);  
  ?>
</td>
  <td> 
       <?php echo $this->Gags->setImages(); ?>
  </td>
</tr>
<tr><td colspan="4">
  <?php echo $this->Form->label('Page.Body', 'Text:' );?><br />
  <?php echo $this->Form->textarea('Page.body', array("cols"=>80, "rows"=>65)) ?>
  <?php echo $fck->load('Page.body', 'Karamelo', 800, 500); ?> 
  <?php echo $this->Form->error('Page.body', 'Body is required.'); ?>
  </td>
</tr>
<tr>
  <td><?php echo $this->Form->label('Page.status', 'Published:' );             echo $this->Form->checkbox('Page.status',   array('value' => 1)); ?> </td>
  <td><?php echo $this->Form->label('Page.cv', 'Show my CV:' );                echo $this->Form->checkbox('Page.cv',       array('value' => 1)); ?> </td>
  <td><?php echo $this->Form->label('Page.discution', 'Comments allowed:' );   echo $this->Form->checkbox('Page.discution',array('value' => 1)); ?> </td>
  <td><?php echo $this->Form->label('Page.end', 'End edition:' );              echo $this->Form->checkbox('Page.end',      array('value' => 1)); ?> </td>
</tr>
<tr><td colspan="4"><?php echo $this->Form->end('Send'); ?></td>
</fieldset>
</form>
  </td>
 </tr>
</table>
