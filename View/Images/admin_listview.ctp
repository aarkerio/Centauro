<table style="width:100%;border-collapse:collapse;border:1px solid dotted">
<tr>
  <td style="text-align:left;" colspan="5">
  
  <?php echo $this->Form->create('/admin/images/add/','post', array("enctype"=>"multipart/form-data") ); ?>
  <?php echo $this->Form->hidden('Image.return', '/admin/images/listview'); ?>
  <fieldset>
     <legend>Upload Image</legend>
     
     <?php echo $this->Form->label('Image.file', 'Title:' );
           echo $this->Html->file('Image.file'); 
           echo $this->Form->error('Image.file', 'Title is required.'); 
           echo $this->Form->end('Upload'); ?>
</fieldset>
</form>
</td>
</tr>

<?php

$counter = 0; // five images in one row

foreach ($data as $val) 
{  
   $counter++;
   
   $image_stats = getimagesize('img/imgusers/'.$val['Image']['file']);
   
   if ( $counter == 1 ) // open new row
   {
        echo "<tr>";
   }
?>
<td style="text-align:center;padding:3px;vertical-align:top;"><span style="font-size:8px;"><?php echo '/img/imgusers/'.$val['Image']['file']; ?></span><br /><br />

<?php 

$tooltip = 'W:'.$image_stats[0].' H:'.$image_stats[1] . ' counter' . $counter;

echo $this->Html->link($this->Html->image('imgusers/thumbs/'.$val['Image']['file'], array('alt'=>$tooltip, 'title'=>$tooltip)), '/img/imgusers/'.$val['Image']['file'], null, null, false); ?>

 <br />
   <?php 
   if ($this->Session->read('Auth.User.id') == $val['Image']['user_id'] )
   {
        echo  $this->Form->create('/admin/images/delete/'.$val['Image']['id'], 'post');
        echo $this->Form->hidden('Image.return', '/admin/images/listing');
        echo  $this->Form->end('Delete');
        echo "</form>";
   }
   ?>
   </td>

<?php 
    if ( $counter == 5 )
    {
        print "</tr>";
        $counter = 0; //reset counter
    }
  }
    
  if ( $counter < 5 )
  {
	   $colspan = (5 - $counter);
	   print '<td colspan="'.$colspan.'">&nbsp;</td></tr>';  // fill the row with column
	  
  }
?> 
</table>
