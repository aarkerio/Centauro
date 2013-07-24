<div class="barra">P&aacute;ginas recientemente editadas</div>

<?php
echo $this->Gags->googleAds(2); //publicity
echo '<ul>';
foreach ($data as $val)
{
        echo '<li style="padding:3px">'. $this->Html->link($val["Page"]['title'], '/pages/display/'.$val["Page"]["id"]);
        echo '  <span style="font-size:7pt;font-weight:bold;">' . $val["Page"]["rank"] . "  lecturas</span></li> \n";
}
echo '</ul>';
?>


