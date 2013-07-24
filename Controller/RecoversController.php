<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: app/controller/todos_controller.php

 
App::uses('Sanitize', 'Utility');

class RecoversController extends AppController
{  
 # public $helpers       = array('Ajax');
  
 public $components    = array('Email', 'Adds');
 
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('newpwd', 'check', 'recover'));
 }
 
 /*** Recover password ****/
 public function recover() 
 {    
   $this->layout    = 'portal';
   $this->pageTitle = 'Recover password :: Centauro'; 
 }
  /*** Recover password check****/
 public function check()
 {           
   $this->request->data['Recover'] = Sanitize::clean($this->request->data['Recover']);
        
   if ( ! empty( $this->request->data['Recover'] ) ):
           $user_id = $this->Recover->User->field('id', array('email' => $this->request->data['Recover']['email'] ));
           
           if ($user_id == null):
                $this->set('error_message', 'Error: email <b>' . $this->request->data['Recover']['email'] . '</b> does not exist on database');
                $this->render('check', 'ajax');
           else:
                $this->request->data['Recover']['user_id']  = (int) $user_id;   //the user id
                $this->request->data['Recover']['random']   = $this->Adds->genPassword(14);
               
                if ( $this->Recover->save($this->request->data) ):
                    if ( $this->_sendRecover($this->request->data['Recover']['email'], $this->request->data['Recover']['random']) ):
                         $this->set('message', 'Success. An email has been sent to: <b>'.$this->request->data['Recover']['email']) . '</b>';
                         $this->render('check', 'ajax');
                    endif;
                endif;
           endif;
    endif;
 }
 
 public function newpwd($random = null)
 {  
  $this->layout = 'popup';
      
  $this->pageTitle = 'Centauro New Password';
      
  $conditions = array('random' => $random);
      
  $fields     = array('id', 'user_id');
      
  $row = $this->Recover->find($conditions, $fields);
      
  if ( $row == null ):
         $this->redirect('/');
  else:
         $this->Recover->User->id  = (int) $row['Recover']['user_id'];
         $pwd                      = $this->_genPwd(8);
         $enc_pwd                  = $this->Auth->password($pwd);
         if ( $this->Recover->User->saveField('pwd', $enc_pwd)):
              $this->set('pwd', $pwd);
              $this->Recover->delete($row['Recover']['id']);  # delete the row
         endif;
  endif;
 }
 
 private function _genPwd($length) 
 {
    
    srand((double)microtime()*1000000); 
    
    $vowels = array("a", "e", "i", "o", "u"); 
    $cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr", 
    "cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl"); 
     
    $num_vowels = count($vowels); 
    $num_cons   = count($cons); 
    
    $password = '';
    
    for($i = 0; $i < $length; $i++)
    { 
        $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)]; 
    }   
   return substr($password, 0, $length); 
 }

 private function _sendRecover($email, $random) 
 {
  $this->Email->to        = $email;
  $this->Email->subject   = 'Confirm Centauro new password';
  //$this->Email->replyTo   = 'noreply@mononeurona.org';
  $this->Email->sendAs    = 'html';
  $this->Email->template  = null;
  $this->Email->from      = 'noreply@mononeurona.org';
  
  $url  = '<h2>Centauro</h2><p>Open this in new tab to confirm new password: ';
  $url .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/recovers/newpwd/'.$random.'">';
  $url .= 'http://'.$_SERVER['SERVER_NAME'].'/recovers/newpwd/'.$random.'</a></p>';
  //die($url);
 
  if ( $this->Email->send($url) ):
      return True; 
  else:
      return False;
  endif;
 }
}
# ? >
