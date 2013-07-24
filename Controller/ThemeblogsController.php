<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:app/controller/themesblogs_controller.php

 
App::uses('Sanitize', 'Utility');

class ThemeblogsController extends AppController
{
 public $helpers       = array('Form');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }

/**======= Admin section ===========***/  
/**
 * Listing
 * @acces public
 * @return void
 */
 public function admin_listing()
 {       
   $this->layout = 'admin';     
   $params = array(
                   'conditions' => array('Themeblog.user_id' => $this->Auth->user('id')), 
                   'order'      => 'Themeblog.title'
                  );
   $this->set('data', $this->Themeblog->find('all', $params));
 }

/**
 * Add and update thems
 * @acces public
 * @param int $themeblog_id
 * @return void
 */   
 public function admin_edit($themeblog_id = null)
 {
   $this->layout = 'admin';
   if ( !empty($this->request->data['Themeblog']) ):
       if (  !isset($this->request->data['Themeblog']['id']) ):
           $this->request->data['Themeblog']['user_id'] = (int) $this->Auth->user('id');
       endif;
       if ( $this->Themeblog->save($this->request->data) ):
           #die(debug($this->request->data));
           $return = '/admin/themeblogs/listing';
           $this->msgFlash(__('Data saved', True), $return);   
	   endif;
   elseif($themeblog_id != null && intval($themeblog_id)):       
	   $this->request->data = $this->Themeblog->read(null, $themeblog_id);
   endif;
 }
  
 public function admin_delete($id)
 { 
  $this->Themeblog->delete($id);
  $this->msgFlash(__('Data removed', True), '/admin/themeblogs/listing');   
 }
}

# ? > EOF
