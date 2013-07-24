<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File:  /app/controllers/comentphotos_controller.php

App::uses('Sanitize', 'Utility');

class CommentphotosController extends AppController
{   
 public $helpers    = array('Gags');
    
 public $components = array('Email', 'Captcha');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'add', 'securimage'));
 }
    
/**
 *  Generate captcha
 *  @access public
 *  @return string
 */ 
 public function securimage()
 {
   return $this->captcha->show();
 }

/**
 * Save comment
 * @access public
 * @return void
 */
 public function add()
 {   
  # $this->layout = 'ajax';
  #$this->autoRender = False;
  if ( !empty($this->request->data['Commentphoto']) ):
    
      $this->request->data['Commentphoto'] = Sanitize::clean($this->request->data['Commentphoto']);

      if ( $this->Auth->user('id') ):
          $this->request->data['Commentphoto']['user_id'] = (int) $this->Auth->user('id');
      else:
          if ( $this->Captcha->check($this->request->data['Commentphoto']['captcha']) == False ):
              #$this->flash('Code incorrect, please pulse back button', $this->request->data['Commentphoto']['redirect_to'], 20);
              die('Code incorrect, please introduce it again');# 'Wrong captcha, spambot'
	      endif;     
          $this->request->data['Commentphoto']['user_id'] = (int) 0;
      endif;
	  #|die(debug($this->request->data));	 
      if ( $this->Commentphoto->save($this->request->data) ):   # save the comment
          $this->_sendMail( $this->request->data['Commentphoto']['blogger_id'], $this->request->data['Commentphoto']['photo_id']);
          $this->redirect($this->request->data['Commentphoto']['redirect_to'].'#comments');
      else:
	      die(debug($this->Commentphoto->validationErrors));
      endif;
  endif;
 }

 /**
 * Save comment
 * @access public
 * @return void   
 */
 private function _sendMail($user_id, $photo_id) 
 {

  $params =  array('conditions' => array('User.id'=>$user_id),
                   'fields'     => array('email', 'username'),
                   'contain'    => False
                   );
  $data = $this->Commentphoto->User->find('first', $params);
  # exit($data["User"]["email"]);
  $this->Email->sender    = '::MonoNeurona.org::';
  $this->Email->to        = $data['User']['email'];
  $this->Email->subject   = '::MonoNeurona.org:: New comment on your photo';
  $this->Email->sendAs    = 'html';
  $this->Email->template  = null;
  $this->Email->from      = 'noreply@mononeurona.org';
  #$this->set('foo', 'Cake tastes good today'); 
        //Set the body of the mail as we send it.
        //Note: the text can be an array, each element will appear as a
        //seperate line in the message body.
        $url   = '<img src="http://www.mononeurona.org/img/admin/new_user.jpg" alt="MonoNeurona" title="MonoNeurona" /><br />';
        $url  .= '<h2>'.$data["User"]["username"].'</h2><p>You have a new comment in your photograph: ';
        $url  .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/photos/view/'.$data['User']['username'].'/'.$photo_id.'">';
        $url  .= 'http://'.$_SERVER['SERVER_NAME'].'/photos/view/'.$data['User']['username'].'/'.$photo_id.'</a></p>';
        //die($url);
        
        if ( $this->Email->send($url) ):
            return True; 
        else:
            exit("Error!!");
	    endif;
 }  

 /*****#### ADMIN SECTION  #####*****/
 /**
 * Save comment
 * @access public
 * @return void   
 */
 public function admin_listing()
 {
  $this->layout    = 'admin';
      
  $params  = array(
          'conditions' => array('Photo.user_id' => $this->Auth->user('id')),
          'fields'     => array('Photo.id', 'Photo.title', 'Commentphoto.id', 'Commentphoto.coment', 'Commentphoto.created', 'Commentphoto.username', 'Commentphoto.user_id'),
          'order'      => 'Commentphoto.id DESC');
  $this->set('data', $this->Commentphoto->find('all', $params)); 
 }

/**
 * Save comment
 * @access public
 * @return void   
 */
 public function admin_edit($comentblog_id=null)
 {
   $this->layout = 'admin';
  if (empty($this->request->data['Commentphoto'])):
      $this->request->data = $this->Commentphoto->read(null, $comentblog_id);
  else:
      $this->request->data['Commentphoto'] = Sanitize::clean($this->request->data['Commentphoto']);
        
      if ($this->Commentphoto->save($this->request->data)):
          $this->msgFlash('Comment has been updated', '/admin/comentphotos/listing');
      endif;
  endif;
 }

/**
 * Remove comment
 * @access public
 * @return void   
 */
 public function admin_delete($comentblog_id)
 {
   if ($this->Commentphoto->delete($comentblog_id)):
	   $this->msgFlash('Comment has been deleted', '/admin/comentphotos/listing');
   endif;
 }
}
# ? > EOF
