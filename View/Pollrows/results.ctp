<fieldset><legend>Results</legend>
<?php
#exit(print_r( $poll ));
$total_votes = 0;
  
foreach ($poll as $val):
       $total_votes += $val['Pollrow']['vote'];  # the total votes
endforeach;
  
echo $this->Html->Para(Null, '<b>' . $poll[0]['Poll']['question'] .'</b>');
  
foreach ($poll as $val):
    if ($val['Pollrow']['vote'] > 0 ):
        $percent = ($val['Pollrow']['vote'] * 100) / $total_votes;  # % = votes * 100 / total
    else:
        $percent = 0;
    endif;
    $width   = number_format($percent, 0);
             
    echo '<p><b>' . $val['Pollrow']['answer'] . '</b> '.number_format($percent, 2).'% <br />';
    echo $this->Html->image('static/poll/'.$val["Pollrow"]["color"].'.png', 
             array('height'=>10, 'width'=>$width,'alt'=>$val['Pollrow']['answer'], 'title'=>$val['Pollrow']['answer'])) . "\n";
    echo "  ". $val['Pollrow']['vote'] . "\n";
endforeach;
echo $this->Html->para('negrita', 'Total votes:' . $total_votes); 
echo '</fieldset>';
# ? > 
