<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/helps_controller.php

 
App::uses('Sanitize', 'Utility');

class HelpsController extends AppController
{  
   
 public $components    = array('Email');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'view', 'tour', 'index'));
 }
   
 public function tour() 
 {
   $this->layout    = 'tour';
   $this->pageTitle = 'Tu portal::MonoNeurona';
 }

 public function display($a, $b, $c)
 {
   $url  = '/'.$a .'/'.$b .'/'.$c;
   $lang =  $this->Auth->user('lang');
   
   $lang = !$lang ? 'en' : 'es';
   
   $this->layout    = 'help';
   $this->pageTitle = 'Karamelo ' . __('Help', true);
   $conditions      = array('url'=>$url, 'lang'=> $lang);
   $fields          = array('help', 'title', 'url', 'lang');  
   $this->set('data', $this->Help->find($conditions, $fields));
 }

 public function index($set=null) 
 {
  $lang = (Configure::read('Config.language')) ?  Configure::read('Config.language') : 'en';
  $this->layout    = ( isset($set) ) ? 'admin' : 'help'; //small window or admin panel?
  $this->pageTitle = 'Karamelo '. __('Help', true);
  $params = array('conditions' => array('lang'=>$lang),
                  'fields'     => array('id','title','url'),
                  'order'      => 'title');
  $this->set('data', $this->Help->find('all', $params));
 }

 public function view($help_id, $set = null) 
 {
  $lang = (Configure::read('Config.language')) ?  Configure::read('Config.language') : 'en';
  $this->layout    = ( $set !==  null) ? 'admin' : 'help'; //small window or admin panel?
  $this->pageTitle = 'Karamelo '. __('Help', true);
  $params = array(
                  'conditions'  => array('Help.id'=>$help_id),
                  'fields'      => array('id','title', 'help', 'lang')
                  );
  $this->set('data', $this->Help->find('first', $params));
 }
    
 /***=== ADMIN SECTION===**/     
 //bug report
 public function admin_newticket() 
 {
  $this->layout    = 'admin';
  $this->pageTitle = 'Centauro Bug Report';
  $params = array(
                  'conditions'  => array('lang'=>'en'),
                  'fields'      => array('help', 'url', 'lang')
                 );  
  $this->set('data', $this->Help->find('all', $params));
 }

 public function admin_submit()
 {  
   if ( !empty( $this->request->data['Help'] ) ):
    $this->request->data['Help']['report'] = Sanitize::paranoid($this->request->data['Help']['report']);
    $report  = $this->Auth->user('username') .' with email '. $this->Auth->user('email') .', wrote: ';

    $report .= $this->request->data['Help']['report'] .'.  Kind: ' . $this->request->data['Help']['kind'];

    if ( $this->__sendNewReport( $report ) ):
            $this->msgFlash(__('Email sent, Thanks!', true), '/admin/entries/start'); 
    endif;
  endif;
 }

 public function admin_display($path = null) 
 {
  $this->layout    = 'popup';    
  $this->pageTitle = 'Centauro Help';
  $url = str_replace('-', '/', $path);
  #echo $url;
  $params = array(
          'conditions' => array('url'=>$url),
          'fields'     => array('id', 'url', 'help')
        );
  $this->set('data', $this->Help->find('first', $params));
 }
   
 public function admin_edit($help_id = null)
 {
   $this->__chkGroup(); // admin user?
   $this->layout = 'admin'; 
   if (!empty($this->request->data['Help'])):
     $this->request->data['Help']['url']   = Sanitize::paranoid($this->request->data['Help']['url'], $this->para_allowed);
     $this->request->data['Help']['title'] = Sanitize::paranoid($this->request->data['Help']['title'], $this->para_allowed);

     if ( $this->Help->save($this->request->data) ):
        if ($this->request->data['Help']['end'] == 0 && !isset($this->request->data['Help']['id'])):
             $id = $this->Help->getLastInsertID();
             $return = '/admin/helps/edit/'.$id;
	elseif ($this->request->data['Help']['end'] == 0 && isset($this->request->data['Help']['id'])):
             $return = '/admin/helps/edit/'.$this->request->data['Help']['id'];
	elseif($this->request->data['Help']['end'] == 1):
             $return = '/admin/helps/listing'; 
	endif;
        $this->msgFlash(__('Data saved', true), $return);    
     endif;
    elseif($help_id != null && intval($help_id)):        
        $this->request->data = $this->Help->read(null, $help_id);
    endif;
 }
 
 public function admin_delete($help_id)
 {
   if ( $this->Help->delete($help_id) ):
           $this->msgFlash(__('Data removed', true),'/admin/helps/listing');
   endif;
 }

 // deliver a bug report  
 private function __sendNewReport($report) 
 {
    $this->Email->to       = 'mmontoya@gmail.com';
    $this->Email->bcc      = array('contact@chipotle-software.com');  // note
    // this could be just a string too
    $this->Email->subject  = 'Karamelo e-Learning:: bug report';
    $this->Email->replyTo  = 'support@karamelo.org';
    $this->Email->from     = 'Chipotle-software.com';
    $this->Email->template = 'report'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'text'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('report', $report);
    //Do not pass any args to send() 
    if ( $this->Email->send() ):
            return True; 
    else:
            return False;
    endif;
 }
  
}
?>
