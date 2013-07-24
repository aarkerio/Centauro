<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controllers/BannersController.php
 
App::uses('Sanitize', 'Utility');

class BannersController extends AppController
{

 public $helpers       = array('User');

/**
 *    
 *  @access public
 *  @return void
 */ 
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('randomBanner'));
 }

/**
 *    
 *  @access public
 *  @return void
 */ 
 public function randomBanner() 
 {
 
  $order      = 'RANDOM()';
  $randomRow = $this->Banner->field('id', array('id >'=>'0'), $order);
  #die(debug($randomRow));
  return $this->Banner->find('first', array('conditions'=>array('Banner.id' => $randomRow), 'fields'=>array('Banner.tooltip', 'Banner.link', 'Banner.img')));
 }

 /****===== ADMIN SECTIONS    =======*****/
/**
 *    
 *  @access public
 *  @return void
 */ 
 public function admin_listing()
 {   
   $this->layout    = 'admin';
        
   $params = array(
                   'fields'     => array('id', 'img', 'link', 'tooltip'),
                   'order'      => 'Banner.id DESC'
                   );
   $this->set('data', $this->Banner->find('all', $params));
 }

/**
 *    
 *  @access public
 *  @return void
 */ 
 public function admin_add() 
 {
  # die(print_r($this->params)); 
  $this->layout    = 'admin';
  if ( !empty($this->request->data['Banner']) ):
       $this->request->data['Banner'] = Sanitize::clean($this->request->data['Banner']);
       if ($this->Banner->save($this->request->data['Banner'])):     
           $this->msgFlash('Banner add', '/admin/banners/listing');
       endif;
  endif;
 }

/**
 *  DELETE  
 *  @access public
 *  @return void
 */ 
 public function admin_delete($id)
 { 
   if ($this->Banner->delete($id)):
       $this->msgFlash('Banner deleted', '/admin/banners/listing');
   endif;
 }
}

# ? > EOF
