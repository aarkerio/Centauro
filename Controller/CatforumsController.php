<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/images_controller.php
 
App::uses('Sanitize', 'Utility');  

class CatforumsController extends AppController
{
 public $helpers       = array('Form', 'Gags', 'Time');   
 public $components    = array('Blog');  

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }
    
 public function display($username, $user_id) 
 { 
  $this->layout    = 'blog';
  
  $this->pageTitle = $username .'\'s Forums';
  
  $params = array(
        'conditions'  => array('status'=>1, 'user_id'=>$user_id),
        'fields'      => array('id', 'title', 'description', 'created', 'user_id'),
        'order'       => 'title');
  $this->set('data', $this->Catforum->find('all', $params)); 
  
  /*** Bloger stuff ****/
  $this->Blog->bloggerStuff($user_id); // Charge Blog components aka Sidebars
 }
    
 /****======= ADMIN SECTION   =======******/
 public function admin_listing($admin = null, $order=null)
 {
  $this->layout = 'admin';
  
  $this->pageTitle = 'Forums';
  
  $conditions = array('user_id'=>$this->Auth->user('id'));
  
  if ($this->Auth->user('group_id') == 1 && $admin != null):
      $conditions['website'] = 1;
  endif;
  
  $params = array(
                   'conditions' => $conditions,
                   'fields'      => array('id','title', 'description','created', 'status')
                 );
  
  $this->set('data', $this->Catforum->find('all', $params)); 
    
    }
    
 public function admin_add() 
 {
   $this->layout = 'admin';

   if (!empty($this->request->data['Catforum']))
   {     
      $this->request->data['Catforum']['user_id'] = (int) $this->Auth->user('id');
    
      if ($this->Catforum->save($this->request->data['Catforum'])):
          $this->msgFlash('Forum category added', '/admin/catforums/listing');
      endif;
    }
 }
 
 public function admin_edit($catforum_id = null) 
 {
  $this->layout = 'admin';
  if ( empty($this->request->data['Catforum']) ):
     $this->request->data = $this->Catforum->read(null, $catforum_id);
  else:
     $this->request->data['Catforum'] = Sanitize::clean($this->request->data['Catforum']); //Hopefully this is enough

     if ($this->Catforum->save($this->request->data)):
          $this->msgFlash('Forum category saved', '/admin/catforums/listing');
          endif;
          endif;
 }
 
 public function admin_delete($catforum_id)
 {
    if ($this->Catforum->delete($catforum_id)):  
        $this->msgFlash('Forum deleted', '/admin/catforums/listing');
        endif;
 }
}
# ? >
