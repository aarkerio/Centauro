<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/Controller/CommentnewsController.php

App::uses('Sanitize', 'Utility');

class CommentnewsController extends AppController
{ 
  
/*
 *  CakePHP Helpers 
 */
 public $helpers    = array('Time');
   
/*
 *  CakePHP Components 
 */ 
 public $components = array('Captcha', 'Mailer');

/*
 *  CakePHP method
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('add', 'securimage'));
 }

/*
 * Add comment
 *
 */
 public function add()
 {
  #die(debug($this->request->data['Commentnews']));

  if ( !empty($this->request->data['Commentnews']) ):
      if ( $this->Auth->user('id') ):
         $this->request->data['Commentnews']['user_id']  = (int) $this->Auth->user('id');
         $this->request->data['Commentnews']['username'] = (string) $this->Auth->user('username');
      else:
          if ( $this->Captcha->check($this->request->data['Commentnews']['captcha']) == False ):
              $this->flash('Code incorrect, please pulse back button', 
                     '/news/view/'.$this->request->data['Commentnews']['new_id'], 20);  #    wrong captcha, spambot ??  
              return False;
          endif;
          $this->request->data['Commentnews']['user_id'] = 2;  #an special user
      endif;
      #die(debug($this->request->data));
      if ( $this->Commentnews->save($this->request->data) ):
          #$this->__sendMail($this->request->data['Commentnews']['user_id'], $this->request->data['Commentnews']['new_id']);
          # Email STARTS
          $email   = (string) $this->Commentnews->User->field('email', array('User.id'=>$this->request->data['Commentnews']['user_id']));
          $this->Mailer->subject =  __('New comment in news');
          $this->Mailer->send($email);
          # Email ENDS

          $this->msgFlash('Data saved', '/news/view/'.$this->request->data['Commentnews']['new_id']);
      endif;
  endif;
 }
 
/*****#### ADMIN SECTION  #####*****/

 public function admin_change($coment_id, $new_id)
{
  if (empty($this->request->data['Commentnews'])):
      $this->layout = 'admin'; 
      $this->request->data   = $this->Commentnews->read(null, $coment_id);
  else:
      if ($this->Commentnews->save($this->request->data)):
	      $this->msgFlash('Save', '/news/display/'.$new_id);
	  endif;
  endif;
 }

 public function admin_delete($coment_id)
 {
   if ( $this->Commentnews->delete($coment_id) ):
     $this->msgFlash('Data removed', '/admin/comentnews/listing/');
   endif;	
  }
}

# ? > EOF

