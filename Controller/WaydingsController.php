<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc. (http://www.chipotle-software.com)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#File: /APP/Controller/WaydingsController.php

App::uses('Sanitize', 'Utility');

class WaydingsController extends AppController {

/**
 *
 * @access public 
 * @return void 
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('addwayd', 'lastWaydings'));
 }

/**
 * Used in element
 * @access public 
 * @return void 
 */
 public function lastWaydings() 
 {
   $params = array(
             'fields'     => array('Wayding.created', 'Wayding.task', 'Wayding.user_id', 'User.avatar', 'User.username'),
             'order'      => 'Wayding.id DESC',
             'limit'      => 6); 
   return $this->Wayding->find('all', $params);
 }
 
/**
 *
 * @access public 
 * @return void 
 */
 public function addwayd() 
 {
  $this->layout = 'ajax';
  if (!empty($this->request->data['Wayding']) && strlen($this->request->data['Wayding']['task']) > 2):
      $this->request->data['Wayding']['user_id'] = (int) $this->Auth->user('id');  
      #avoid string bigger than 15: 
      $pieces_array = explode(" ", $this->request->data['Wayding']['task']);  
      $tmp = '';
      # chop id too large
      foreach ($pieces_array as $p):
	      if ( strlen($p) > 30):
              $p = chunk_split($p, 20);
              $p = str_replace(' ', '<br />', $p);
	      endif;
          $tmp .= $p . ' ';
      endforeach;
      
      $this->request->data['Wayding']['task'] = $tmp;
      
      $this->Wayding->save($this->request->data);   # save the wayd
  endif;
  $params = array(
         'fields'     => array('Wayding.created', 'Wayding.task', 'Wayding.user_id', 'User.avatar', 'User.username'),
         'order'      => 'Wayding.id DESC',
         'limit'      => 7);
         
  $this->set('data', $this->Wayding->find('all', $params));
  $this->render('lastwayds', 'ajax');
 }

/**
 *
 * @access public 
 * @return void 
 */
 public function display() 
 {
   $this->layout = 'portal';
   $params  = array(
          'fields'     => array('Wayding.created','Wayding.task', 'Wayding.user_id', 'User.avatar', 'User.username'),
          'order'      => 'Wayding.id DESC',
          'limit'      => 50
          );
   $this->set('data', $this->Wayding->find('all', $params));
 }

 /**== ADMIN METHODS==**/

/**
 * Edit
 * @access public 
 * @return void 
 */
 public function admin_edit($wayd_id=null)
 {  
  if (empty($this->request->data['Wayding'])):
        $this->layout = 'admin';      
        $this->request->data = $this->Wayding->read(null, $wayd_id);
  else:
        $this->request->data['Wayding']['task']    = Sanitize::paranoid($this->request->data['Wayding']['task'], $this->para_allowed);
        $this->request->data['Wayding']['user_id'] = (int) $this->Auth->user('id');
        if ($this->Wayding->save($this->request->data)):
     	    $this->msgFlash('Data saved','/admin/waydings/listing');
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
        'conditions'      => array('Wayding.user_id' => $this->Auth->user('id')),
        'fields'          => array('Wayding.id', 'Wayding.task', 'Wayding.created'),
        'order'           => 'Wayding.id DESC',
        'limit'           => 30);
  $this->set('data', $this->Wayding->find('all', $params));
 }

/**
 *
 * @access public 
 * @return void 
 */
 public function admin_delete($wayd_id)
 {
   # deletes task from database
   if ($this->Wayding->delete($wayd_id)):
       $msg = 'Data removed';
   else:
       $msg = 'Data NOT removed';
   endif;
   $this->msgFlash($msg, '/admin/waydings/listing');
 }
}

# ? > EOF
