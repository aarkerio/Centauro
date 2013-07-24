<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/messages_controller.php
 
App::uses('Sanitize', 'Utility');

class MessagesController extends AppController
{  
 public $helpers       = array('Ck', 'Time');
 
 public $components    = array('Email');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display'));
 }

/**
 * chk Check if user have a non readed message
 */
 public function chkMessage()
 {   
   if ($this->Auth->user('id')):        
        $conditions = array('Message.user_id'=>$this->Auth->user('id'), 'Message.status'=>0);
        return $this->Message->field('Message.id', $conditions, 'Message.id DESC');
   else:
        return false;
   endif;
 }
   
 public function message($user_id) 
 {    
   $this->pageTitle = 'Messages';     
   $this->layout    = $this->Edublog->layout($user_id);
   $this->set('blog', $this->Edublog->blog($user_id));
   $this->set('user_id', $user_id);      
 }
    
   
 public function compose()
 {    
        $this->layout    = 'portal';
        
        $this->pageTitle = 'Write Message';
 }
   
 public function search()
 {    
   $this->layout    = 'ajax';
   $this->pageTitle = 'Write Message';
   $params = array('conditions' => array("User.username ~ '".$this->request->data['Message']['string'] ."'"),
                   'fields'     => array('User.username', 'User.id'),
                   'order'      => 'User.username',
                   'limit'      => 15);
   $this->set('data', $this->Message->User->find('all', $params));      // Using Portal component
   $this->render('search', 'ajax');
  }
   
 public function chat($nick='mononeuron')
 {
   $this->pageTitle = 'IRC Chat';
   $this->layout    = 'popup';
   $this->set('nick', $nick);
 }
   
 public function deliver()
 {
   $this->layout = 'ajax';
   if ( !empty($this->request->data['Message']) ):
       if ($this->Message->save($this->request->data)):
           $this->sendMail($this->request->data['Message']['user_id'], $this->request->data['Message']['username'], $this->request->data['Message']['title']);
           if ( isset($this->request->data['Message']['admin'])):
              $this->render('sentadmin','ajax');
           else:
              $this->render('send', 'ajax');
		  endif;
	  endif;
  endif;
 }
   
 /** 
  * Send a general message to all commnunity
  * @access public
  * @return void
  */
 public function admin_general() 
 {
  if ($this->Auth->user('group_id') != 1):
      $this->redirect('/admin/messages/listing');
  endif;
    
  $this->layout = 'admin';
    
  if (!empty($this->request->data['Message'])):
      $this->request->data['Message']['title'] = Sanitize::paranoid($this->request->data['Message']['title']);
      $this->request->data['Message']['body']  = Sanitize::html($this->request->data['Message']['body']);
      $this->Message->User->contain();
      $params = array('conditions' => array('active'=>1),
                     'fields'     => array('id'));
     
      $data = $this->Message->User->find('all', $params);
      $j = 0;   # counter
      $this->request->data['Message']['sender_id'] = $this->Auth->user('id');
      #exit(print_r($data));
      foreach($data as $val): 
          $this->Message->create();
          $this->request->data['Message']['user_id'] = $val['User']['id'];
          if ($this->Message->save($this->request->data)):
              $j++;
          else:
              exit('error on save');
          endif;
     endforeach;
     $this->msgFlash($j . ' ' . __('messages sent', True), '/admin/messages/listing');
  endif;
 }
   
 private function sendMail($user_id, $username, $title) 
 {
   $params =  array('conditions' => array('User.id'=>$user_id), 
                   'fields'     => array('email', 'username'));        
   $data = $this->Message->User->find('first',$params);
   $this->Email->sender    = '::MonoNeurona.org::';
   $this->Email->to        = $data["User"]["email"];
   $this->Email->subject   = '::MonoNeurona.org:: New message from '. $username;
   $this->Email->sendAs    = 'html';
   $this->Email->template  = null;
   $this->Email->from      = 'noreply@mononeurona.org';
   $url   = '<img src="http://www.mononeurona.org/img/admin/new_user.jpg" alt="MonoNeurona" title="MonoNeurona" /><br />';
   $url  .= '<h2>'.$data["User"]["username"].'</h2><p>You have a new message from '. $username;
   $url  .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/admin/messages/listing/">'.$title.'</a></p>';
   if ( $this->Email->send($url) ):
      return True; 
   else:
      exit("Error!!");
  endif;
 }  

 public function change($message_id, $message_status)
 {
   $this->Message->id  = $message_id;    
   $this->Message->saveField('status',  $message_status);
 }
    
/**==== ADMIN METHODS ====**/

 public function admin_listing()
 {
  $this->layout    = 'admin';    
      
  $params = array(
            'conditions' => array('Message.user_id' => $this->Auth->user('id')),
            'fields'     => array('Message.id', 'Message.title', 'Message.body','Message.created','Message.sender_id','Message.status','User.username'),
            'order'           => 'Message.id DESC',
  'limit'           => 20);    
  $this->set('data', $this->Message->find('all', $params));
 }
 
 public function admin_reply()
 {
  $this->layout    = 'ajax';    
  $this->set('data', $this->request->data['Message']);
  $this->set('admin_reply', 'ajax');
 }
 
 public function admin_add()
 {    
  $this->layout    = 'admin';
  if (!empty($this->request->data['Message'])):
   $this->request->data['Message'] = Sanitize::clean($this->request->data['Message']);
   if ( isset( $this->request->data['Message']['message_id'] ) ):
              $this->change($this->request->data['Message']['message_id'], 2);
   endif;
          
   if ($this->Message->save($this->request->data)):
           $this->sendMail($this->request->data['Message']['user_id'], $this->request->data['Message']['username'], $this->request->data['Message']['title']);
           $this->render('send','ajax');
    endif;
  endif;
 }
   
 public function admin_display($message_id)
 {
  $this->layout    = 'admin';    
  $params = array('conditions'  => array('Message.id'=>$message_id, 'Message.user_id'=>$this->Auth->user('id')),
                  'fields'      => array('Message.id', 'Message.user_id', 'Message.title', 'Message.created', 
                                         'Message.body', 'Message.sender_id', 'Message.status', 'User.username'));    
  $data            = $this->Message->find('first', $params);
      
  if ( $data['Message']['status'] == 0 ):  # change from new to readed
       $this->change($data['Message']['id'], 1);
  endif;
  $this->set('data', $data);
 }

 public function admin_edit($message_id = null)
 {
  $this->layout = 'admin';
  if (empty($this->request->data['Message'])):
      $this->request->data = $this->Message->read(null, $message_id);
  else:
      $this->request->data['Message'] = Sanitize::clean($this->request->data['Message']); 
      if ($this->Message->save($this->request->data['Message'])):
            $this->flash('Your virtual classroom has been updated.','/admin/messages/listing');
      endif;
  endif;
 }
  
 public function admin_delete($id=null)
 {
   # multirow delete
  if ( isset($this->request->data['Message']['several']) ):
	foreach ($this->request->data['Message']['id'] as $v):
	    if ( $v != 0):
            $this->Message->delete($v);
	    endif;
	endforeach;
  else:
       if ( isset( $this->request->data['Message']['id'] ) ):
            $id = $this->request->data['Message']['id'];
       endif;         
       $this->Message->delete($id);
  endif;
  $this->msgFlash('Message has been deleted.','/admin/messages/listing');
 }
}
# ? >
