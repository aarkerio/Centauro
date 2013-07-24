<?php
#debug($q);
$ajax_update = 'divarrows_'.$q['Quick']['id'];
echo $this->Html->div('odd link');
$votes   = (int) 0;
$already = (bool) False;
# Total votes
foreach ($q['QuicksVote'] as $h):
    $votes = $votes + $h['vote'];
    if ($this->Session->read('Auth.User.id') == $h['user_id']):
        $already = True;
    endif;
endforeach;

if ( $frontend ):
?>
<span class="rank" style="width:20px;"><?php echo $counter; ?></span>
<?php 
endif; 
?>
<div id="divarrows_<?php echo $q['Quick']['id']; ?>" class="midcol" style="width:15px;" >
<?php
if ( $already ):  #user already voted
    $up   = $h['vote']  > 0  ? 'aupmod.gif'   : 'aupgray.gif';
    $down = $h['vote']  < 0  ? 'adownmod.gif' : 'adowngray.gif';
    echo $this->Html->image('static/'.$up,array('alt'=>'Vote')).$this->Html->div('score',$votes).$this->Html->image('static/'.$down,array('alt'=>'Vote'));
elseif( !$already && $this->Session->read('Auth.User')): 
    echo $this->Js->link($this->Html->image('static/aupgray.gif', array('alt'=>'Vote')), '/quicks/vote/up/'.$q['Quick']['id'],
                   array('update'      => '#'.$ajax_update,
                         'escape'      => False,
                         'evalScripts' => True,
                         'before'      => $this->Gags->ajaxBefore($ajax_update,'loading_quick'),
                         'complete'    => $this->Gags->ajaxComplete($ajax_update, 'loading_quick')));
     echo $this->Html->div('score', $votes);
     echo $this->Js->link($this->Html->image('static/adowngray.gif', array('alt'=>'Vote')), '/quicks/vote/down/'.$q['Quick']['id'],
                   array('update'   => '#'.$ajax_update,
                         'escape'   => False,
                         'evalScripts' => True,
                         'before'      => $this->Gags->ajaxBefore($ajax_update,'loading_quick'),
                         'complete'    => $this->Gags->ajaxComplete($ajax_update, 'loading_quick')));
else: 
     echo $this->Html->link($this->Html->image('static/aupgray.gif',  array('alt'=>'Vote')), '/users/login/', array('escape'=>False));
     echo $this->Html->div('score', $votes);
     echo $this->Html->link($this->Html->image('static/adowngray.gif',array('alt'=>'Vote')), '/users/login/', array('escape'=>False));
endif; 
# Votes ends
echo '</div>';

# Quick new
echo $this->Html->div('entry');
echo $this->Html->para(null, $this->Html->link(Sanitize::stripScripts($q['Quick']['title']), $q['Quick']['reference'], array('class'=>'quick_title', 'target'=>'_blank'), False, False));
echo $this->Html->para(null, $this->Html->link('('.$q['Quick']['site'].')', '/quicks/site/'.$q['Quick']['site'], array('class'=>'quick_site')));
echo $this->Html->div('tagline');
echo  'submitted by ' . $this->Html->link($q['User']['username'], '/blog/'.$q['User']['username'], array('class'=>'author')); 
echo  ' to ' . $this->Html->link($q['Theme']['theme'], '/themes/view/'.$q['Theme']['id'], array('class'=>'author')); 
?>
</div>
<?php if ( $frontend ): ?>
<ul class="flat-list buttons">
  <li class="first">
  <?php 
      $comments = count($q['QuicksComment']); 
      $txt = $comments  > 0 ? $comments . ' comments ': ' comment ';
      echo $this->Js->link($txt, '/quicks/comment/'.$q['Quick']['id'], 
                   array('style'       => 'font-size:7pt',
                         'update'      => '#quicks_comment',
                         'escape'      => False,
                         'evalScripts' => True,
                         'before'      => $this->Gags->ajaxBefore('quicks', 'loading_quick'),
                         'complete'    => $this->Gags->ajaxComplete('quicks_comment', 'loading_quick')
                         )); #To view and add a quick comment
  ?>
  </li>
</ul>
<?php
endif;
?>
</div><!-- entry -->
</div><!-- tagline -->
