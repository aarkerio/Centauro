<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/photos_controller.php
 
App::uses('Sanitize', 'Utility');

class PhotosController extends AppController
{
 public $helpers      = array('User');
 public $components   = array('Blog', 'Adds');
 private $_photosPath = '../webroot/img/photos/';
 private $_thumbsPath  = '../webroot/img/photos/thumbs/';

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'comment', 'photo', 'view'));
 }
    
 public function display($username, $gallery_id)
 {
  $this->Blog->setUserId($username);   # set blog sidebars
  $this->layout    = 'blog';
  $params = array(
    'conditions' => array('Photo.gallery_id' => $gallery_id),
    'fields'     => array('Photo.id', 'Photo.file', 'Photo.user_id', 'Photo.title', 'Photo.description', 'Photo.created',
                       'Photo.gallery_id', 'Gallery.title'),
   'order'      => 'Photo.id DESC');
   $this->set('data', $this->Photo->find('all', $params));
 }
    
 public function view($username, $photo_id)
 { 
  $this->Blog->setUserId($username);   # set blog sidebars  
  $this->layout    = 'blog';
  $params = array('conditions' => array('Photo.id' => $photo_id),
                  'fields'     => array('Photo.id', 'Photo.file', 'Photo.user_id', 'Photo.title', 'Photo.description', 'Photo.created', 'Photo.gallery_id', 'Gallery.title'));
  
  $this->set('data', $this->Photo->find('first', $params)); 
 }
    
    
 /**==== ADMIN METHODS  ===**/
 public function admin_listing($gallery_id)
 {   
  $this->layout    = 'admin';
  $params = array('conditions'   => array('Photo.user_id'=>$this->Auth->user('id'), 'Photo.gallery_id'=>$gallery_id),
                  'fields'       => array('Photo.id', 'Photo.file', 'Photo.user_id','Photo.gallery_id'),
                  'order'        => 'Photo.id DESC'
                 );
  $this->set('gallery_id', $gallery_id);
  $this->set('data', $this->Photo->find('all', $params));
 }
   
 public function admin_add() 
 {
  $this->layout    = 'admin';  
  if (empty($this->request->data['Photo']) || !is_uploaded_file($this->request->data['Photo']['file']['tmp_name'])):
       $this->flash('Something is wrong', '/admin/galleries/listing');
  endif;
  #die(debug($this->request->data));
  $this->request->data['Photo']['title']       = Sanitize::clean($this->request->data['Photo']['title'], $this->para_allowed);
  $this->request->data['Photo']['description'] = Sanitize::clean($this->request->data['Photo']['description'], $this->para_allowed);
     
  $maxfilesize  = 2097152; /** 2MB max size */   
  $imgfile_name = $this->request->data['Photo']['file']['name'];
  $imgfile_size = $this->request->data['Photo']['file']['size'];
  $imgfile      = $this->request->data['Photo']['file']['tmp_name'];	  
  $type   = $this->request->data['Photo']['file']['type'];
    
  /** Security: checks to see if file is an image, if not do not allow upload ==*/ 
  if ( $type != 'image/jpeg' && $type != 'image/pjpeg' && $type != 'image/png' && $type != 'image/gif'):
       /** is this a valid file? */
       $msg = "ERROR: the file $imgfile_name $imgfile is not valid. Only .jpg, .gif or .png files. Current type file: " . $type;    
       /** delete uploaded file  */
       unlink($imgfile);
       $this->flash($msg,'/admin/photos/listing/');
       exit();
  endif;
    
  if ( $imgfile_size > $maxfilesize):
      $msg  = "Error: the image is too big. Bigger than 2.0 MB. Current size: " . $imgfile_size;	
      /** delete uploaded file */
      unlink($imgfile);
      $this->flash($msg,'/admin/photos/listing/');
      exit();
  endif;
  
  $current_id  = (int) $this->Photo->field('Photo.id', Null, 'id DESC');
  $next_id     = ($current_id + 1);
  $extension   = $this->Adds->get_extension($type);
  $user_img    = strtolower($this->Auth->user('username') . "_" . $next_id . $extension);
  /** setup final file location and name */
  /** change spaces to underscores in filename  */
  $final_filename = str_replace(" ", "_", $user_img);
    
  $move_file  = $this->_photosPath . $final_filename;
  
  /** do extra security check to prevent malicious abuse */
  if (is_uploaded_file($imgfile)):
        if (!move_uploaded_file($imgfile, $move_file)):
             /** if an error occurs the file could not be written, read or possibly does not exist ==*/
             $this->flash('Error Uploading Image', '/admin/photos/listing/');
        endif;
   endif;
   
   /*** Create thumb***/
   $this->__createThumb($final_filename);
   #die('jsahdjahdkjashdk'); 
   /** Database stuff  **/
   $this->request->data['Photo']['file']    = $final_filename;
   $this->request->data['Photo']['user_id'] = (int) $this->Auth->user('id');
   
   if ( $this->Photo->save($this->request->data) ):    
       $this->msgFlash('Data Saved', '/admin/photos/listing/'.$this->request->data['Photo']['gallery_id']);
   else:
       die(debug($this->Photo->validationErrors));
   endif;
 }

 /*** DELETE  **/ 
 public function admin_delete()
 {
    $file = $this->Photo->field('Photo.file', array('Photo.id'=>$this->request->data['Photo']['id']));
    $this->Photo->delete($this->request->data['Photo']['id']);
    #die(debug($this->_photosPath . $file));
    /** delete image and thumb **/
    if (file_exists($this->_photosPath.$file)):
        unlink($this->_photosPath . $file);
    endif;
    if (file_exists($this->_thumbsPath.$file)):
        unlink($this->_thumbsPath . $file);
    endif;
    $this->msgFlash('Data removed', $this->request->data['Photo']['return']);
  }
  
 protected function __createThumb($file) 
 {    
  $imgfile   = $this->_photosPath     .  $file;      # system path
  #exit($imgfile);
  $thumb_img = $this->_thumbsPath     .  $file;       # system path   
  $new_w    = 100;  # new width
     
  /** only resize if the image is larger than 250 x 200 */
  $image_stats = getimagesize($imgfile);  // return array   
  $imagewidth  = $image_stats[0];
  $imageheight = $image_stats[1];
  
  $img_type    = $image_stats[2];   # 1 = GIF, 2 = JPG, 3 = PNG
  $ratio       = ($imagewidth / $new_w);
  $new_h       = round($imageheight / $ratio);
     
  /*** Save bandwidth! generate thumbs **/
  if (!file_exists($thumb_img)):  # thumb already exist??  
      switch ($img_type):
          case 1:
              $src_img = imagecreatefromgif($imgfile);
	          $dst_img = imagecreatetruecolor($new_w, $new_h);
              imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);
		      imagegif($dst_img, $thumb_img, "100");
              break;
          case 2:
              $src_img = imagecreatefromjpeg($imgfile);
	   		  $dst_img = imagecreatetruecolor($new_w, $new_h);
      		  imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);
			  imagejpeg($dst_img, $thumb_img, "100");
   			  break;
	      case 3:
              $dst_img = imagecreatetruecolor($new_w, $new_h);
    	      $src_img = imagecreatefrompng($imgfile);
              imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h, $imagewidth, $imageheight);
              imagepng($dst_img, $thumb_img);
              break;
      endswitch;
  endif;
 }
}
# ? >
