<?php 
if ( !$set ): 
   $this->Html->addCrumb('Control Tools', '/admin/entries/start'); 
   $this->Html->addCrumb('Images', '#'); 
   echo $this->Html->getCrumbs(' > ');
   echo $this->Html->div('title_section','Images');
   $return = '';
else:
   $return = 'set';
endif;
?>

<table style="width:100%;border-collapse:collapse;border:1px solid dotted">
<tr>
 <td style="text-align:left;" colspan="5">
<?php 
  echo $this->Form->create('Image', array('type'=>'file', 'action'=>'add')); 
  echo $this->Form->hidden('Image.return', array('value'=>'/admin/images/listing/'.$return)); 
?>
 <fieldset>
 <legend>Upload Image</legend>   
 <?php 
    echo $this->Form->input('Image.file', array('type'=>'file')); 
    echo $this->Form->end('Upload'); 
 ?>
</fieldset>
</td>
</tr>
<?php
$counter = 0; # five images in one row
$msg     = __('Are you sure? This is an irreversible operation');
foreach ($data as $val):
   $counter++;
   $image_stats = getimagesize('img/imgusers/'.$val['Image']['file']);
   
   if ( $counter == 1 ): # open new row
       echo '<tr>';
   endif;
?>
<td style="text-align:center;padding:3px;vertical-align:top;">
<span style="font-size:8px;"><?php echo '/img/imgusers/'.$val['Image']['file']; ?></span><br /><br />

<?php 

$tooltip = $val['Image']['file'] . '   W:'.$image_stats[0].' H:'.$image_stats[1];

echo $this->Html->link($this->Html->image('imgusers/thumbs/'.$val['Image']['file'], array('alt'=>$tooltip, 'title'=>$tooltip)), '/img/imgusers/'.$val['Image']['file'], array('escape'=>False)); 

echo '<br />';  
    if ($this->Session->read('Auth.User.id') == $val['Image']['user_id'] ):
         echo  $this->Form->create('Image', array('action'=>'admin_delete', 'onsubmit'=>"return confirm('$msg')"));
         echo  $this->Form->hidden('Image.id', array('value'=>$val['Image']['id']));
         echo  $this->Form->hidden('Image.return', array('value'=>'/admin/images/listing'));
         echo  $this->Form->end('Delete');
         echo  '</form>';
	 endif;
   ?>
   </td>

<?php 
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
<?php
$t  = $this->Html->div(Null,$this->Paginator->prev('«'. __('Previous').' ',Null,Null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(Null,$this->Paginator->next(' '.__('Next').' »',Null, Null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(Null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
echo  $this->Html->div(Null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));

# ? > EOF
