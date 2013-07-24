<?php
$download = $this->requestAction('downloads/lastDownload');

echo $this->Html->div('element');
echo $this->Html->image('/img/static/last-download2.gif', array('alt'=>'Last Download', 'title'=>'Last Download')) . '<br />';
echo $this->Html->link($download['Download']['title'], '/downloads/display/'.$download['Catdownload']['id'].'/#dow'.$download['Download']['id'], array('style'=>'font-weight:bold'));
echo '<br />';

if ($download['Download']['url'] != NULL):
    echo $this->Html->link($this->Html->image('static/button_download.gif', array('alt'=>$download['Download']['title'], 'title'=>$download['Download']['title'])), $download['Download']['url'], array('escape'=>False));
else:
    echo __('No downloads available');
endif;
?>
</div>

