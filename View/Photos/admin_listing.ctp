<?php 
#exit(debug($data));
$this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
$this->Html->addCrumb('Galleries', '/admin/galleries/listing');
echo $this->Html->getCrumbs(' > ');
echo $this->Html->div('title_section', 'Photos');
if (count($data) == 0):
    echo $this->Html->div(null, 'No fotos yet in this gallery');
endif;
echo $this->Html->div(null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new', 'title'=>'Add new')), '#', 
                                              array('onclick'=>'hU()', 'escape'=>False)));
?>
<table style="width:100%;border-collapse:collapse;border:1px dotted gray" id="tbl">
<tr>
  <td style="text-align:left;display:none" id="trh" colspan="5"> 
 <?php 
    echo $this->Form->create('Photos', array('type'=>'file', 'action'=>'add'));
  echo $this->Form->hidden('Photo.gallery_id', array('value'=>$gallery_id));
 ?>
<fieldset>
<legend>Upload Photo</legend>
 <?php 
   echo $this->Form->input('Photo.title', array('size'=>20, 'maxlength'=>30, 'value'=>"Lugar de la foto... ")) . '<br />';
   echo $this->Form->input('Photo.description', array('size'=>20, 'maxlength'=>30, 'value'=>"Vacaciones del 2009 en...")) . '<br />';
   echo $this->Form->input('Photo.file', array('type'=>'file'));
   echo $this->Form->end('Upload', array('onclick'=>"confirm('Are you sure?')"));
 ?>
</fieldset>
</td>
</tr>
<?php
$msg     = __('Are you sure? This is an irreversible operation');
$counter = 0; # five images in one row
foreach ($data as $val):
   $counter++;   
   $image_stats = getimagesize('img/photos/'.$val['Photo']['file']);
   
   if ( $counter == 1 ): # open new row
        echo '<tr>';
   endif;
?>
<td style="text-align:center;padding:3px;vertical-align:top;"><span style="font-size:8px;">
   <?php echo '/img/photos/'.$val['Photo']['file']; ?></span><br /><br />
<?php 

$tooltip = 'W:'.$image_stats[0].' H:'.$image_stats[1] . ' counter' . $counter;

echo $this->Html->link($this->Html->image('photos/thumbs/'.$val['Photo']['file'], array('alt'=>$tooltip, 'title'=>$tooltip)), '/img/photos/'.$val['Photo']['file'], array('escape'=>False)); 
echo ' <br />';
if ($this->Session->read('Auth.User.id') == $val['Photo']['user_id'] ):
    echo  $this->Form->create('Photo', array('action'=>'delete',  'onsubmit'=>"return confirm('$msg')"));
        echo  $this->Form->hidden('Photo.return',  array('value'=>'/admin/photos/listing/'. $val['Photo']['gallery_id']));
        echo  $this->Form->hidden('Photo.id',  array('value'=>$val['Photo']['id']));
        echo  $this->Form->end('Delete');
endif;

echo '</td>';

if ( $counter == 5 ):
    print '</tr>';
    $counter = 0;  # reset counter
endif;
endforeach;
    
if ( $counter < 5 ):
	$colspan = (5 - $counter);
	print '<td colspan="'.$colspan.'">&nbsp;</td></tr>';  # fill the row with column
endif;
?> 
</table>
<script type="text/javascript"> 
<!-- 
function hU() {

var tr = document.getElementById('trh');

  if (tr.style.display == 'none')
  {
            tr.style.display = 'table-row';
  } else {
            tr.style.display = 'none';
  }
}
-->
</script>