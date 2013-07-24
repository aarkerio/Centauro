<?php
/**
 *  Centauro Intranet Portal
 *  GPLv35B
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/PagesController.php
 
App::uses('Sanitize', 'Utility');

App::import('Vendor','inputfilter');

class PagesController extends AppController {  

/**
 *
 * @access public
 * @return void
 */
 public $helpers       = array('Gags', 'Ck');

/**
 *
 * @access public
 * @return void
 */   
 public $components    = array('Email');

/**
 *
 * @access public
 * @return void
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'view', 'rankPages', 'printing', 'last', 'section', 'faq', 'author'));
 }
   
 /***=====  SECTION PUBLIC =====***/

/**
 *
 * @access public
 * @return void
 */
 public function rankPages() 
 {
   $params = array('conditions' => array('Page.status' => '1'),
                   'fields'     => array('Page.title', 'Page.user_id', 'Page.rank', 'Page.id'),
                   'order'      => 'Page.rank DESC',
                   'contain'    => False,
                   'limit'      => 10);
   $data = $this->Page->find('all', $params);
   
   return $data;
 }
   
/**
 *
 * @access public
 * @return void
 */
 public function faq() 
 {
   $this->layout    = 'portal';
 }

/**
 *
 * @access public
 * @return void
 */
 public function section($section_id) 
 {
   $this->layout    = 'portal';
   $params = array('conditions'      => array('Page.section_id'=>$section_id, 'Page.status'=>1),
                   'fields'          => array('Page.id', 'Page.title', 'Section.description', 'Section.img'),
                   'order'           => 'Page.title ASC',
                   'limit'           => 80);
   $this->set('data', $this->Page->find('all', $params));
 }
   
/**
 * Display 
 * @access public
 * @return void
 */
 public function display($page_id) 
 {   
  $this->layout    = 'portal';
  if ( $this->Session->check('page_'.$page_id) ):
      $this->Page->oneMore($id);   # if not visted before, sum 1 view
  endif;

  $params = array('conditions' => array('Page.id' => $page_id, 'Page.status'=>1),
                  #'fields' => array('Page.id', 'Page.updated', 'Page.title', 'Page.cv',  'Page.body', 'Page.created', 'Page.display', 'Page.rank', 
                  #                  'Page.section_id', 'Page.discussion'),
                  #'contain' => array('User', 'Section') 
                 );
      
   $data = $this->Page->find('first', $params);   
  
   $this->set('data', $data);
 }

/**
 * Description
 * @access public
 * @return void
 */ 
 public function author($username, $id) 
 {   
  $this->layout    = 'portal';
  $params = array('conditions' => array('user_id'=>$id, 'status'=>1),
                  'fields'     => array('Page.id', 'Page.title', 'Page.display', 'Page.rank', 'Page.updated', 'Page.section_id', 'Page.discussion', 
                                        'User.id', 'User.username'), 
                  'order'      => 'section_id'
                     );
  $this->set('data', $this->Page->find('all', $params)); 
 }

/**
 * Description
 * @access public
 * @return void
 */
 public function printing($page_id)
 {  
  $this->layout = 'printing';
  $params = array('conditions'=>array('Page.id' => $page_id, 'Page.status'=>1),
                  'fields'    =>array('Page.id', 'Page.title','Page.body', 'Page.created', 'Page.display', 'Page.rank','Page.section_id', 'Page.updated'),
                  'recursive'=>2
                 );
  $data   = $this->Page->find('first', $params);
 
  $this->set('data', $data);
 }

/**
 * Description
 * @access public
 * @return void
 */
 public function last() 
 {  
  $this->layout    = 'portal';
  $params = array('conditions' => array('Page.status'=>1),
                  'fields'     => array('Page.id', 'Page.title', 'Page.rank'),
                  'order'      => 'Page.updated DESC',
                  'limit'      => 25);
  $this->set('data', $this->Page->find('all', $params));
 }

/**
 * Description
 * @access public
 * @return void
 */
 public function search()
 {
   $this->layout    = 'portal';
   $params = array('conditions' => array('Page.status'=>1),
                   'fields' => array('Page.id', 'Page.title', 'Page.rank'),
                   'order' => 'Page.id DESC',
                   'limit' => 25);
   $this->set('data', $this->Page->find('all', $params));
  }
  
 /*****=== SECTION ADMIN =====*/ 
/**
 * Description
 * @access public
 * @return void
 */
 public function admin_listing($section_id) 
 {
   $this->layout      = 'admin';
   $params = array('conditions' => array('Page.user_id'=>$this->Auth->user('id'), 'Page.section_id'=>$section_id),
                   'fields'     => array('Page.id', 'Page.title', 'Page.status', 'Page.rank', 'Page.created', 'Page.user_id', 
                                         'Section.id', 'Section.img', 'Section.description'),
                   'order'      => 'Page.title ASC',
                   'limit'      => 80);
   $this->set('data', $this->Page->find('all', $params));     
 }

/**
 * Description
 * @access public
 * @return void
 */
 public function admin_sections() 
 {
   $this->layout = 'admin';
   $this->pageTitle = 'Seccion';   
   $this->set('data', $this->Page->Section->find('all'));
 }  

/**
 * Description
 * @access public
 * @return void
 */
 public function admin_edit($page_id = null)
 {
  $this->layout = 'admin';
  $this->set('sections', Set::combine($this->Page->Section->find('all',array('order'=>'description')),'{n}.Section.id','{n}.Section.description'));
  if (!empty($this->request->data['Page'])):
     $this->request->data['Page']['updated'] = 'now()';
     # New page
     if ( !isset($this->request->data['Page']['id'])):
         $this->request->data['Page']['user_id'] = (int) $this->Auth->user('id');
     endif;
     if ($this->Page->save($this->request->data)):
         if ($this->request->data['Page']['end'] == 0 && !isset($this->request->data['Page']['id'])):  # INSERT INTO 
              $id = $this->Page->getLastInsertID();
              $return = '/admin/pages/edit/'.$id;  
	 elseif ($this->request->data['Page']['end'] == 0 && isset($this->request->data['Page']['id'])): # UPDATE 
	      $return = '/admin/pages/edit/'.$this->request->data['Page']['id'];
	 elseif ( $this->request->data['Page']['end'] == 1):
	      $return = '/admin/pages/listing/'.$this->request->data['Page']['section_id'];
	 endif;
         $this->msgFlash('Saved', $return);   
     endif;
  elseif($page_id != null && intval($page_id)):
      $this->request->data = $this->Page->read(null, $page_id);
  endif;
 }
 
/**
 * Description
 * @access public
 * @return void
 */
 public function admin_delete($page_id)
 {
   if ($this->Page->delete($page_id)):
        $this->msgFlash('Data Removed', '/admin/pages/sections');
   endif;
 }
}
?>
