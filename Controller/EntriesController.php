<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/EntriesController.php

App::uses('Sanitize', 'Utility');
App::import('Vendor','inputfilter');

class EntriesController extends AppController {
 
/**
 *  CakePHP Helpers
 *  @var array
 *  @access public
 */ 
 public $helpers       = array('Ck', 'Text');

/**
 *  Cake paginate
 *  @var array
 *  @access public
 */ 
 public $paginate = Null;
 
/**
 *  CakePHP Helpers
 *  @var array
 *  @access public
 */ 
 public $components    = array('Blog', 'RequestHandler', 'Mailer');


 private $_entries = array();

/**
 *  Auth Component defining permissions
 *  @access public
 *  @return void
 */ 
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('securimage', 'display', 'view', 'lastEntries', 'tagged', 'rss', 'totalVisits', 'search'));
 }

/**
 *  Last entries
 *  @access public
 *  @return void
 */
 public function lastEntries() 
 {  
   $params = array(
          'conditions' => array('Entry.status'=>1),
          'fields'     => array('Entry.title', 'Entry.id', 'Entry.user_id', 'User.username'),
          'order'      => 'Entry.id DESC',
          'limit'      => 10);
   return $this->Entry->find('all', $params); 
 }

/**
 *  Last entries
 *  @access public
 *  @return void
 */
 public function totalVisits($user_id) 
 {  
   return $this->Entry->totalVisits($user_id);
 }

/**
 *  Display
 *  @access public
 *  @return void
 */
 public function display($username) 
 {
  $this->layout = 'blog';
  $this->Blog->setUserId($username); 
  $user_id = $this->Blog->getUserId();
  $this->paginate['Entry'] = array(
           'conditions' => array('Entry.user_id'=>$user_id, 'Entry.status' => 1),
           'order'      => 'Entry.id DESC',
           'fields'     => array('Entry.title', 'Entry.body', 'Entry.created', 'Entry.user_id', 'Entry.discution', 'Entry.themeblog_id', 'Entry.id', 
                                'User.username', 'Themeblog.title', 'Themeblog.id'),
           'limit' => 10);
  $data = $this->paginate('Entry');
  #die(debug($data));
  $this->set(compact('data'));
 }

/**
 *  View entry
 *  @access public
 *  @return void
 */
 public function view($username, $entry_id) 
 {
  $this->__visits($entry_id); # sum 1 to visits
  $this->layout    = 'blog';
  $this->Blog->setUserId($username);   # set blog sidebars
  $user_id = $this->Blog->getUserId();
  
  $params  =array('conditions' => array('Entry.id'=>$entry_id),
                  'fields'      => array('Entry.title', 'Entry.body', 'Entry.created', 'Entry.user_id', 'Entry.discution', 'Entry.visits','Entry.themeblog_id', 
                                         'Entry.id', 'User.username', 'Themeblog.title', 'Themeblog.id')
      );
  $data =  $this->Entry->find('first', $params);

  $this->set('data', $data);
 }

/**
 *  sum 1 to visits
 *  @access public
 *  @return void
 */
 private function __visits($entry_id)
 {
  #die(debug($this->_entries));
  $this->_entries = $this->Session->read('Entries');
  if ( $this->_entries === Null):
      $this->_entries = array();
  endif;
  
  if ( in_array($entry_id, $this->_entries) ):
      return;
  else:
      $this->Entry->addVisit($entry_id);
      array_push($this->_entries, $entry_id);
      $this->Session->write('Entries', $this->_entries);
  endif;
 }

