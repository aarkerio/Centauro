<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/GalleriesController.php
 
App::uses('Sanitize', 'Utility');

class GalleriesController extends AppController
{

 public $helpers       = array('User');
   
 public $components    = array('Blog');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'listing'));
 }

/**
 * Display gallery
 * @access public
 * @param integer $user_id
 * @param $gallery_id
 * @return void
 */   
 public function display($user_id, $gallery_id)
 {   
   $this->layout    = 'blog';     
   $this->pageTitle = 'Your Photos';
   $params = array('conditions' => array('Photo.gallery_id' => $gallery_id),
                   'fields'     => array('Photo.id', 'Photo.file','Photo.user_id','Photo.title','Photo.description','Photo.created','Photo.gallery_id'),
                   'order'      => 'Photo.id DESC');
   $this->set('data', $this->Photo->find('all', $params));
   $username = $this->User->field('username', array('User.id'=>$user_id)); 
   $this->Blog->bloggerStuff($user_id);
 }

/**
 *  Display galleries in blog
 *  @access public
 *  @return mixed 
 */

 public function listing($blogger_id) 
 {
  $params =  array('conditions'  => array('Gallery.status' => 1, 'Gallery.user_id' => $blogger_id),
                   'fields'      => array('id', 'title'),
                   'contain'     => False,
                   'order'       => 'Gallery.title DESC');
  return $this->Gallery->find('all', $params);
 }

 /**== ADMIN METHODS ==**/
/**
 * Display
 * @access public
 * @return void
 */ 
 public function admin_listing()
 {    
   $this->layout    = 'admin';
   $params  = array('conditions'      => array('user_id'=>$this->Auth->user('id')),
                    'fields'          => array('id', 'title', 'user_id', 'status'),
                    'order'           => 'Gallery.id DESC');
   $this->set('data', $this->Gallery->find('all', $params));
 }
   
/**
 * Update
 * @param integer $gallery_id
 * @access public
 * @return void
 */ 
 public function admin_edit($gallery_id) 
 { 
  $this->layout    = 'admin';
  if (!empty($this->request->data['Gallery'])):
      if ($this->Gallery->save($this->request->data)):
          $this->msgFlash('Gallery saved', '/admin/galleries/listing');
      endif;
  elseif ($gallery_id!=False and intval($gallery_id)):
      $this->request->data = $this->Gallery->read(Null, $gallery_id);
  endif;
 }

/**
 * Create 
 * @param integer $gallery_id
 * @access public
 * @return void
 */ 
 public function admin_add() 
 { 
  $this->layout    = 'admin';
  if (!empty($this->request->data['Gallery'])):
      $this->request->data['Gallery']['user_id'] = (int) $this->Auth->user('id');
     
      if ($this->Gallery->save($this->request->data)):
          $this->msgFlash('Gallery added', '/admin/galleries/listing');
      endif;
   endif;
 }

/**
 * DELETE  
 * @param integer $gallery_id
 * @access public
 * @return void
 */ 
 public function admin_delete($gallery_id)
 {
   if ( $this->__delAllImages($gallery_id) ):
       $this->Gallery->delete($gallery_id);       
       $this->msgFlash('Gallery deleted', '/admin/galleries/listing');
   endif;
  }

/**
 *  Delete all images on gallery
 *  @ access private
 *  @param integer $gallery_id
 *  @return boolean
 */
 private function __delAllImages($gallery_id)
 { 
    $params = array('conditions' => array('Photo.gallery_id'=>$gallery_id, 'Photo.user_id'=>$this->Auth->user('id')),
                     'fields'     => array('Photo.id', 'Photo.file')
                    );
    $data    = $this->Gallery->Photo->find('all', $params);
     
    foreach ($data as $v):
          /** delete the uploaded file **/
          if (file_exists('../webroot/img/photos/'.$v['Photo']['file'])):
              unlink('../webroot/img/photos/'.$v['Photo']['file']);
	      endif;
          if (file_exists('../webroot/img/photos/'.$v['Photo']['file'])):
              unlink('../webroot/img/photos/thumbs/' . $v['Photo']['file']);
          endif;
          $this->Gallery->Photo->delete($v['Photo']['id']);
     endforeach; 
     return True;
 }
}
# ? > EOF
