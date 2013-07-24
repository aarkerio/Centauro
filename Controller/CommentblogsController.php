<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File:  /APP/Controller/CommentblogsController.php

App::uses('Sanitize', 'Utility');

class CommentblogsController extends AppController {
 
 public $helpers    = array('Gags');

 public $components = array('Mailer', 'Captcha');

/**
 * Auth logic
 * @access public
 * @return void   
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('add', 'securimage'));
 }

 /**
   *  Generate captcha
   *  @access public
   *  @return void
   */ 
  public function securimage()
  {
     return $this->Captcha->show();
  }
 
/**
 * Save comment
 * @access public
 * @return void   
 */
 public function add()
 {   
  #die(debug($this->Session->Read));
  if ( !empty($this->request->data['Commentblog']) ):
      if ( $this->Auth->user('id') ):
          $this->request->data['Commentblog']['user_id']  = (int) $this->Auth->user('id');
          $this->request->data['Commentblog']['username'] = (string) $this->Auth->user('username');
      else:
          if ( $this->Captcha->check($this->request->data['Commentblog']['captcha']) == False ):
              echo $this->flash('Code incorrect, please pulse back button', $this->request->data['Commentblog']['redirect_to'], 20);
              #die('Code incorrect, please introduce it again');  # 'Wrong captcha, spambot'
              return False;
	      endif;         
          $this->request->data['Commentblog']['user_id'] = (int) 0;
      endif;
	  
      if ( $this->Commentblog->save($this->request->data) ):   # save the comment
          # Email STARTS
          $email   = (string) $this->Commentblog->User->field('email', array('User.id'=>$this->request->data['Commentblog']['blogger_id']));
          $this->Mailer->subject =  __('New comment in your blog');
          $this->Mailer->send($email);
          # Email ENDS 

          $this->redirect($this->request->data['Commentblog']['redirect_to'].'#comments');
      else:
	      debug($this->Commentblog->validationErrors);
      endif;
  endif;
 }
 

 /*****#### ADMIN SECTION  #####*****/
 
/**
 * 
 * @access public
 * @param
 * @return
 */
 public function admin_listing()
 {
  $this->layout    = 'admin';
      
  $params  = array(
          'conditions' => array('Entry.user_id' => $this->Auth->user('id')),
          'fields'     => array('Entry.id', 'Entry.title', 'Commentblog.id', 'Commentblog.comment', 'Commentblog.created', 
                                'Commentblog.username', 'Commentblog.user_id'),
          'order'      => 'Commentblog.id DESC',
          'limit'      => 50);
  $this->set('data', $this->Commentblog->find('all', $params)); 
 }

/**
 * 
 * @access public
 * @param
 * @void Null 
 */
 public function admin_edit($commentblog_id=null)
 {
   $this->layout = 'admin';
  if (empty($this->request->data['Commentblog'])):
      $this->request->data = $this->Commentblog->read(null, $commentblog_id);
  else:
      $this->request->data['Commentblog'] = Sanitize::clean($this->request->data['Commentblog']);
        
      if ($this->Commentblog->save($this->request->data)):
          $this->msgFlash('Comment has been updated', '/admin/comentblogs/listing');
      endif;
  endif;
 }

/**
 * Remove comment
 * @param integer
 * @acces public
 */
 public function admin_delete($commentblog_id)
 {
   if ($this->Commentblog->delete($commentblog_id)):
	   $this->msgFlash('Comment has been deleted', '/admin/commentblogs/listing');
   endif;
 }
}

# ? > EOF
