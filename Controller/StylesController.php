<?php
/**
 *  Centauro Intranet Portal
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:app/controller/todos_controller.php
 
App::uses('Sanitize', 'Utility');

class StylesController extends AppController
{  

/** ADMIN METHODS **/
/**
 *
 * @access public
 * @return void
 */
 public function admin_listing() 
 {  
  $id  = $this->Style->field('id', array('user_id'=>$this->Auth->user('id')));  
  if ($id == null):
      $this->redirect('/admin/styles/add');
  else:   
      $this->redirect('/admin/styles/edit/');
  endif;
 }
 
/**
 *
 * @access public
 * @return void
 */
 public function admin_edit() 
 {  
   $this->layout = 'admin';
   if ( isset($this->request->data['Style'])):
       if ( $this->Style->save($this->request->data) ):
           $this->msgFlash('Style saved', '/admin/styles/listing');
       else:
           $this->msgFlash('Error saving!!', '/admin/styles/listing');
       endif;
   else: 
       $this->Style->id  = $this->Style->field('id', array('user_id'=>$this->Auth->user('id')));
       $this->request->data       = $this->Style->read();
  endif;
 }
 
/**
 *
 * @access public
 * @return void
 */
 public function admin_add() 
 {  
  if ( isset($this->request->data['Style'])):
      $this->request->data['Style'] = Sanitize::clean($this->request->data['Style']);
      $this->request->data['Style']['user_id'] = (int) $this->Auth->user('id');
     
      if ( $this->Style->save($this->request->data) ):
          $this->redirect('/admin/styles/edit');
      endif;
  else:
      $this->layout ='admin';
      $this->set('style', $this->Style->field("style", array("user_id"=>1))); // the default blog style
  endif;
 }
}
# ? > EOF
