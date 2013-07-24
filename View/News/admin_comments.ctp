<?php
#die(debug($data));
$this->Html->addCrumb('Control Panel', '/admin/news/start'); 
$this->Html->addCrumb(__('News'), '/admin/news/listing'); 
echo $this->Html->getCrumbs(' > '); 

echo $this->Html->div('title_section', __('Comments in your news'));

if ( count($data) < 1 ):
    echo '<h1>'.__('No comments yet') .'</h1>';;
endif;

$msg   = __('Are you sure to want to delete this?');

foreach($data as $v):
   foreach($v['Commentnews'] as $c):
      echo $this->Html->div('adminblock');
      if ( $c['status'] == 1 ):
          $st = __('Published');
          $img   = 'static/status_1_icon.png';
      else:
          $st = __('Hidden');
          $img   = 'static/status_0_icon.png';
      endif;
      echo __('News') . ': '.$this->Html->link($v['News']['title'], '/news/view/'.$this->Session->read('Auth.User.username').'/'.$v['News']['id'], array('target'=>'_blank')) . '<br /><br />';
      echo $this->Html->link(
                  $this->Html->image('avatars/'.$c['User']['avatar'], array('width'=>'20px', 'alt'=>$c['User']['username'], 'title'=>$c['User']['username'])), 
                  '/users/about/'.$c['User']['username'],
                  array('target'=>'_blank', 'escape'=>False)) . '<br />';
      echo $this->Html->link($c['User']['username'], '/users/about/'.$c['User']['username']) . ' ' . __('wrote') . ':<br />';
      echo $this->Html->para(Null, nl2br($c['comment']));
      echo $this->Html->div(Null, $c['created'], array('style'=>'font-size:7pt;margin:4px'));
      echo $this->Html->link($this->Html->image($img, array('width'=>'14px', 'alt'=>$st, 'title'=>$st)), 
                         '/admin/comentnews/change/'.$c['id'].'/'.$c['status'], 
                             array('escape'=>False)) . ' &nbsp;&nbsp;&nbsp;';
        echo $this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'16px', 'alt'=>__('Delete', true), 
                                          'title'=>__('Delete', true))), '/admin/comentnews/delete/'.$c['id'], 
                             array('onclick'=>"return confirm('".$msg."')", 'escape'=>False))   . '<br /> '; 
        echo '</div>';
    endforeach;
endforeach;

# ? > EOF