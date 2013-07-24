<?php
//exit(print_r($data));
           echo $this->Html->image('secs/'.$data[0]["Section"]["img"], array('alt'=>$data[0]["Section"]["description"], 'title'=>$data[0]["Section"]["description"])); 
                    
foreach( $data as $val) {
   //exit(print_r($val));
  
?>
  
 <div>
            <?php 
                   echo $this->Html->link($val["Page"]['title'], '/pages/display/'.$val["Page"]["id"]); 
            ?><br />
 </div>
 
<?php } ?>
