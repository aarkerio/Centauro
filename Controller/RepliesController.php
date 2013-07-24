<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:APP/Controller/RepliesController.php

 
App::uses('Sanitize', 'Utility');

class RepliesController extends AppController
{

 public $helpers       = array('Time', 'Javascript', 'Ajax', 'Form', 'User', 'Fck');
    
 public $components    = array('Security', 'Blog');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }

 /**==ADMIN METHODS==**/    
 public function admin_listing()
 {   
  $this->layout    = 'admin';
  $this->pageTitle = 'Replies';
  $params = array(
        'fields' => array('id', 'img', 'link', 'tooltip'),
        'order'  => 'Reply.id DESC'
        );
  $data  = $this->Reply->find('all', $params);

  $this->set('data', $data);
 }
   
 public function add($username = null, $user_id = null, $topic_id = null, $forum_id = null) 
 {
    $this->layout    = 'blog';
    
    if ( !empty($this->request->data['Reply']) )
    {
      $this->request->data['Reply']['user_id'] = $this->Auth->user('id');
      if ($this->Reply->save($this->request->data)):
         $this->msgFlash('Reply add', '/topics/display/'.$this->request->data["Reply"]["return"]);
         exit();
      endif;
   }
   else
   {
       $this->set('style', $this->Blog->getStyle($user_id));
       $this->set('Element', $this->Blog->bloggerStuff($user_id)); // Charge Blog components aka Sidebars
       $this->set('return', $username .'/'. $user_id .'/'. $forum_id .'/'. $topic_id);
       $this->set('topic_id', $topic_id);
   }
}

 /*** DELETE  **/ 
 public function admin_delete($id)
 { 
   $this->Reply->delete($id);
    
    $this->msgFlash('Reply deleted', '/admin/replies/listing');
    exit();
  }
}
# ? >
