<?php
//exit(print_r($data));
foreach( $data as $val) {
   //exit(print_r($val));
 ?>
   
 <div class="titnew"><?php echo $val['Section']['description'] . $val['Section']['img']; ?></div>
 
 <div>
            <?php 
            foreach( $val['Page'] as $P) {
                
            echo $this->Html->link($P['title'], '/pages/single/'.$P['id']); ?><br />
 </div>
 
<?php } } ?>
