<?php
#Paginator options for ajax
$this->Paginator->options(array(
                                'url'         => array('controller'=>'quicks', 'action'=>'index', '1'),
                                'update'      => '#quicks',
                                'evalScripts' => True,
                                'before'      => $this->Gags->ajaxBefore('quicks', 'loading_quick'),
                                'complete'    => $this->Gags->ajaxComplete('quicks', 'loading_quick')
                              ));
echo '<div class="blur"><div class="shadow"><div class="cont">';
$counter = (int) 0;
echo $this->Gags->imgLoad('loading3');
echo $this->Html->div(null, null, array('style'=>'text-align:left;margin:5px auto 5px auto;'));
#die(debug($quicks));

foreach ($data as $q):
    $counter++;
    echo $this->element('qnew', array('cache' => False, 'q'=>$q, 'frontend'=>True, 'counter'=>$counter));
endforeach;
echo '</div>';

$t  = $this->Html->div(null,$this->Paginator->prev('«'. __('Previous', true).' ',null,null,array('class'=>'disabled')),array('style'=>'width:100px;float:left'));
$t .= $this->Html->div(null, $this->Paginator->next(' '.__('Next', true).' »', null, null, array('class' => 'disabled')),array('style'=>'width:100px;float:right'));
$t .= $this->Html->div(null,$this->Paginator->counter(), array('style'=>'width:200px;float:center'));
$t .= '<br>'.__('Pages', True).': '.$this->Paginator->numbers(array('modulus' => 9));

echo  $this->Html->div(null,$t, array('style'=>'font-size:9pt;width:400px;margin:15px auto;'));

#Return to last quicks listing (index)

echo $this->Js->link(__('Back to index', True), '/quicks/lastQuicks', 
                 array('update'   => '#quicks',
                       'evalScripts' => True,
                       'before'      => $this->Gags->ajaxBefore('quicks', 'loading_quick'),
                       'complete'    => $this->Gags->ajaxComplete('quicks', 'loading_quick')));

echo '</div></div></div>';

echo $this->Js->writeBuffer();

# ? >
