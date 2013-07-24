<?php
$val = $this->requestAction('quotes/randomQuote');
#debug($val);
echo $this->Html->div(null, $val['Quote']['quote'] . ' <br />
<i>'. $val['Quote']['author'] . '</i> <br /> 
Blogger: '.$this->Html->link($val['User']['username'], '/blog/'.$val['User']['username']), 
array('style'=>'margin:3px auto;padding:3px;font-size:13pt;border-bottom:1px dotted gray;font-family: \'Courier\', arial, serif;'));

# ? > EOF