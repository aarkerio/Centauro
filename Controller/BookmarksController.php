<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/bookmarks_controller.php


App::uses('Sanitize', 'Utility');

class BookmarksController extends AppController {
    
 public $helpers       = array('User',  'Gags');
    
 public $components    = array('RequestHandler');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('feeder'));
 }

 /**
  * Create an rss feed of the 15 last uploaded uses the RSS component
  *
  */
  public function feeder($username) 
  {
    $conditions  = array('User.username'=>trim($username));
    $user_id     = $this->Bookmark->User->field('User.id', $conditions);
    $channelData = array('title'       => $username . "'s Bookmarks",
		                 'link'        => array('controller' => 'blog', 'action' => $username),
		                 'description' => 'Hacktivismo',
		                 'language'    => 'es-mx'
	                );
         
    $params = array('conditions' => array('Bookmark.user_id'=>$user_id),
                    'fields'     => array('Bookmark.id', 'Bookmark.name', 'Bookmark.url', 'Bookmark.created'),
                    'order'      => 'Bookmark.name ASC',
                    'limit'      => 50);
   
    $bookmarks = $this->Bookmark->find('all', $params);
    #die(debug($bookmarks));
    $this->set(compact('channelData', 'bookmarks'));  
  }

/*** ====  ADMIN SECTION    =====****/

public function admin_export($username)
{  
       
   $this->layout = 'ajax';
   $user_id =  $this->Bookmark->User->field('User.id', array("User.username"=>$username));
   
   $params = array('conditions' => array('Bookmark.user_id'=>$user_id));
   $data = $this->Bookmark->find('all', $params);
   #die(debug($data));
   $this->set('data', $data);
       
   $this->set('username', $username);
  }

public function admin_add() 
{
  if (!empty($this->request->data['Bookmark'])):
      $this->request->data['Bookmark'] = Sanitize::clean($this->request->data['Bookmark']);         
      $this->request->data['Bookmark']['user_id'] = (int) $this->Auth->user('id');
         
	  if ( $this->Bookmark->save($this->request->data)):
            $this->msgFlash('Bookmark saved','/admin/bookmarks/listing');
      endif;
  endif;
 }
 
 public function admin_listing()
 {
   $this->layout    = 'admin';
   $this->pageTitle = 'Bookmarks';
   $params = array(
          'conditions'      => array('Bookmark.user_id' => $this->Auth->user('id')),
          'fields'          => array('Bookmark.id', 'Bookmark.name', 'Bookmark.url'),
          'order'           => 'Bookmark.name ASC');
   $this->set('data', $this->Bookmark->find('all', $params));
 }
  
 public function admin_edit($bookmark_id=null)
 {
  if (empty($this->request->data['Bookmark'])):
        $this->layout        = 'admin';       
        $this->request->data          = $this->Bookmark->read(null, $bookmark_id);
  else:
        $this->request->data['Bookmark'] = Sanitize::clean($this->request->data['Bookmark']);      
        if ($this->Bookmark->save($this->request->data)):
           $this->msgFlash('Bookmark saved','/admin/bookmarks/listing');
        endif;
  endif;
 }

 public function admin_delete($bookmark_id)
 {
   if ( $this->Bookmark->delete($bookmark_id)):
		$this->msgFlash('Bookmark has been deleted', '/admin/bookmarks/listing');
   endif;
 }
}
# ? >
