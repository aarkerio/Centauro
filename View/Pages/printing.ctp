<?php
//exit(print_r($data));
echo '<div id="cintillo">' . $data["Section"]["description"];
	
if  ($data["Page"]["display"] == 2  || $data["Page"]["display"] == 3):  #como desplegar el cintillo ?
    echo  " \ ".  $data["Page"]['title'];
endif;
 
echo '</div><div style="text-align:right;float:right">';
 
echo $this->Html->link($this->Html->image('secs/'.$data['Section']['img'], 
        array('alt'=>$data['Section']['description'], 'title'=>$data['Section']['description'], 'class'=>"imgborder")), 
                       '/pages/section/'.$data['Section']['id'], array('escape'=>False));
 
echo '</div>';

echo '<div class="barra">'. $data["Page"]['title'] .'</div>';

echo $this->Gags->googleAds('page'); //publicity  

echo '<p><span style="font-weight:bold;font-size:8pt;">Este art&iacute;culo ha sido consultado en ' . number_format($data["Page"]["rank"]) . ' ocasiones.</span></p>';

echo $data['Page']['body'];

echo '<br /><p class="negrita" style="text-align:right">&Uacute;ltima actualizaci&oacute;n: ' . $data['Page']['updated']. '</p>';

# ? >