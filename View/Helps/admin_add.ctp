<?php echo $this->Html->script('fckeditor/fckeditor'); ?> 
<?php echo $this->Html->addCrumb('Control Tools', '/admin/entries/start'); ?> 
<?php echo $this->Html->addCrumb('News', '/admin/news/listing'); ?> 
<?php echo $this->Html->getCrumbs(' / '); ?>

<?php echo $this->Form->create('/admin/news/add/','post', array("onsubmit"=>"return validateNew()")); ?>

<fieldset>
<legend>Add new</legend>

<table>
<tr>
  <td>
  <?php echo $this->Form->label('News.title', 'Title' ); ?><br /> 
  <?php echo $this->Form->input('News.title', array('size' => 25, 'maxlength' => 100)); ?>
  <?php echo $this->Form->error('News.title', 'Title is required.'); ?>
</td>

<td>
  <?php echo $this->Form->label('News.theme_id', 'Theme:');?><br />
      <?php  echo $this->Html->selectTag('News.theme_id', $themes, null, null, null, false);  ?>
</td>

<td>
  <?php echo $this->Form->label('News.reference', 'Reference' );?><br /> 
  <?php echo $this->Form->input('News.reference', array('size' => 25, 'maxlength' => 200, "value"=>"http://")); ?>
</td>

<td>
  <?php echo $this->Html->link($this->Html->image('admin/myimages.jpg', array('alt'=>"My Images", 'title'=>"My Images")), '#', array("onclick"=>"javascript:window.open('/admin/images/listing/set', 'blank', 'toolbar=no, scrollbars=yes,width=700,height=500')"), null, false) ?>
</td>
</tr>

<tr>
<td colspan="4">

  <?php echo $this->Form->label('News.Body', 'Text:' );?><br />
  <?php echo $this->Form->textarea('News.body', array("cols"=>80, "rows"=>45)) ?>
  <?php echo $fck->load('News.body', 'Karamelo'); ?> 
  <?php echo $this->Form->error('News.body', 'Body is required.'); ?>

<td>
</tr>
<tr>
  <td><?php echo $this->Form->label('News.status', 'Published:' );?><?php echo $this->Form->checkbox('News.status'); ?></td>
       
  <td><?php echo $this->Form->label('News.comments', 'Comments allowed:' );?><?php echo $this->Form->checkbox('News.comments'); ?></td>
        
  <td colspan="2"><?php echo $this->Form->label('News.end', 'End edition:');?><?php echo $this->Form->checkbox('News.end'); ?></td>
</tr>
<tr>
<td colspan="4">
  <?php echo $this->Form->end('Send'); ?>
</fieldset>
</form>
</td></tr>
</table>
