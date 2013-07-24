<?php
ob_start();
 
/**
 * XSLT Example  
 * @author  Manuel Montoya <manuel@mononeurona.org>
 * @license http://www.opensource.org/licenses/gpl-license.php
 * @filesource
 */

define('FRAMEWORK_DSN','pgsql://postgres@localhost/PROJECTS');

require_once 'DB.php';  // PEAR

$xslt = "page.xsl";

$getXml   = new Framework_Sections;
$xml      = $getXml->getXml();

$xsl      = new DOMDocument('1.0', 'iso-8859-1'); 
$inputdom = new DOMDocument('1.0', 'iso-8859-1');


$inputdom->loadXML($xml);

$xsl->load($xslt);

 /**
 * El procesador XSLT
 * $proc
 */
 $proc = new XsltProcessor(); 
 
 $proc->registerPhpFunctions();
 
 // Load the documents and process using $xslt 
 $xsl = $proc->importStylesheet($xsl); 
 
 /** transform and output the xml document */ 
 $newdom = $proc->transformToDoc($inputdom); 
 
 print $newdom->saveXML();
 
 abstract class Framework_Object_DB {
 
    protected $conn;
     
    public function __construct()
    {   
        
        static $connection = null;
	
	//Type comparision
        if ($connection === null) {
                     $connection = DB::connect(FRAMEWORK_DSN); 
		     
		     //Ordenados por numero
		     if (!PEAR::isError($connection))
			     $connection->setFetchMode(DB_FETCHMODE_ORDERED);
		     else
		     	     throw new Exception($connection->getMessage());
            
        }

        $this->db = $connection;
    }

    function __destruct()
    {
        parent::__destruct();
	
        if (DB::isConnection($this->db))
               $this->db->disconnect();
        
    }
}

 
 class Framework_Sections extends Framework_Object_DB {
	
     /**
     * @param $doc
     * @param $root
     */
     public $doc;
     public $root;
     
     
    //cargo el construct de la clase padre 
    public function __construct() {
	    
    parent::__construct();
    
    // create a new XML document
    $this->doc = new DOMDocument('1.0', 'iso-8859-1'); // UTF-8 ??
    
    // create root node
    $this->root = $this->doc->createElement('page');
    $this->root = $this->doc->appendChild($this->root);
    
    }
   
   //===== El XML completo
   
   public function getXml() {
   
   //$this->setMenu();
   $this->setHead();
   /**$this->setGalerias();
   $this->setFrase();
   $this->setRandomImg();
   $this->setTopten(); */
   
   //$handle = fopen("/var/atenas/wdocs/wsite.xml", "a");
   //fwrite($handle, $xml_string);
   //fclose($handle);
   return $this->doc->saveXML();
   
   }
  
    public function  setHead() {
    
    $sql= "SELECT urlbase, nombre, lema,  email,  keywords,  descripcion, autor FROM centa_website";
    
    $row = $this->db->getRow($sql);
    
   // add node for outer table
   $outer = $this->doc->createElement("head");
   $outer = $this->root->appendChild($outer);
    		  // urlbase 
	     	  $child = $this->doc->createElement('urlbase');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[0]);
		  $value = $child->appendChild($value);
		  
		  //nombre del sitio
		  $child = $this->doc->createElement('nombre');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[1]);
		  $value = $child->appendChild($value);
		  
		  //lema o slogan del sitio
		  $child = $this->doc->createElement('lema');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[2]);
		  $value = $child->appendChild($value);
		  
		  //E-mail del sitio
		  $child = $this->doc->createElement('email');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[3]);
		  $value = $child->appendChild($value);
                  
  		  //keywords
		  $child = $this->doc->createElement('keywords');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode(trim($row[4]));
		  $value = $child->appendChild($value);
		  
		  //descripcion
		  $child = $this->doc->createElement('descripcion');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode(trim($row[5]));
		  $value = $child->appendChild($value);
		  
		  //Autor o webmaster del sitio
		  $child = $this->doc->createElement('autor');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[6]);
		  $value = $child->appendChild($value);
		  
   }
   
   public function setMenu() {
   
   // add node for outer table
   $outer = $this->doc->createElement("menu");
   $outer = $this->root->appendChild($outer);
   
   $result=$this->db->query("SELECT id, texto, img FROM centa_secciones ORDER BY orden");
   
   while ($result->fetchInto($row)) 
   {              
		  // id 
	     	  $child = $this->doc->createElement('id');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[0]);
		  $value = $child->appendChild($value);
		  
		  //texto
		  $child = $this->doc->createElement('texto');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[1]);
		  $value = $child->appendChild($value);
		  
		  //img
		  $child = $this->doc->createElement('imagen');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[2]);
		  $value = $child->appendChild($value);
    }
   
   }
   
   public function setFrase() 
    {
     $sql= "SELECT frase, autor FROM centa_frases ORDER BY RANDOM() LIMIT 1";
     
    // add node for outer table
    $outer = $this->doc->createElement("frase");
    $outer = $this->root->appendChild($outer);
    
    $row = $this->db->getRow($sql);
    
     		  // frase 
	     	  $child = $this->doc->createElement('frase');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[0]);
		  $value = $child->appendChild($value);
		  
		  //autor
		  $child = $this->doc->createElement('autor');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[1]);
		  $value = $child->appendChild($value);
		  
    }
    
