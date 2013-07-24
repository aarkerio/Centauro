<?php 
#exit(debug($data)); 
$this->set('title_for_layout', 'Sección');
?>
<div style="margin:15px auto 0 auto;width:500px;text-align:center;font-weight:bold;font-size:14pt">
<?php
if ($data != Null):
    echo $this->Html->image('secs/'.$data[0]['Section']['img'], array('alt'=>$data[0]['Section']['description'], 'title'=>$data[0]['Section']['description']));
    echo $data[0]['Section']['description'];
else:
    __('No Sections Avaliable');
endif;
?>

</div>

<div style="margin:25px">
<?php             
foreach( $data as $val):  
?>
<ul>
     <?php echo '<li style="margin:2px;">>>' . $this->Html->link($val['Page']['title'], '/pages/display/'.$val['Page']['id'])  . '</li>';?>
</ul>
<?php 
endforeach;
?>
</div>