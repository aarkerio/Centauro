
<div class="title_section">Helps</div>

<div>
<table>
<?php
//var_dump($data);
foreach ($data as $key=>$val) {
          echo "<tr><td>";
             echo $this->Form->create('/polls/edit/'.$data[$key]['Poll']['id'], 'get');
             echo $this->Form->end('Edit');
             echo "</form>";
          
          echo "</td><td>";
            
            echo  $val['Poll']['question']     . " ";
            echo  $val['Poll']['created']    . " ";
         echo "</td><td>";
         
            echo $this->Form->create('/polls/delete/'.$data[$key]['Poll']['id'], 'get', array("onsubmit"=>"return confirm('Are you sure?')"));
            echo $this->Form->end('Delete');
            echo "</form>";
         echo "</td></tr>";
    }
?> 
</table>
