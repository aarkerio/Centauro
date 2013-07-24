<?php
echo $this->Html->div('element');

$banner = $this->requestAction('banners/randomBanner');

echo '<b>' . $banner['Banner']['tooltip'] . '</b><br />';

echo $this->Html->link($this->Html->image('banners/'.$banner['Banner']['img'],
        array('style'=>'border:1px solid black;', 'alt'=>$banner['Banner']['tooltip'], 
                'title'=>$banner['Banner']['tooltip'])), $banner['Banner']['link'], array('escape'=>False));

echo '</div>';

#? > EOF

