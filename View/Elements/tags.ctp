<div style="padding:4px;margin:5px 0 5px 0">
<?php

$max_size = 25; $max_weight = 900; //max font size and max font weight
$min_size = 5; $min_weight = 100; //min font size and min font weight
$max_qty = max(array_values($tagCloud)); //the maximum data
$min_qty = min(array_values($tagCloud)); //the minimum data 

$spread = $max_qty - $min_qty;

if (0 == $spread) 
{ 
  $spread = 1;
} 

 $step = ($max_size - $min_size)/($spread);
 $bold = ($max_weight - $min_weight)/($spread);

 foreach ($tagCloud as $key => $value) 
 {
    $size   = round($min_size + (($value - $min_qty) * $step),0);
    $weight = round($min_weight + (($value - $min_qty) * $bold),0);
    echo $this->Html->link($key, '/entries/tagged/'.$Element[0]["User"]["username"].'/'.$key,
    array("style"=>"font-weight: ".$weight."; font-size: ".$size."pt", 'title'=>$value." entries with tag ".$key)) . ' ';
  } 
?>
</div>
