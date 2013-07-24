<?php
foreach($data as $t):
    echo $this->Html->para(null, $this->Html->link($t['Theme']['theme'], '/themes/listing/'.$t['Theme']['theme']));
endforeach;
# ? >