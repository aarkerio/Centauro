<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/confirms_controller.php


App::uses('Sanitize', 'Utility');

class ConfirmsController extends AppController
{  
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('signup'));
 }
   
 public function signup($secret=null)
 {
   $this->layout    = 'portal';   
   $params = array('conditions' => array('Confirm.secret'=>trim($secret)),
                   'fields'     => array('Confirm.id', 'Confirm.user_id')
                   );
   $data  = $this->Confirm->find('first', $params);
   if ( $data ):
       $this->Confirm->User->id = (int) $data['Confirm']['user_id'];
       if ( $this->Confirm->User->saveField('active', 1) ):
           $msg = 'The registration process has finished succesfully';
       else:
           $msg = 'The registration process has failed miserably';
	   endif;
   endif;
   
   $this->set('msg', $msg);
 }
}

# ? > EOF
