<?php
$doc  = new DOMDocument('1.0'); # Start XML file, create parent node
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

#die(debug($data));
# Iterate through the rows, adding XML nodes for each
foreach ($data as $row ):
    #die(debug($row));
    # ADD TO XML DOCUMENT NODE
    $node = $doc->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $row['Marker']['name']);
    $newnode->setAttribute("address", $row['Marker']['address']);
    $newnode->setAttribute("lat", $row['Marker']['lat']);
    $newnode->setAttribute("lng", $row['Marker']['lng']);
    $newnode->setAttribute("user", $row['User']['username']);
    $newnode->setAttribute("type", $row['Marker']['type']);
endforeach;

header("Content-type: text/xml");
echo $doc->saveXML();
#die(debug($xmlfile));

#header("Content-type:application/vnd.ms-excel");
#header("Content-disposition:attachment;filename=".$xmlfile);
# ? > EOF