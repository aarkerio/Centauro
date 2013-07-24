<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Controller/AppController.php

class AppController extends Controller {

 public $components = array('Acl', 'Session', 'Auth'=>array('authorize' => 'Crud'), 'Cookie', 'RequestHandler'); 
 
 public $helpers    = array('Html', 'Form', 'Session', 'Gags', 'Time', 'Js' => array('Jquery'));
 
 public $html_allowed = array('.',',','-','_', '@', ' ','(',')',"\n","ñ","Ñ", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", '"', "'");

 # allowed characters in paranoid Sanitize
 public $para_allowed = array('.', ',', '-','_','@',' ','(', ')',"+","\n", "/", "ñ", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", '"',"'","¿" ,"?", ";", ":");

 # Set Auth component and lang
 public function beforeFilter()
 {
   #die('PWD hashed: '. AuthComponent::password($this->request->data['User']['pwd']));  # if you change Configure::salt string see before hash
   #set locale
   #$this->__setLocale();
   # Auth configuration
   $this->Auth->authenticate = array(AuthComponent::ALL => array('userModel'=>'Users.User', 'fields' => array('username'=>'email', 'password'=>'pwd')),
                                            'Form');
   #die(debug($this->request));
   #Auth configuration
   # log try login
   $this->Auth->loginAction    = array('controller' => 'users', 'action'   => 'login');
   $this->Auth->loginRedirect  = array('controller' => 'news', 'action'    => 'display');
   $this->Auth->logoutRedirect = array('controller' => 'news', 'action'    => 'display');
   $this->Auth->loginError     = __('wrong_pass_or_email');
   $this->Auth->authError      = __('You are not authorized to access this page');
   # Pass settings in
   $this->Auth->authorize = array('Controller'); 
 }

/**
 *  Admin permissions
 *  @access public
 *  @return void
 */ 
 public  function isAuthorized($user) 
 {
   if (isset($this->request->params['admin'])):
       if ( $this->Auth->user('id') ): 
          return True;
      else:
          return False;
      endif;
  endif;
  return True;
 }
/**
 *  Just set a message in Session and redirect user 
 *  @access public
 *  @return void
 */
 public function msgFlash($msg, $to)
 {
  $this->Session->setFlash($msg);
  $this->redirect($to);       
  return True;
 }

/**
 *  More Security  
 *  @access public
 *  @return void
 */ 
 protected function __chkGroup()
 {
   if ( $this->Auth->user('group_id') != 1 ):
      $this->redirect('/');
      return False;
   endif;
 }

/**
 * Set language   see:  http://book.cakephp.org/view/162/Localizing-Your-Application
 * 
 */
 private function __setLocale()
 {
   $this->L18n = new L18n(); 
     
   if ( $this->Auth->user() ):  # user is logged in
       $pre_lang = $this->Auth->user('lang');  
   else:
       $pre_lang = 'en';
   endif;

   //Double check
   if ( in_array($pre_lang, $this->languages) ):
       $lang = $pre_lang;
   else:
       $lang = 'en';
   endif; 
   $this->L10n->get($lang);
   Configure::write('Config.language', $lang);
 }

/**
 * If error.... Get support!!
 */
 protected function getSupport()
 {
   $this->flash(__('An error has been encountered, please ask Chipotle Software (www.chipotle-software.com) for support', True),'/',15);
 } 
}

# ? > EOF
