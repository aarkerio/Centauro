<div style="margin:15px auto 0 auto;width:500px;text-align:center;">
   <?php echo $this->Html->image('themes/'.$data[0]["Theme"]["img"], array('alt'=>$data[0]["Theme"]["theme"], 'title'=>$data[0]["Theme"]["theme"])); ?>
</div>
<?php echo $this->Gags->googleAds(); ?>
<div style="margin:25px">
<ul style="list-style-type: square;">
<?php
foreach( $data as $val):
   echo '<li style="padding:4px">' . $this->Html->link($val['News']['title'], '/news/view/'.$val['News']['id']) . '</li>'; 
endforeach;
?>
</ul>
</div>
