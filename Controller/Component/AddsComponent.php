<?php
/**
 * Karamelo LMS
 * http://mononeurona.org/
 * file: APP/controllers/Components/AddsComponent.php
 */ 

class AddsComponent extends Component {


/**
 * return a varchar password
 * @access public
 */
public function genPassword($length) {
    
    $password = '';
    
    srand((double)microtime()*1000000);
    
    $vowels  = array("a", "e", "i", "o", "u");
    $numbers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
    $cons    = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr", 
    "cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl"); 
     
    $num_vowels = count($vowels); 
    $num_cons   = count($cons); 
    
     
    for($i = 0; $i < $length; $i++)
    {
        $password .= $cons[rand(0, $num_cons - 1)] . $numbers[rand(0, count($numbers) - 1)] . $vowels[rand(0, $num_vowels - 1)]; 
    }
    
    return substr($password, 0, $length); 
}

public function get_extension($imagetype) 
{
     
     if ( empty($imagetype) )
     {
         return false;
     }
     
     switch($imagetype)
     {
           case 'image/bmp': return '.bmp';
           case 'image/cis-cod': return '.cod';
           case 'image/gif': return '.gif';
           case 'image/ief': return '.ief';
           case 'image/jpeg': return '.jpg';
           case 'image/pipeg': return '.jfif';
           case 'image/tiff': return '.tif';
           case 'image/x-cmu-raster': return '.ras';
           case 'image/x-cmx': return '.cmx';
           case 'image/x-icon': return '.ico';
           case 'image/x-portable-anymap': return '.pnm';
           case 'image/x-portable-bitmap': return '.pbm';
           case 'image/x-portable-graymap': return '.pgm';
           case 'image/x-portable-pixmap': return '.ppm';
           case 'image/x-rgb': return '.rgb';
           case 'image/x-xbitmap': return '.xbm';
           case 'image/x-xpixmap': return '.xpm';
           case 'image/x-xwindowdump': return '.xwd';
           case 'image/png': return '.png';
           case 'image/x-jps': return '.jps';
           case 'image/pjpeg': return '.jpeg';
           case 'image/x-freehand': return '.fh';
           default: return false;
       }
}

//validate email format and hosting address
public function validEmail($email) {
  //Dave Child code  
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
  {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  
  $local_array = explode(".", $email_array[0]);
  
  for ($i = 0; $i < sizeof($local_array); $i++) 
  {
     if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
     {
         return false;
     }
  }  
  
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1]))      // Check if domain is IP. If not, it should be valid domain name
  {
    $domain_array = explode(".", $email_array[1]);
    
    if (sizeof($domain_array) < 2) 
    {
        return false; // Not enough parts to domain
    }
    
    for ($i = 0; $i < sizeof($domain_array); $i++) 
    {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
      {
        return false;
      }
    }
  }
  return true;
}

public function upload($type, $D)
{   
    $imgData       = array();
    
    $imgData       = $this->imgData($type);  // get the data to handle the file
    
    /** Security: checks to see if file is an image, if not do not allow upload ==*/
    
    if ( $D["type"] != "image/jpeg" && $D["type"] != "image/pjpeg" && $D["type"] != "image/png" && $D["type"] != "image/gif") 
    {   /** is this a valid file? */
        $ErrMsg   = "<h1>ERROR</h1> the file " . $D["imgfile_name"] ."  is not valid.<br>";
        $ErrMsg  .= "<p>Only .jpg, .gif or .png files<br><br>";
        $ErrMsg  .= "Current type file: " . $D["type"] . "</p>\n";
		    
        /** delete uploaded file  */
        unlink($D["imgfile"]);
        $this->flash($ErrMsg,'/admin/'. $imgData['Controller'] .'/listing/');
        exit;
    }
    
    if ( $D["imgfile_size"] > $imgData['MaxSize']) 
    {
	   $ErrMsg  = "<h1>ERROR</h1> The image is too big.<br>";
       $ErrMsg .= "<p>Bigger than " . $imgData['MaxSize'] . " <br><br>";
       $ErrMsg .= "Current size: "  . $D["imgfile_size"] ."</p>\n";
	   
       /** delete uploaded file */
       unlink($D["imgfile"]);
       $this->flash($ErrMsg,'/admin/'. $imgData['Controller'] .'/listing/');
       exit;
    }
    
    if ($imgData['SequentialName'] == true)  // sequential name to image
    {
      $current_id  = $this->{$imgData['Model']}->field("id", array($imgData['Model'].".id"=>"> 0"), $imgData['MaxSize'].".id DESC");
      
      $next_id     = ($current_id + 1);
      
      $extension   = $this->getExtension($type);
      
      $Name        = $this->Auth->user('username') . "_" . $next_id . $extension;
      
      $final_filename = str_replace(" ", "_", $Name);
    }
    else
    {
        $final_filename = str_replace(" ", "_", $D["imgfile_name"]);
    }
    
    /** setup final file location and name */
    /** change spaces to underscores in filename  */
        
    $newfile        = $imgData['Uploadir'] . "/" . $final_filename;
    
    /** do extra security check to prevent malicious abuse */
    if (is_uploaded_file($D["imgfile"]))
    {
       /** move file to proper directory ==*/
       if (!move_uploaded_file($D["imgfile"], $newfile))
       {
          /** if an error occurs the file could not
               be written, read or possibly does not exist ==*/
         
         $this->flash('Error Uploading File.', '/admin/'. $imgData['Controller'] .'/listing/');
         exit();
       }
   }
   
   /*** Create thumb***/
   if ( $type == 4)
   {
         $this->createThumb($final_filename);
   }
   
   return $final_filename;
 }
 
 protected function imgData($type)
 {
    switch ($type)
    {
      case 1:
          $imgData['Uploadir']          = "../webroot/img/themes";
          $imgData['Model']             = "Theme";
          $imgData['Controller']        = "themes";
          $imgData['SequentialName']    = false;
          $imgData['MaxSize']           = 13000;
          break;
    }
    
    return $imgData;
 }
 
protected function getExtension($filename) 
{
   $parts = explode('.',$filename);
   $last = count($parts) - 1;
   $ext = $parts[$last];
   return $ext;
}
}
?>
