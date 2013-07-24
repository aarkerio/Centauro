<?php
$doc = new DOMDocument("1.0");
$root = $doc->createElement("HTML");
$root = $doc->appendChild($root);
$head = $doc->createElement("HEAD");
$head = $root->appendChild($head);
$title = $doc->createElement("TITLE");
$title = $head->appendChild($title);
$text = $doc->createTextNode("This is the title");
$text = $title->appendChild($text);
echo "<PRE>";
echo htmlentities($doc->saveXML());
echo "</PRE>";
?> 
