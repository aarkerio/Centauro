<?php

//var_dump($data);

$values = array();

foreach ($data as $val):
    $values[$val['User']['id']] = $val['User']['username'];
endforeach;

echo $this->Form->select('Message.user_id', $values, array(), false);

?>
