<?php
  $up   = $karma == 'up'   ? 'aupmod.gif'   : 'aupgray.gif';
  $down = $karma == 'down' ? 'adownmod.gif' : 'adowngray.gif';
  echo $this->Html->image('static/'.$up,array('alt'=>'Vote')).$this->Html->div('score',$votes).$this->Html->image('static/'.$down,array('alt'=>'Vote'));
# ? > EOF