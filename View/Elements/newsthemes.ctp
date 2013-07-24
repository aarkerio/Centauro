<?php
    echo '<div style="text-align:center;margin:15px auto 15px auto;">';
    echo $this->Js->link($this->Html->image("static/qn.jpg", array('alt'=>"Rapiditas", 'title'=>"Rapiditas", "style"=>"border:1px solid #6bdc3f")), '/quicks/display', array("update" => "qn",
    "loading"=>"Element.show('loading3');", "complete"=>"Element.hide('loading3');Effect.Appear('updater')"), 
                null, false);
    echo "</div>";
    
    echo '<div id="loading3" style="display: none;">';
                  echo $this->Html->image("static/loading.gif", array('alt'=>"Loading"));
    echo '</div>';
    
    echo$this->Gags->ajaxDiv('qn', array("style"=>"padding:3px"));
    echo $this->Gags->divEnd('qn');
?>
