<?php
#die(debug($data));
echo $this->Html->addCrumb('Control Panel', '/admin/news/start'); 
echo $this->Html->addCrumb(__('Polls', true), '/admin/polls/listing'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->div('title_section', __('Comments in poll', true));

if ( count($data) < 1 ):
  echo '<h1>'.__('No comments yet', true) .'</h1>';;
endif;

$msg   = __('Are you sure to want to delete this?', true);

foreach($data as $v):
   foreach($v['PollsComment'] as $c):
      echo $this->Html->div('adminblock');
      if ( $c['status'] == 1 ):
          $st = __('Published', true);
          $img   = 'static/status_1_icon.png';
      else:
          $st = __('Hidden', true);
          $img   = 'static/status_0_icon.png';
      endif;
      echo __('News', True) . ': '.$this->Html->link($v['News']['title'], '/news/view/'.$this->Session->read('Auth.User.username').'/'.$v['News']['id'], array('target'=>'_blank')) . '<br /><br />';
      echo $this->Html->link(
                  $this->Html->image('avatars/'.$c['User']['avatar'], array('width'=>'20px', 'alt'=>$c['User']['username'], 'title'=>$c['User']['username'])), 
                  '/users/about/'.$c['User']['username'],
                  array('target'=>'_blank'), False, False) . '<br />';
      echo $this->Html->link($c['User']['username'], '/users/about/'.$c['User']['username']) . ' ' . __('wrote', true) . ':<br />';
      echo $this->Html->para(null, nl2br($c['comment']));
      echo $this->Html->div(null, $c['created'], array('style'=>'font-size:7pt;margin:4px'));
      echo $this->Html->link($this->Html->image($img, array('width'=>'14px', 'alt'=>$st, 'title'=>$st)), '/admin/comentnews/change/'.$c['id'].'/'.$c['status'], 
                       array(), False, False) . ' &nbsp;&nbsp;&nbsp;';
      echo $this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'16px', 'alt'=>__('Delete', true), 
                                          'title'=>__('Delete', true))), '/admin/comentnews/delete/'.$c['id'], 
                                            array("onclick"=>"return confirm('".$msg."')"), False, False)   . '<br /> '; 
      echo '</div>';
 endforeach;
endforeach;
?>