<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/QuotesController.php

App::uses('Sanitize', 'Utility');

class QuotesController extends AppController {
    
 public $helpers     = array('Form', 'Gags');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('randomQuote'));
 }

 public function randomQuote() 
 { 
  $order      = 'RANDOM()';
  $randomNumber = $this->Quote->field('id', array('id >'=>'0'), $order);
  $params = array('conditions' => array('Quote.id' => $randomNumber), 
                  'fields'     => array('Quote.quote', 'Quote.author', 'User.username'));
  return $this->Quote->find('first', $params);
 }

 /** == ADMIN METHODS == **/
 public function admin_add() 
 {
   if (!empty($this->request->data['Quote'])):
      $this->request->data['Quote'] = Sanitize::clean($this->request->data['Quote']); //Hopefully this is enough
      $this->request->data['Quote']['user_id'] = (int) $this->Auth->user('id');   
      if ( $this->Quote->save($this->request->data)):
         $this->msgFlash('Data saved', '/admin/quotes/listing');
      endif;
   endif;
 }
 
 public function admin_listing()
 {
  $this->layout    = 'admin';
  $this->pageTitle = 'Quotes';
  $params  = array(
       'conditions'      => array('user_id' => $this->Auth->user('id')),
       'fields'          => array('id', 'quote', 'author'),
       'order'           => 'author DESC');
  $this->set('data', $this->Quote->find('all', $params));
 }
   
 public function admin_edit($quote_id=null)
 {
   $this->layout     = 'admin';
   if (empty($this->request->data['Quote'])):   
       $this->request->data  = $this->Quote->read(Null, $quote_id);
   else:
       if ($this->Quote->save($this->request->data)):
      	  $this->msgFlash('Data saved', '/admin/quotes/listing');
       endif;
   endif;
 }

 public function admin_delete($quote_id)
 {
   if ($this->Quote->delete($quote_id)):
        $this->msgFlash('Data removed', '/admin/quotes/listing');
   endif;
 }
}

# ? > EOF
