<?php
/**
*  Centauro Intranet Portal
*  GPLv3
*  @copyright Copyright 2006-2012, Chipotle Software, Inc.
*  @version 0.8
*  @package forums
*  @license http://www.gnu.org/licenses/gpl-3.0.html
*/
# file : app/Controller/CorumsController.php

App::uses('Sanitize', 'Utility');

class ForumsController extends AppController
{
 public $helpers       = array('Time');
 
 public $components    = array('Blog', 'Email');

/**
 *  Auth Component permisssions
 *  @access public
 *  @return void 
 */ 
 public function beforeFilter() 
 {
    parent::beforeFilter();
    if ($this->Auth->User()):
        $this->Auth->allow(array('display', 'discussion', 'view', 'index'));
    endif;
 }

/**
 *   
 *  @access public
 *  @return void
 */ 
 public function index() 
 {
  $this->layout = 'portal';
  $params = array('conditions' => array('Forum.status'=>1),
                  'contain'    => 'Catforum',
                  'fields'     => array('Forum.title', 'Forum.id', 'Forum.user_id', 'Forum.description', 'Forum.catforum_id', 'Catforum.title'));
  $data       = $this->Forum->find('all', $params);
  $this->set('data', $data);
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function discussion($username, $forum_id, $topic_id)
 { 
   $params = array('conditions' => array("Topic.id = $topic_id OR Topic.topic_id=$topic_id"));
   $this->Forum->Topic->User->unbindAll();
   $data = $this->Forum->Topic->find('all', $params);
   $this->set('data', $data);
   $this->Blog->setUserId($username);
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function view($username, $forum_id, $topic_id) 
 {
   $params = array('conditions' => array('Forum.id'=>$forum_id));
   $this->Blog->setUserId($username);
   $this->set('data', $this->Forum->find('first', $params));
 }
 
/* === ADMIN METHODS == */
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_listing() 
 {  
    $this->layout = 'admin';
    $params = array('conditions'=> array('Forum.user_id'=>$this->Auth->user('id')));
    $this->set('data', $this->Forum->find('all', $params));
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_topics($forum_id)
 {
    if ( !is_int($forum_id) ):
       $this->redirect('/');
       return false;
    endif;
    
    $this->layout = 'admin';  
    $params = array('conditions' => array('Forum.user_id'=>$this->Auth->user('id'), 'Forum.id'=>$forum_id));
    $this->set('data', $this->Forum->find('first', $params));
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_edit($catforum_id = null, $forum_id = null)
 {
   $this->layout = 'admin';
   $this->set('vclassrooms', $this->Forum->User->getVclassrooms($this->Auth->user('id'), True));
  
   if (!empty($this->request->data['Forum'])):
        if ( !isset($this->request->data['Forum']['id']) ):
            $this->request->data['Forum']['user_id'] = (int) $this->Auth->user('id');
        endif;
        $this->request->data['Forum']['title']   = Sanitize::paranoid($this->request->data['Forum']['title'], $this->para_allowed);
        $this->request->data['Forum']['user_id'] = (int) $this->Auth->user('id');
        if ($this->Forum->save($this->request->data)):
	        if ($this->request->data['Forum']['end'] == 0 && !isset($this->request->data['Forum']['id'])):
                $id = $this->Forum->getLastInsertID();
                $return = '/admin/forums/edit/'.$this->request->data['Forum']['catforum_id'].'/'.$id;    
            elseif ($this->request->data['Forum']['end'] == 0 && isset($this->request->data['Forum']['id'])):
                $return = '/admin/forums/edit/'.$this->request->data['Forum']['catforum_id'].'/'.$this->request->data['Forum']['id'];
	        elseif ($this->request->data['Forum']['end'] == 1 ):
	             $return = '/admin/catforums/listing';
	        endif;
            $this->msgFlash(__('Data saved', true),$return);
	    endif;
   elseif($forum_id != null && intval($forum_id)):
        $this->request->data = $this->Forum->read(null, $forum_id);
   elseif($catforum_id != null && intval($catforum_id)):
        $this->set('catforum_id', $catforum_id);
   endif;
 }


/**
 *  Change status published/draft 
 *  @access public
 *  @return void
 */
 public function admin_change($status, $forum_id)
 {  
    if ( !is_numeric($status)  ||  !intval($forum_id) ): 
        $this->redirect('/');
        return False;
    endif;
    $new_status = ($status == 0 ) ? 1 : 0;
     
    $this->Forum->id = (int) $forum_id;
     
    if ($this->Forum->saveField('status', $new_status)):
	    $this->msgFlash(__('Status modified', True), '/admin/catforums/listing');
    endif;
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_delete($forum_id)
 {
    if ( $this->Forum->delete($forum_id) ):           
         $this->msgFlash(__('Data removed', true), '/admin/catforums/listing');
    endif;
 }
}
?>
