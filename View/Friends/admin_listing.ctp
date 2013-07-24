<?php exit('oops esta madreola aun no esta hecha'); ?>
<div class="title_section">Quick News</div>

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

<p>
    <?php echo $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>"Add new", 'title'=>"Add new")), '#', 
    array("onclick"=>"hU()"), false, false) ?>
</p>
    
<table class="tbadmin" id="tbl">
<tr>
  <td style="text-align:left;display:none" id="trh" colspan="5">
  <?php echo $this->Form->create('/admin/friends/add/','post'); ?>
  <fieldset>
     <legend>New Friend</legend>
     <?php 
           echo $this->Form->label('Friend/title', 'Title:') . $this->Form->input('Friend/title', array('size'=>40, 'maxlength'=>100));
           echo $this->Form->label('Friend/reference', 'Reference:' );
           echo $this->Form->input('Friend/reference', array('size'=>40, 'maxlength'=>200, "value"=>"http://"));
           echo $this->Form->end('Send'); 
     ?>
</fieldset>
</form>
</td>
</tr>

<?php
//die(print_r($data));

$th = array ('Title', 'Delete');
echo $this->Html->tableHeaders($th);	
foreach ($data as $key=>$val)
 {
            
       $tr = array (
        $val['Friend']['title'],
        $this->Gags->confirmDel($val['Friend']['id'], 'quicks')
        );
       
    echo $this->Html->tableCells($tr, array('class'=>"altRow", "onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='altRow'"), 
                                array('class'=>'evenRow',"onmouseover"=>"this.className='highlight'", "onmouseout"=>"this.className='evenRow'"));
 }
?>
</table>
