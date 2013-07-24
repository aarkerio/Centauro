<table style="collapse:border-collapse;vertical-align:top;width:640px">
<?php
#debug($data);
echo '<div style="margin-bottom:4px;color:#2c363b;padding:4px;font-size:18pt;font-weight:bold;border-bottom:1px solid black">' . $data[0]['Gallery']['title'] . '</div>';
$i = 0;
foreach ($data as $val):
      $i++;      
      if ($i == 1): 
         echo '<tr>'; #row beggins
      endif;
      
      echo '<td style="height:160px;text-align:center;border: 1px dotted black;margin:4px;padding:10px;">';
         echo $this->Html->link(
                   $this->Html->image('photos/thumbs/'.$val['Photo']['file'],array('alt'=>$val['Photo']['title'],'title'=>$val['Photo']['title'])),
                   '/photos/view/'.$blogger['User']['username'].'/'.$val['Photo']['id'], array('class'=>'chiki', 'escape'=>False)) . '<br />';
         echo $this->Html->link($val['Photo']['title'], '/photos/view/'.$blogger['User']['username'].'/'.$val['Photo']['id']) . '<br />';
      echo '</td>';
      
      if ($i == 5):
         echo '</tr>'; 
         $i  = 0;       # close row and reset counter
      endif;
endforeach;

if ($i < 5):
    echo '<td colspan="'.(5-$i).'"></tr>';  # fill the row 
endif;
?>
</table>
