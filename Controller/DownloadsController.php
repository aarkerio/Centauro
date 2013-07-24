<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/DownloadsController.php

 
App::uses('Sanitize', 'Utility');

class DownloadsController extends AppController
{  

/**
 *  
 *  @access public
 *  @return void
 */
 public $helpers = array('Ck', 'Time');

/**
 *  
 *  @access public
 *  @return void
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('index', 'lastDownload', 'display'));
 }
 
/**
 *  Element 
 *  @access public
 *  @return void
 */
 public function lastDownload() 
 {
   $params = array('conditions' => Null,
                   'fields'     => array('Download.id', 'Download.title', 'Download.url', 'Catdownload.id'),
                   'order'      => 'Download.id DESC');
   return $this->Download->find('first', $params);
 }
   
/**
 *  Show Download categories
 *  @access public
 *  @return void
 */
 public function index()
 {
  $this->layout  = 'portal';
  $params = array('order'   =>  'Catdownload.title',
                  'contain' => False);
  $this->set('data', $this->Download->Catdownload->find('all', $params));
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function display($catdownload_id)
 {
    $this->layout    = 'portal';
    $params = array(
        'conditions' =>  array('Download.catdownload_id'=>$catdownload_id),
        'fields'     =>  array('Download.id', 'Download.catdownload_id', 'Download.title', 'Download.url', 'Download.description', 'Catdownload.title', 'User.username'),
        'order'      =>  'Download.catdownload_id',
        'limit'      =>  40);
    $this->set('data', $this->Download->find('all', $params));
 }


 /**== ADMIN METHODS==**/

/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_listing()
 {  
   $this->layout    = 'admin';
   $this->pageTitle = 'Download';
   $params = array(
          'conditions'      => array('user_id' => $this->Auth->user('id')),
          'fields'          => array('Download.id', 'Download.user_id', 'Download.title', 'Download.description', 'Download.catdownload_id'),
          'order'           => 'Download.id DESC');
   $this->set('data', $this->Download->find('all', $params));
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_edit($download_id = Null)
 {
  $this->layout    = 'admin';   
  $this->set('catdownloads',Set::combine($this->Download->Catdownload->find('all',array('order'=>'title')),"{n}.Catdownload.id","{n}.Catdownload.title"));

  if (!empty($this->request->data['Download'])):
      if ( !isset($this->request->data['Download']['id']) ):  # new download
          $this->request->data['Download']['user_id'] = (int) $this->Auth->user('id');
      endif;
      #die(debug($this->request->data));
          
      if ($this->Download->save($this->request->data)):
          if ($this->request->data['Download']['end'] == 0 && !isset($this->request->data['Download']['id'])):  # INSERT INTO
              $id = (int) $this->Download->getLastInsertID();
              $return = '/admin/downloads/edit/'.$id;    
	      elseif ($this->request->data['Download']['end'] == 0 && isset($this->request->data['Download']['id'])):  # UPDATE 
              $return = '/admin/downloads/edit/'.$this->request->data['Download']['id'];
	      elseif ($this->request->data['Download']['end'] == 1 ):
	          $return = '/admin/downloads/listing';
	      endif;
          $this->msgFlash(__('Data saved'),$return);
          return True;
      else:
          die(debug($this->Download->validationErrors));
      endif;
  elseif($download_id != Null && intval($download_id)):  
      $this->request->data = $this->Download->read(Null, $download_id); 
  endif;
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_delete($download_id)
 {
  if ( $this->Download->delete($download_id) ):
      $msg = __('Data removed');
  else:
      $msg = __('Data NOT removed');
  endif;
  $this->msgFlash($msg,'/admin/downloads/listing');
 }
}

# ? > EOF
