<?php
echo $this->Html->div('title_section', $this->Session->read('Auth.User.username') . ' themes');

echo $this->Html->para(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add entry', 'title'=>'Add entry')), '#', array('onclick'=>'javascript:showHide();', 'escape'=>False)));
?>
<div id="add" style="display:none;">
<?php  echo $this->Form->create('Themeblog', array('action'=>'edit')); ?>
<fieldset>
<legend>New blog Theme</legend>
<?php
  echo $this->Form->input('Themeblog.title', array('size' => 40, 'maxlength' => 100)); 
  echo $this->Form->end('Save');
  echo "</fieldset></div>";

  echo $this->Gags->ajaxDiv('container', array('style'=>'border:1px dotted green;padding:8px;width:600px'));
  foreach ($data as $val):
      echo $this->Html->div(null);
      echo $this->Html->link('Delete', "/admin/themeblogs/delete/{$val['Themeblog']['id']}",
                              array('onclick'=>"return confirm('Are you sure you want to delete this theme and entries associated?')"));       
      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['Themeblog']['title'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      echo $this->Html->link('Edit', "/admin/themeblogs/edit/{$val['Themeblog']['id']}");
      echo '</div>';
  endforeach;
echo $this->Gags->divEnd('container');
?>

<script lenguage="javascript">
/* <![CDATA[ */
function showHide() 
{
    var target1 =  document.getElementById('add');
    
    if (target1.style.display=="none") 
    {
        target1.style.display ="block";
    } else {
        target1.style.display ="none";
    }
}
/* ]]> */
</script>
