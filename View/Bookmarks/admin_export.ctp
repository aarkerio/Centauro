<?php
$file = '';
#debug($data);
echo "<head><H1>Menu de marcadores</H1></head>";
foreach ($data as $val)
{
echo "<p>Nombre: ".$val['Bookmark']['name']."<p>";
echo $this->Html->link("".$val['Bookmark']['url']."","".$val['Bookmark']['url']."",null,null,false);
#echo "<p>url: ". $val['Bookmark']['url'] ."";


/*  $file .= "Name: " . $val['Bookmark']['name'] . "\n\n"; 
  $file .= "Url: " . $val['Bookmark']['url'] . "\n\n";*/
} 

header('Content-Type: text/xml;charset=UTF-8');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Disposition: attachment; filename="' . $username . '_bookmarks.html' . '"');
header('Expires: 0');
header('Pragma: no-cache');

echo $file;
?>



