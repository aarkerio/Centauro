<?php 
#exit(debug($data));
$this->Html->addCrumb('Control Panel', '/admin/entries/start'); 
$this->Html->addCrumb('vClassrooms', '/admin/vclassrooms/listing/');
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->div('title_section', $this->Html->image('admin/your-forums.png', array('style'=>'width:35px;margin-right:6px;', 'alt'=>__('Forums', True), 'title'=>__('Forums', True))).' '.__('Categories Forums', True));

echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>__('Add new', True),'title'=>__('Add new',True))),'#',array('escape'=>False,'onclick'=>'hU()')); 
?>

<table style="width:100%;border-collapse:collapse;">

<?php 
#Hide or show Add Form
if (isset($show)): 
    echo "<tr style=\"text-align:left;display:block;border:1px dotted grey;padding:6px\" id=\"trh\">"; 
else: 
    echo "<tr style=\"text-align:left;display:none;border:1px dotted grey;padding:6px\" id=\"trh\">";  
endif; ?> 
<td colspan="7">
  <?php echo $this->Form->create('Catforum', array('action'=>'add', 'onsubmit'=>'return chkData()')); ?>
  <fieldset>
     <legend><?php __('Add new forum category'); ?></legend>
     <?php 
     echo $this->Form->input('Catforum.title', array('size'=>50, 'maxlength'=>150, 'label'=>__('Title', True), 'class'=>'required'));  
     echo $this->Form->input('Catforum.description', array('size'=>70, 'maxlength'=>150, 'label'=>__('Description', True)));
     echo $this->Form->end(__('Save', True)); 
     ?>
</fieldset>
</td>
</tr>
<?php
$msg   = __('Are you sure to want to delete this?', True);
$th = array(__('Edit', True),__('Add new', True),__('Title', True),__('Description', True), __('Delete', True), '&nbsp;');

echo $this->Html->tableHeaders($th);

foreach ($data as $val):
    $tr = array ( 
               $this->Html->link($this->Html->image('static/edit_icon.gif', array('width'=>'14px', 
                        'alt'=>__('Edit', True), 'title'=>__('Edit', True))), '/admin/catforums/edit/'.$val['Catforum']['id'], array('escape'=>False)),
               $this->Html->link($this->Html->image('admin/add-forum.jpg', array('alt'=>__('Add new', True), 'title'=>__('Add new', True))), 
                                 '/admin/forums/edit/'.$val['Catforum']['id'], array('escape'=>False)),
               '<b>'.$val['Catforum']['title'].'</b>',
               $val['Catforum']['description'],
               $this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'16px', 'alt'=>__('Delete', True), 
                          'title'=>__('Delete', True))), '/admin/catforums/delete/'.$val['Catforum']['id'],
                                 array('onclick'=>"return confirm('".$msg."')", 'escape'=>False)),
               '&nbsp;',  '&nbsp;'
   );
   
  echo $this->Html->tableCells($tr, array('style'=>'border:1px solid gray;background-color:#c0c0c0'), 
                                   array('style'=>'border:1px solid gray;background-color:#c0c0c0'));
  
  foreach ( $val['Forum'] as $v):  # forums in catforum
      if ($v['status'] == 1):
          $img   = 'static/status_1_icon.png';
          $st    = __('Published', True);
      else:
          $img   = 'static/status_0_icon.png';
          $st    = __('Draft', True);
      endif;
      echo '<tr><td>&nbsp;</td><td>'.$this->Html->link($this->Html->image('static/edit_icon.gif', array('width'=>'14px', 
                        'alt'=>__('Edit', True), 'title'=>__('Edit', True))), 
                         '/admin/forums/edit/'.$v['catforum_id'].'/'.$v['id'], array('escape'=>False)) .'</td>';
      echo '<td>'.$this->Html->link($v['title'], '/forums/display/'.$this->Session->read('Auth.User.username').'/'.$v['id']) .'</td>';
      echo '<td colspan="2"> '. $v['description'] .' </td>';
      echo '<td>'. $this->Html->link($this->Html->image($img, array('width'=>'14px', 'alt'=>$st, 'title'=>$st)), 
                       '/admin/forums/change/'.$v['status'].'/'.$v['id'], array('escape'=>False)).'</td>';
      echo '<td>'. $this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'16px', 'alt'=>__('Delete', True), 
                          'title'=>__('Delete', True))), '/admin/forums/delete/'.$v['id'],
                                    array('onclick'=>"return confirm('".$msg."')", 'escape'=>False)) . '</td> </tr>';
   endforeach;
endforeach;
?>
</table>
<script type="text/javascript"> 
/* <![CDATA[ */
function hU() 
{
  var tr = document.getElementById('trh');

  if (tr.style.display == 'none')
  {
            tr.style.display = '';
  } else {
            tr.style.display = 'none';
  }
}
/* ]]> */
</script>
