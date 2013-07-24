<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/Controller/LivechatsController.php

App::uses('Sanitize', 'Utility');

class LivechatsController extends AppController
{
 public $components  = array('Mailer');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'add'));
 }

/**
 * Add livechat
 * @access public 
 */   
 public function add()
 {  
  if (  $this->Livechat->save($this->request->data) ):
    $this->__sendMail($this->request->data['Livechat']['user_id']);
    $params = array(
       'conditions' => array('Livechat.user_id'=>$this->request->data['Livechat']['user_id']),
       'fields'     => array('Livechat.message', 'Livechat.sender_name', 'Livechat.created'),
       'order'      => 'Livechat.id DESC',
       'limit'      => 15); 
    $this->set('data', $this->Livechat->find('all', $params));
    $this->render('lc', 'ajax');
 endif;
 }

/**
 * Send mail 
 * @access private
 * @void mixed
 */    
 private function __sendMail($user_id) 
 {
 try{
  $params = array('conditions' => array('User.id'=>$user_id),
                  'fields'     => array('email', 'username'),
                  'contain'    => False);
  $data = $this->Livechat->User->find('first', $params);
  #die(debug($data));
  $url = 'http://mononeurona.org/blog/'.$data['User']['username'];
  # Email STARTS
  $this->Mailer->set('url', $url);                                                                                                                        
  $this->Mailer->set('msg', 'New livechat on your blog');
  $this->Mailer->subject  = (string) '::MonoNeurona.org:: New livechat on your blog';
  $this->Mailer->layout   = 'default';
  $this->Mailer->sendAs   = 'html';
  if ( !$this->Mailer->send($data['User']['email']) ):
      throw new AppExceptionHandler('Email not sent');  
  endif;
 }
 catch(Exception $e)
 {
     die($e->getMessage());
 }
 }

/**
 * Edit
 * @access public 
 * @return void 
 */
 public function admin_edit($livechat_id=null)
 {  
  if (empty($this->request->data['Livechat'])):
        $this->layout = 'admin';      
        $this->request->data = $this->Livechat->read(null, $livechat_id);
  else:
        $this->request->data['Livechat']['message']    = Sanitize::paranoid($this->request->data['Livechat']['message'], $this->para_allowed);
        $this->request->data['Livechat']['user_id'] = (int) $this->Auth->user('id');
        if ($this->Livechat->save($this->request->data)):
     	    $this->msgFlash('Data saved','/admin/livechatings/listing');
	    endif;
   endif;
 }
 
/**
 *
 * @access public 
 * @return void 
 */
 public function admin_listing()
 {
  $this->layout    = 'admin';
  $params  = array(
        'conditions'      => array('Livechat.user_id' => $this->Auth->user('id')),
        'fields'          => array('Livechat.id', 'Livechat.message', 'Livechat.created'),
        'order'           => 'Livechat.id DESC',
        'limit'           => 30);
  $this->set('data', $this->Livechat->find('all', $params));
 }

/**
 *
 * @access public 
 * @return void 
 */
 public function admin_delete($livechat_id)
 {
   # deletes message from database
   if ($this->Livechat->delete($livechat_id)):
       $msg = 'Data removed';
   else:
       $msg = 'Data NOT removed';
   endif;
   $this->msgFlash($msg, '/admin/livechats/listing');
 }
  
}

# ? > EOF
