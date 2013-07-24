<?php
ob_start();
 
/**
 * XSLT Example  
 * @author  Manuel Montoya <manuel@mononeurona.org>
 * @license http://www.opensource.org/licenses/gpl-license.php
 * @filesource
 */
 
 $xml = "../archivos/books.xml";
 $xslt = "../archivos/books.xsl";
 
 $xsl      = new DomDocument(); 
 $inputdom = new DomDocument();
 
 $xsl->load($xslt);
 $inputdom->load($xml);
 
 
 $proc = new XsltProcessor(); 
 
 $proc->registerPhpFunctions();
 
 // Load the documents and process using $xslt 
 $xsl = $proc->importStylesheet($xsl); 
 
 /** transform and output the xml document */ 
 $newdom = $proc->transformToDoc($inputdom); 
 
 print $newdom->saveXML();
  
 ob_end_flush();
?>