/**
 *  Function to random image
 *  
 */
    public function setRandomImg() {
            
	    $sql= "SELECT id, gid, archivo, titulo FROM centa_photos ORDER BY RANDOM() LIMIT 1";
	    
            $outer = $this->doc->createElement("randomimg");
	    $outer = $this->root->appendChild($outer);
	      
	    $row = $this->db->getRow($sql);
	    
	    	  // id 
	     	  $child = $this->doc->createElement('id');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[0]);
		  $value = $child->appendChild($value);
		  
		  //galeria id
		  $child = $this->doc->createElement('gid');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[1]);
		  $value = $child->appendChild($value);
		  
		  //archivo de imagen
		  $child = $this->doc->createElement('imagen');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[2]);
		  $value = $child->appendChild($value);
		  
  		  //Titulo de la imagen
		  $child = $this->doc->createElement('titulo');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[3]);
		  $value = $child->appendChild($value);
                  
                  
    }
    
//===== Galerias del sitio

public function setGalerias() {
    
    $R = $this->db->query("SELECT id, title FROM centa_galerias WHERE estado = 1 ORDER BY title");
    
    $temp = $this->doc->createElement('galerias');
    $temp = $this->root->appendChild($temp);
    
    while ($R->fetchInto($row)) {

           $child = $this->doc->createElement( 'id' );
	   $temp->appendChild( $child )->appendChild( $this->doc->createTextNode( $row[0] ) );
           
           $child = $this->doc->createElement( 'titulo' );
	   $temp->appendChild( $child )->appendChild( $this->doc->createTextNode( $row[1] ) );
	   
    }
    
  
}
    
//===== Las diez paginas mas vistas

public function setTopten() {
    
    $R = $this->db->query("SELECT id, titulo FROM centa_paginas WHERE estado = 1 ORDER BY rank DESC LIMIT 10");
    
    $outer = $this->doc->createElement("topten");
    $outer = $this->root->appendChild($outer);
    
    while ( $R->fetchInto($row) ) {
    
      	    	  // id 
	     	  $child = $this->doc->createElement('id');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[0]);
		  $value = $child->appendChild($value);
		  
		  //titulo de la pagina
		  $child = $this->doc->createElement('titulo');
		  $child = $outer->appendChild($child);
		  $value = $this->doc->createTextNode($row[1]);
		  $value = $child->appendChild($value);

    }
  
}
    
    public function __destruct() 
    {
    
    }
}

?>
