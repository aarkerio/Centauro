<?php

#  Template Handler Class :  Rob Thomson www.marotori.com

class template_handler {

  # set the moduleType variable

  # $moduleType controls where the system

  # looks for modules & plugins within the

  # system.


 public function template_handler()
 {

 }



 public function setBaseDir($dir)
 {
    $this->baseDir = $dir;

  }

  



# return the template

 public function retrieve(){

    # clean up any tags that have been set

    if (is_array($this->objArray))
    {

      $this->objArray = array_unique($this->objArray);

      foreach($this->objArray as $x){

	$this->templateContent = str_replace($x,"",$this->templateContent);

      }

      unset($this->objArray);

    }

    # parse the template looking for any php code
    

    $string = $this->templateContent;

    # first find and subst out all text area content

    preg_match_all("/<(textarea)(.*?)>(.*?)<\/textarea>/si", $string, $regs);

    # replace all textarea content with a custom tag

    $count = "1";

    if(is_array($regs[0])){

      foreach($regs[0] as $tag){

	$string = str_replace($tag,"{textarea-" . $count . "}",$string);

	$textarea[] = array("field" => "{textarea-" . $count . "}","data" => $tag);

	$count++;

      }

    }

    $pos = 0;

    while ( ($pos = strpos( $string, '<?' )) != FALSE ) 
    {

      $pos2 = strpos($string, '?>', $pos + 2);

      ob_start();

      eval( substr( $string, $pos + 2, $pos2 - $pos - 2) );

      $value = ob_get_contents();

      ob_end_clean();

      $string = substr( $string, 0, $pos ) . $value . substr( $string,$pos2 + 2);

    }

    # reassemble to handle php code input into text areas        

    if (is_array($textarea))
    {
      foreach($textarea as $x){

	$string = str_replace($x[field],$x[data],$string);

      }

    }        

             

    $this->templateContent = $string;

    # display the output

    return $this->templateContent;

  }

  # set the template that will be used

 public function setTemplate($template="none")
 {

    if ($template == "none")
    {
      print "[error] please specify a template. <br>";

    } 
    else 
    {

      $this->templateName = "$template";

      $this->templatePath =  $this->baseDir . $this->templateName;



      if (file_exists($this->templatePath))
      {

	$handle = fopen ($this->templatePath, "r");

	$this->templateContent = fread ($handle, filesize ($this->templatePath));

	fclose ($handle);

      } else {

	print "[error] unable to open template from "  . $this->templatePath . "<br>";

	print "Has setBaseDir($dir) been set<br>";

      }

    }

    

  }



  # set the specified object to its relevant value

 public function setObject($objtag,$content){

    $this->objArray[] = "{". $objtag . "}";

    $this->templateContent = str_replace('{' . $objtag . '}',$content . '{' . $objtag . '}',$this->templateContent);

  }





}

//EOF
?>
