<?php
echo $this->Html->script(array('jquery-min','jquery-validate/jquery.validate'), False);

#die(debug($blogger));

if (  $this->Session->read('Auth.User.id') ):
 echo $this->Html->div(null, __('Category', True).': ' . $data['Catforum']['title'], array('style'=>'font-weight:bold;'));

 echo  $this->Html->div('titentry', $data['Forum']['title']);
 echo  $this->Html->para(Null, $data['Forum']['description']);

  $tmp = $this->Js->link($this->Html->image('static/new_post.gif', array('alt'=>__('New topic', True), 'title'=>__('New topic', True))), 
'/topics/add/'.$data['Forum']['vclassroom_id'].'/'.$data['Forum']['id'].'/'.$blogger['User']['id'],
			                    array('update'      => '#qn',
                                      'evalScripts' => True,
                                      'before'      => $this->Gags->ajaxBefore('qn'),
                                      'complete'    => $this->Gags->ajaxComplete('qn'),
                                      'escape'      => False));
  
 $tmp .= $this->Gags->imgLoad('loading');
 $tmp .= $this->Gags->ajaxDiv('qn', array('style'=>'padding:3px')) . $this->Gags->divEnd('qn');
 echo $this->Html->div(null, $tmp);
  
 #Topics
 echo '<table style="border-collapse:collapse;width:100%">';
 if ( count($data['Topic']) == 0):
     echo '<tr><td colspan="6"><br /><h4>'.__('There is not topic on this forum yet', True).'</h4></td></tr>';
 else:
     $th = array(__('Read', True), __('Topics', True), __('Replies', True), __('Author', True), __('Views', True), __('Last Post', True));
     if ( $blogger['User']['id'] == $this->Session->read('Auth.User.id')):
         array_push($th,  __('Delete', True));
    endif;
    echo $this->Html->tableHeaders($th, array('style'=>'text-align:left'));
 endif;
 #die(print_r($data['Topic']));
            
 foreach ($data['Topic'] as $val):       
    $tr = array (
         $this->Html->image('static/folder.gif'),
         $this->Html->link($val['subject'], '/topics/display/'.$blogger['User']['username'].'/'.$val['forum_id'].'/'.$val['id']),
                   count($val['Reply']),
                   $val['User']['username'],
                   count($val['Visitor']),
                   '<span style="font-size:6pt">'.$time->timeAgoInWords($val['created']) .'</span>'
                );
    if ( $blogger['User']['id'] == $this->Session->read('Auth.User.id')): #delete button
         $msg   = __('Are you sure to want to delete this?', True); 
         $img = $this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'16px', 'alt'=>__('Delete', True), 
                          'title'=>__('Delete', True))), '/admin/topics/delete/'.$val['id'].'/'.$data['Forum']['vclassroom_id'].'/'.$val['forum_id'].'/'.$blogger['User']['username'],
                            array('onclick'=>"return confirm('".$msg."')"), False, False);
         array_push($tr,  $img);
    endif;
    echo $this->Html->tableCells($tr, array('style'=>'border:1px solid gray;padding:6px;background-color:#e8f6fe'), 
                                array('style'=>'border:1px solid gray;padding:6px;background-color:#c0c0c0'));   
 endforeach;
 echo '</table><br /><br /><br /><br />'; 
  
 #echo $this->Html->para(null, __('Legend', true).':');

 #$tmp  = $this->Html->image('static/board.gif', array('alt'=>'Tema normal', 'title'=>'Tema normal')) . ' Tema normal <br />';
 #$tmp .= $this->Html->image('static/locked.gif', array('alt'=>'Tema bloqueado', 'title'=>'Tema bloqueado')) . ' Tema bloqueado<br />';
 #$tmp .= $this->Html->image('static/new.gif', array('alt'=>'Comentario nuevo', 'title'=>'Comentario nuevo')). ' Comentario nuevo<br />';

 #echo $this->Html->para(null, $tmp);
else:
  e($this->Html->para(null, __('You must be logged in and belongs to this class to see this section', True)));
endif;
?>
<script type="text/javascript">
function validate()
{ 
 var subject  = document.getElementById("TopicSubject");
 var mess     = document.getElementById("TopicMessage");


 if (subject.value.length < 5)
 {
      alert('<?php __('Minimum 4 characters long');?>');
      subject.focus();
      return false;

 }
 if (mess.value.length < 8)
 {
      alert('<?php __('Minimum 8 characters long');?>');
      mess.focus();
      return false;
 }
 return true;
}
</script>
