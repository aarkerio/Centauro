<?php
echo $this->Html->div('menumain','Lo más visto');
$pages = $this->requestAction('pages/rankPages');
#die(debug($pages));
foreach ($pages as $val):
        echo $this->Html->link($val['Page']['title'], '/pages/display/'.$val['Page']['id'], array('class'=>"chiki")) . "<br />";
        echo '<span style="font-size:6pt;font-weight:bold">'. $val['Page']['rank'] . ' lecturas </span><br />';
endforeach;
# ? > EOF
