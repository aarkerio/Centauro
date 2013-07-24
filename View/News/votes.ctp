<div class="votes_counter">
<?php
    echo '<span class="votes" id="nodes_votes_'.$new_id.'">'.$votes.'</span><br />';
    echo '<span class="negrita">votos</span>';
    echo '<div id="bottoms_'.$new_id.'">';
    echo $this->Html->image('socialnet/boton_positivo_off.gif', array('alt'=>"Voted", 'title'=>"Voted", "id"=>"img_vote_up_".$new_id));
    echo $this->Html->image('socialnet/boton_negativo_off.gif', array('alt'=>"Voted", 'title'=>"Voted", "id"=>"img_vote_up_".$new_id));
?>
</div><!--bottoms_'.new_id.'-->
</div><!-- votes_counter -->