/**
 *  Results  
 *  @access public
 *  @return void
 */
 public function results($terms) 
 {
   $params = array('conditions' => array('Entry.body'=>$string));
   $data   = $this->Entry->find('all', $params);
   $this->set('data', $data);
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function tagged($username, $tag) 
 { 
   $this->layout = 'blog';
   $user_id = $this->Entry->User->field('id', array('username'=>$username));   
   $params = array(
        'conditions' => array("Entry.tags LIKE '%$tag%'", 'Entry.user_id'=>$user_id, 'Entry.status'=>1),
        'fields'     => array('Entry.id', 'Entry.title'),
        'order'      => 'Entry.created DESC',
        'limit'      => 30
       );
   
   $this->Blog->setUserId($username);   # set blog sidebars
   $this->set('data', $this->Entry->find('all', $params));
   $this->set('tagCloud', $this->Blog->tagCloud($username)); # tagCloud
 }

/**
 *  Entries  tags
 *  @access public
 *  @return void
 */
 public function tags($username) 
 {     
  $params = array('conditions' => array('username'=>$username), 
                  'fields'     => array('id', 'tags'),
                  'contain'    => False
                  );
  $userdata    = $this->Entry->User->find('first', $params);
  $Tags = explode(",", trim($userdata['User']['tags']));
  sort($Tags);
  $tagCloud = array();
  foreach ($Tags as $t):
      $t = trim($t);
      $tagCloud[$t] = $this->Entry->findCount(array("Entry.tags LIKE '%$t%'", 'Entry.user_id'=>$userdata['User']['id'], 'Entry.status'=>1));
  endforeach;
  return $tagCloud;
 }
	
/**
 *  Historic
 *  @access public
 *  @return void
 */
 public function historic($username)
 {
  $this->layout = 'blog';      
  $user_id = $this->User->field('id', array('username'=>$username));     
  $style = $this->Style->field('style', array('user_id' => $user_id));
  $order    = "date_part('year', fecha), date_part('month', fecha)";
  $fields   = array('Entry.title', 'Entry.body', 'Entry.created', 'Entry.user_id', 'Entry.discution', 'Entry.themeblog_id', 'Entry.id', 'User.username', 'Themeblog.title', 'Themeblog.id');
       
  if ( $Entry_id != null && is_numeric( $Entry_id ) ):
      $limit      = 1;     
      $conditions = array('Entry.user_id'=>$user_id, 'Entry.id'=>$Entry_id);
  else:
      $limit      = 10;         
      $conditions = array('Entry.user_id'=>$user_id);
  endif;
  $this->set('username', $username);

  $params = array(
                  'conditions' => $conditions,
                  'fields'     => $fields,
                  'order'      => $order,
                  'limit'      => $limit
                 );
  $this->set('data', $this->Entry->find('all', $params)); 
        
  $this->set('Entry_id', $Entry_id);
 }
   
/**
 *  Feeder
 *  @access public
 *  @return void
 */
 public function rss($username) 
 {
  $channelData = array('title'       => 'Blog Recent Writing | '. $username,
		               'link'        => array('controller' => 'entries', 'action' => 'view', $username),
		               'description' => $username . 's Blog',
		               'language'    => 'es-mx'
	                );
           
  $user_id =  $this->Entry->User->field('id', array('User.username'=>$username));
     
  $params = array(
     'conditions' => array('Entry.status'=>1, 'Entry.user_id'=>$user_id),
     'fields'     => array('Entry.id', 'Entry.title', 'Entry.tags', 'Entry.created', 'User.username', 'User.avatar'),
     'order'      => 'Entry.created DESC', 
     'limit'      =>10 );
  $entries = $this->Entry->find('all', $params);
  $this->set('username', $username);
  $this->set(compact('channelData', 'entries'));   
 }

/**
 *  Search entries
 *  @access public
 *  @return void
 */
 public function search()
 {
  $this->layout    = 'blog';
  $this->Blog->setUserId($this->request->data['Entry']['username']);   # set blog sidebars
  $user_id = $this->Blog->getUserId();
  $terms = Sanitize::escape($this->request->data['Entry']['terms']);
  $data = $this->Entry->search($terms, $user_id);

  #$this->set('username', $username);
  $this->set('data', $data);
 }
   
 /*************=== ADMIN METHODS =====****/

/**
 *  Display Entries
 *  @access public
 *  @return void
 */
 public function admin_listing() 
 {
  $this->layout    = 'admin';
  $this->paginate['conditions'] = array('Entry.user_id'=>$this->Auth->user('id'));       
  $this->paginate['fields']     = array('Entry.id', 'Entry.title', 'Entry.status');
  $this->paginate['limit']      = 20;
  $this->paginate['order']      = 'Entry.id DESC';
  $data = $this->paginate('Entry');
  $this->set(compact('data'));        
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_start() 
 {
   $this->layout    = 'admin';
 }
   
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_edit($entry_id = Null)
 {
  # exit(debug( $this->request->data ) );
  $this->layout    = 'admin';
  $user_id = (int) $this->Auth->user('id');
  $this->set('themes', Set::combine($this->Entry->Themeblog->find('all',array('order'=>'title', 'conditions'=>array('Themeblog.user_id'=>$user_id))),"{n}.Themeblog.id","{n}.Themeblog.title"));
   
  $tags = explode(",", $this->Entry->User->field('tags', array('User.id'=>$user_id)));
     
  $this->set('etis', $tags);
  
  if (!empty($this->request->data['Entry'])):
    if ( !isset($this->request->data['Entry']['id']) ):  // new entry
           $this->request->data['Entry']['user_id'] = (int) $this->Auth->user('id');
     endif;
     $this->request->data['Entry']['title']   = Sanitize::paranoid($this->request->data['Entry']['title'], $this->para_allowed);     
     $this->request->data['Entry']['tags']    = Sanitize::paranoid($this->request->data['Entry']['tags'], $this->para_allowed);
          
     if ($this->Entry->save($this->request->data)):
              if ($this->request->data['Entry']['end'] == 0 && !isset($this->request->data['Entry']['id'])):  // INSERT INTO
                  $id = $this->Entry->getLastInsertID();
                  $return = '/admin/entries/edit/'.$id;    
	      elseif ($this->request->data['Entry']['end'] == 0 && isset($this->request->data['Entry']['id'])):  // UPDATE 
                  $return = '/admin/entries/edit/'.$this->request->data['Entry']['id'];
	      elseif ($this->request->data['Entry']['end'] == 1 ):
	             $return = '/admin/entries/listing';
	      endif;
              $this->msgFlash(__('Data saved'),$return);
      endif;
  elseif($entry_id != null && intval($entry_id)):  
      $this->request->data = $this->Entry->read(null, $entry_id); 
  endif;
 }
 
/**
 *  Delete entry
 *  @access public
 *  @param integer $entry_id
 *  @return void
 */ 
 public function admin_delete($entrie_id)
 {
   if ($this->Entry->delete($entrie_id)):
       $this->msgFlash('Data removed', '/admin/entries/listing');
   else:
	   $this->Session->setFlash(sprintf(__('%s was not deleted', True), 'Entry'));
	   $this->redirect(array('action' => 'listing'));
   endif;
 }
  
/**
 *  Change news status published/draft
 *  @access public
 *  @return void
 */ 
  public function admin_change($entry_id, $status)
  {  
    $new_status = ($status == 0 ) ? 1 : 0;
     
    $this->Entry->id    = (int) $entry_id;
     
    if ($this->Entry->saveField('status', $new_status)):
        $this->msgFlash('Status changed', '/admin/entries/listing');
	endif;
  }
}
# ? > EOF
