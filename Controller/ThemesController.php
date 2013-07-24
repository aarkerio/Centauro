<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc. (http://www.chipotle-software.com)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:APP/Controller/ThemesController.php
 
App::uses('Sanitize', 'Utility');

class ThemesController extends AppController{

 public $helpers       = array('Time');
   
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'view'));
 }
 
 public function display()
 {   
  $this->Theme->contain(); # avoid garbage
  $params  = array(
        'order'   => 'Theme.theme',
        'fields'  => array('Theme.theme', 'Theme.id', 'Theme.description', 'Theme.img'),
        'limit'   => 15);
  if (isset($this->params['requested'])):
     return $this->Theme->find('all', $params);
  endif;
  $this->set('data', $this->Theme->find('all', $params));
 }

 public function view($theme_id)
 {
  $this->layout = 'portal'; 

  $this->Theme->bindModel(
                             array('hasMany' => array('News'=>array('limit'=>80, 'fields'=>'title, id', 'conditions'=>'status = 1')))
                            );
  $params = array('conditions'   => array('Theme.id'=>$theme_id),
                  'fields'       => array('Theme.theme', 'Theme.id', 'Theme.description', 'Theme.img'),
                  'order'        => 'Theme.theme',
                  'contain'      => array('News'));
  $this->set('data', $this->Theme->find('first', $params));
 }

 /***== ADMIN METHODS ==**/   
 public function admin_listing()
 {
  $this->layout = 'admin';
       
  $params = array(
      'fields' => array('theme', 'img', 'id', 'description'),
      'order'  => 'Theme.theme');
       
  $this->set('data', $this->Theme->find('all', $params));
 }
  
 public function admin_edit($theme_id = Null)
 {
  $this->layout    = 'admin';
  if (empty($this->request->data['Theme'])):
      $this->request->data   = $this->Theme->read(Null, $theme_id);
  else:
      if ($this->Theme->save($this->request->data)):
          $this->msgFlash('Theme has been saved', '/admin/themes/listing');
      endif;
  endif;  
 }
  
 public function admin_add() 
 {
  $this->layout    = 'admin';  

  if ($this->Theme->save($this->request->data)):
      $this->msgFlash('News theme added', '/admin/themes/listing/');
  endif;
 }

 public function admin_delete($theme_id)
 {
   if ($this->Theme->delete($theme_id)):
       $this->msgFlash('Theme has been removed', '/admin/themes/listing');
   endif;
 }
}

# ? > EOF