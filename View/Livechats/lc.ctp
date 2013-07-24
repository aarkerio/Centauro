<?php
foreach($data as $v):
    echo '<span style="font-size:7pt;font-weight:bold">'.$v['Livechat']['sender_name'] .' wrote:</span><br />';
    echo '<span style="font-size:8pt;">'.$v['Livechat']['message'] .'</span> <br />';
    echo '<span style="font-size:7pt;color:green;">'.$this->Time->timeAgoInWords($v['Livechat']['created']) .'</span><br /><br />';
endforeach;

# ? > EOF
