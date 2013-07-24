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

class DiscutionsController extends AppController
{  
   
 public $components  = array('Captcha', 'Email');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'captcha', 'add'));
 }
 
 public function add()
 {  
   $this->layout = 'portal';
   if (!empty($this->request->data['Discution'])):
       //discution level answer or first
       if ( !isset($this->request->data['Discution']['discution_id']) ):
           $this->request->data['Discution']['discution_id']   = (int)  0;
           $this->request->data['Discution']['level']          = (int)  0;
       endif;
       
       if ( !$this->Auth->user('id') ): //user is not logged in  
           $this->request->data['Discution']['user_id'] = (int) 2; # anonymous, dirth trick
           // Note: the user can desactive sessions on his browser and not type any captcha and 
           // $this->request->data["Discution"]["captcha"] != $this->Session->read('captcha') fails filtering 
           // so I added:   || strlen($this->Session->read('captcha')) < 3 condition   to block spam
           if ($this->request->data['Discution']['captcha'] != $this->Session->read('captcha') || strlen($this->request->data['Discution']['captcha'])<3 ):
                $this->flash('Code incorrect, please pulse back button', '/pages/display/'.$this->request->data['Discution']['page_id'], 20); 
                // wrong captcha, spambot ??
                exit();
	       endif;
	   endif;
        
       if ($this->Discution->save($this->request->data)):
             $user_id  = $this->Discution->Page->field('Page.user_id', array('Page.id'=>$this->request->data['Discution']['page_id']));
             $this->sendMail($user_id, $this->request->data['Discution']['page_id']);
             $this->redirect('/pages/display/'.$this->request->data['Discution']['page_id'].'#discutions');
	   endif;
   endif;
 }
 
 public function captcha()
 {
   return $this->Captcha->render();
 }

 /**  === ADMIn METHODS ===  **/   
 public function admin_listing()
 {
  $this->layout    = 'admin';
  $this->pageTitle = 'Discussion on pages';
    
  $params = array('conditions' => array('user_id' => $this->Auth->user('id')),
                  'fields'     => array('id', 'title', 'body', 'created', 'sender'),
                  'order'      => 'title DESC'
                 );
  $this->set('data', $this->Discution->find('all', $params));
 }

 public function admin_edit($id = null)
 {
    if (empty($this->request->data))
    {
        $this->layout = 'admin';
        
        $this->Discution->id = $id;
        
        $this->Discution     = new Subject;
        
        $this->set('subjects', $this->Discution->generateList()); 		
        
        $this->request->data = $this->Discution->read();
    }
    else
    {
        if ($this->Discution->save($this->request->data))
        {
            $this->msgFlash('Your virtual classroom  has been updated.','/vclassrooms/listing');
        }
    }
 }
  
 public function admin_delete($discution_id)
 {
   $this->Discution->delete($discution_id);
   $this->msgFlash('Data removed','/vclassrooms/listing');
 }
 public function admin_remove($discution_id, $page_id)
 {
   $this->Discution->delete($discution_id);
   $this->msgFlash('Data removed','/pages/display/'.$page_id);
 }
  
 private function sendMail($user_id, $page_id) 
 {      
  $this->User = new User;
        
  $fields = array('email', 'username');
        
        $this->User->unbindModel(array('hasMany' => array('Themeblog', 'Page', 'News', 'Entry', 'Bookmark', 'Wayding', 'Podcast')));

        $data = $this->User->find(array("User.id"=>$user_id), $fields);
        
        //exit(print_r($data));
        $this->Email->sender    = '::MonoNeurona.org::';
        $this->Email->to        = $data["User"]["email"];
        $this->Email->subject   = '::MonoNeurona.org::New comment on your page';
        $this->Email->sendAs    = 'html';
        $this->Email->template  = null;
        $this->Email->from      = 'noreply@mononeurona.org';
        //$this->set('foo', 'Cake tastes good today'); 
        //Set the body of the mail as we send it.
        //Note: the text can be an array, each element will appear as a
        //seperate line in the message body.
        $url   = '<img src="http://www.mononeurona.org/img/admin/new_user.jpg" alt="MonoNeurona" title="MonoNeurona" /><br />';
        $url  .= '<h2>'.$data["User"]["username"].'</h2><p>You have a new comment in your page: ';
        $url  .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/pages/display/'.$page_id.'">';
        $url  .= 'http://'.$_SERVER['SERVER_NAME'].'/pages/display/'.$page_id.'</a></p>';
        
        //die($url);
        
        if ( $this->Email->send($url) ) 
        {
            return true; 
        } 
        else 
        {
            return false;
        }
 }  
}
# ? >
