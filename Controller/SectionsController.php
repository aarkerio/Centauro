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

class SectionsController extends AppController
{  
 public $helpers = array('Form', 'Time');

/**
 * Display
 * @access public
 * @return void
 */ 
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'vote'));
 }

/**
 * Display
 * @access public
 * @return void
 */ 
 public function display()
 {
  $this->layout = 'admin';
  $params = array('fields' => array('id', 'description', 'order', 'img'),
                  'order'  => 'Section.description ASC'
                 );
  $sections     = $this->Section->find('all', $params);

  if (isset($this->params['requested'])):
      return $sections;
  endif;

  $this->set('data', $sections);    
 }
   
 /****===== ADMIN SECTIONS    =======*****/
 
/**
 * Display
 * @access public
 * @return void
 */ 
 public function admin_listing() 
 {
  $this->layout = 'admin';
  $params = array(
                  'fields'       => array('order', 'description', 'img', 'id'),
                  'order'        => 'description',
                  'limit'        => 25);
  $this->set('data', $this->Section->find('all', $params)); 
  }
 
/**
 * Display
 * @access public
 * @return void
 */ 
 public function admin_edit($id = null)
 {
  $this->layout = 'admin';
  if (empty($this->request->data)):
        $this->Section->id = $id;     
        #$this->set('subjects', $this->Subject->generateList()); 		
        $this->request->data = $this->Section->read();
  else:
        if ($this->Section->save($this->request->data)):
            $this->msgFlash('Story has been updated.','/admin/pages/sections');
        endif;
  endif;
 }
  
/**
 * Display
 * @access public
 * @return void
 */ 
 public function admin_delete($id)
 {
   $this->Section->delete($id);
   $this->msgFlash('Section has been deleted','/admin/pages/sections');
 }
}
# ? >
