<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc. 
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/ImagesController.php
 
App::uses('Sanitize', 'Utility');

class ImagesController extends AppController {

 public  $components  = array('Adds');

 private $_imagesPath  = '../webroot/img/imgusers/';

 private $_thumbsPath  = '../webroot/img/imgusers/thumbs/';

 private $_avatarsPath = '../webroot/img/avatars/';

 public $paginate = Null;

/**
 * Display
 * @access public
 * @return void
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }
    
/** ==ADMIN METHODS== **/
/**
 * Display
 * @access public
 * @return void
 */    
 public function admin_listing($set = Null)
 {
  $this->pageTitle = 'Your Images';
  
  if ($set != Null):
      $this->layout    = 'popup'; # small window
      $this->paginate['limit']  = 10;
      $this->set('set', True);    
  else:
      $this->layout    = 'admin';
      $this->paginate['limit'] = 30;
      $this->set('set', False);
  endif;
  
  $this->paginate['conditions'] = array('Image.user_id'=>$this->Auth->user('id'));
  $this->paginate['order']      = 'Image.id DESC'; 
  $this->paginate['fields']     = array('Image.id', 'Image.file', 'Image.user_id');
  
  $data = $this->paginate('Image');
 
  $this->__chkFiles($data);
  $this->set(compact('data'));      
 }

/**
 * @access private
 * @param array $data
 */
 private function __chkFiles($data)
 {
  foreach($data as $v):
      if ( !file_exists($this->_imagesPath.$v['Image']['file']) ):
          $this->Image->delete($v['Image']['id']);
          #echo "Delete" . $v['Image']['file'];
      endif;
  endforeach;
 }

/**
 * Add image
 * @access public
 * @return void
 */ 
 public function admin_add($type = null) 
 {
  $this->layout    = 'admin';  

  if ($this->request->data['Image']['file']['error'] == 1):
      $this->flash('Error uploading image, please contact the support team', '/admin/images/listing');
  endif;

  $this->request->data['Image'] = Sanitize::clean($this->request->data['Image']); 
    
  $uploaddir = isset($type) && $type == 'avatar' ? $this->_avatarsPath : $this->_imagesPath;
 
  $maxfilesize  = 2097152; /** 2MB max size */    
  $imgfile_name = $this->request->data['Image']['file']['name'];
  $imgfile_size = $this->request->data['Image']['file']['size'];   
  $imgfile      = $this->request->data['Image']['file']['tmp_name'];
  $type         = $this->request->data['Image']['file']['type'];
  #die($type);
  /** Security: checks to see if file is an image, if not do not allow upload ==*/
  if ( $type != 'image/jpeg' && $type != 'image/pjpeg' && $type != 'image/png' && $type != 'image/gif'):
      $msg   = "ERROR the file $imgfile_name $imgfile is not valid. Only .jpg, .gif or .png files Current type file: " . $type ;
      unlink($imgfile);    # delete uploaded file
      $this->flash($msg,'/admin/images/listing/');
      exit();
  endif;
    
  if ( $imgfile_size > $maxfilesize):
	  $msg  = "<h1>ERROR The image is bigger than 2.0 MB  Current size: " . $imgfile_size;
      unlink($imgfile);
      $this->flash($msg,'/admin/images/listing/');
      exit();
  endif;

  $current_id  = (int) $this->Image->field('Image.id', array('id >'=>0), 'id DESC');
  $next_id     = ($current_id + 1);    
  $extension   = $this->Adds->get_extension($type);
  $name        = $this->Auth->user('username') . "_" . $next_id . $extension;
  #die('extension :'.$extension);


  /** setup final file location and name */
  /** change spaces to underscores in filename  */
  $final_filename = str_replace(" ", "_", $name);
  $newfile        = $uploaddir . $final_filename;
    
  # Do an extra security check to prevent malicious abuse 
  if (is_uploaded_file($imgfile)):
        # move file to proper directory 
        if (!move_uploaded_file($imgfile, $newfile)):
            $this->flash('Error moving uploaded File.', '/admin/images/listing/', 3);  # if an error occurs 
            return False;
        endif;
   endif;
   
   /*** Create thumb***/
  if ( $type != 'avatar'):
         $this->__createThumb($final_filename);
  endif;
  /** Database stuff  **/
   
  $this->request->data['Image']['file']    = $final_filename;
  $this->request->data['Image']['user_id'] = $this->Auth->user('id');
   
  if ($this->Image->save($this->request->data)):
         $this->msgFlash('Image saved', $this->request->data['Image']['return']);
  endif;
   
  /** delete the temporary uploaded file **/
  unlink($imgfile);
 }


/**
 * Remove image  
 * @access public
 * @return void
 */ 
 public function admin_delete()
 {
  $image_id = $this->request->data['Image']['id'];
  if ($this->Image->delete($image_id)):
      $file = $this->Image->field('Image.file', array('Image.id'=>$image_id));
      /** delete image and thumb **/
      unlink('../webroot/img/imgusers/' . $file);
      unlink('../webroot/img/imgusers/thumbs/' . $file);
      $this->redirect($this->request->data['Image']['return']);
  endif;
 }
  
/**
 * 
 * @access protected
 * @return void
 */
 protected function __createThumb($file) 
 {
   $imgfile        =  $this->_imagesPath .  $file;      # system path  
   #exit($imgfile);
   $thumb_img      =  $this->_thumbsPath  .  $file;       # system path   
   $new_w          = 100;  # new width
  
   # only resize if the image is larger than 250 x 200 
   $image_stats = getimagesize($imgfile);  # return array
   $imagewidth  = $image_stats[0]; 
   $imageheight = $image_stats[1];
   $img_type    = $image_stats[2];   # 1 = GIF, 2 = JPG, 3 = PNG 
   $ratio       = ($imagewidth / $new_w);
   $new_h       = round($imageheight / $ratio);
     
   /*** Save bandwidth! generate thumbs **/
   if (!file_exists($thumb_img)):  # thumb already exist?? 
       switch ($img_type):
           case 1;              
               $src_img = imagecreatefromgif($imgfile);  
	           $dst_img = imagecreatetruecolor($new_w, $new_h);
	           imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);
               imagegif($dst_img, $thumb_img, "100");
               break;
         
           case 2;      
               $src_img = imagecreatefromjpeg($imgfile);
               $dst_img = imagecreatetruecolor($new_w, $new_h);
               imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);
               imagejpeg($dst_img, $thumb_img, "100");
               #die('exist '.$img_type);
               break;  

           case 3;   
               $dst_img = imagecreatetruecolor($new_w, $new_h);
               $src_img = ImageCreateFrompng($imgfile);                 
               imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);                   
               imagepng($dst_img, $thumb_img);
               break;
      endswitch;
   endif;
  }
}

# ? > EOF

