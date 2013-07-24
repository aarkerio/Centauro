<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2006-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: controllers/markers_controller.php

class MarkersController extends AppController {

 public $name = 'Markers';

 public	function display() 
 {
  $this->layout = Null;
  $this->set('data', $this->Marker->find('all'));
 }

 public function view() 
 {
  $this->layout = 'gmap';
 }

/** == ADMIN METHODS == */
 public	function admin_index() 
 {
  $this->layout = 'admin';
  $this->Marker->recursive = 0;
  $this->paginate['conditions'] = array('user_id'=>$this->Auth->user('id'));
  $this->set('markers', $this->paginate());
 }

 public	function admin_edit($marker_id = null) 
 {
  $this->layout = 'admin';
  if (!empty($this->request->data['Marker'])):
      if ( !isset($this->request->data['Marker']['id']) ):  # new entry
          $this->request->data['Marker']['user_id'] = (int) $this->Auth->user('id');
      endif;
          
      if ($this->Marker->save($this->request->data)):
          if ($this->request->data['Marker']['end'] == 0 && !isset($this->request->data['Marker']['id'])):  # INSERT INTO
              $marker_id = $this->Marker->getLastInsertID();
              $return = '/admin/markers/edit/'.$marker_id;    
	      elseif ($this->request->data['Marker']['end'] == 0 && isset($this->request->data['Marker']['id'])):  # UPDATE 
              $return = '/admin/markers/edit/'.$this->request->data['Marker']['id'];
	      elseif ($this->request->data['Marker']['end'] == 1 ):
	          $return = '/admin/markers/index';
	      endif;
              $this->msgFlash(__('Data saved', True),$return);
      else:
          die(debug($this->Marker->validationErrors));
      endif;
  elseif($marker_id != null && intval($marker_id)):  
      $this->request->data = $this->Marker->read(null, $marker_id); 
  endif;
 }

 public	function admin_delete($marker_id = null) 
 {
  if (!$marker_id):
      $this->Session->setFlash(sprintf(__('Invalid id for %s', True), 'marker'));
	  $this->redirect(array('action'=>'index'));
  else:      
	 if ($this->Marker->delete($marker_id)):
	     $this->Session->setFlash(sprintf(__('%s deleted', True), 'Marker'));
		 $this->redirect(array('action'=>'index'));
	 else:
		 $this->Session->setFlash(sprintf(__('%s was not deleted', True), 'Marker'));
		 $this->redirect(array('action' => 'index'));
     endif;
 endif;
 }
}
# ? > EOF
