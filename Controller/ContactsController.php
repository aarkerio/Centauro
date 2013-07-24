<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/images_controller.php

App::uses('Sanitize', 'Utility');

class ContactsController extends AppController {
    
 public $helpers       = array('Form', 'User',  'Gags');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }

 /*** ====  ADMIN SECTION    =====****/

 public function admin_export($username)
 {        
  $this->layout = 'ajax'; 
  $user_id =  $this->Contact->User->field('User.id', array("User.username"=>$username));
  $params = array(
            'conditions' => array('Contact.user_id'=>$user_id),
            'fields'     => array('firstname', 'lastname', 'title', 'nickname', 'email1', 'email2', 'homephone', 'workphone', 'cellphone', 'fax', 
                                  'cp', 'website', 'skype', 'msn', 'address', 'organization', 'birthday')
       );

  $data = $this->Contact->find('all', $params);
  #die(debug($data));
  $this->set('data', $data);    
  $this->set('username', $username);
 }

 public function admin_add() 
 {
  $this->layout    = 'admin';
  if (!empty($this->request->data["Contact"]))
  {
      $this->request->data['Contact']['user_id']  = $this->Auth->user('id');         
      $this->request->data['Contact']['birthday'] = $this->request->data['Contact']['birthday'];
	  if ( $this->Contact->save($this->request->data["Contact"]))
	  { 
               $this->msgFlash('An new contact has been added!','/admin/contacts/listing');
               exit();
      }
   }
 }
 
 public function admin_listing()
 {
  $this->layout    = 'admin';
  $this->pageTitle = 'Contacts';
  $params = array('conditions' => array('user_id' => $this->Auth->user('id')), 
                  'fields'  => array('id', 'firstname', 'lastname', 'title', 'nickname', 'email1', 'workphone', 'cellphone', 
                                     'website', 'msn', 'address', 'birthday'),
                   'order'           => 'firstname ASC');
  $this->set('data', $this->Contact->find('all', $params));
 }

 public function admin_edit($id=null)
 {
  if (empty($this->request->data['Contact'])):
      $this->layout        = 'admin';     
      $this->Contact->id   = $id;
      $this->request->data          = $this->Contact->read();
  else:  
      if ($this->Contact->save($this->request->data)):
          $this->msgFlash('Contact has been saved!','/admin/contacts/listing');
      else:
          die(debug($this->Contact->validationErrors)); 
      endif;
  endif;
}

 public function admin_single($id=null)
 {
   $this->layout        = 'admin';      
   $params = array('conditions'  => array('Contact.id'=>$id, 'Contact.user_id'=>$this->Auth->user('id')));
   $this->set('data', $this->Contact->find('first', $params));
 }

 public function admin_delete($id)
 {
   $this->Contact->delete($id);
   $this->msgFlash('Contact has been deleted!', '/admin/contacts/listing');
   exit();
 }
 
}
# ? > EOF
