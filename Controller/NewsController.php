<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2006-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: APP/Controller/NewsController.php

App::uses('Sanitize', 'Utility');

class NewsController extends AppController {

/**
 *
 * @access public 
 * @var array
 */
 public $helpers     = array('Ck', 'News', 'Gags', 'Session');
 
/** 
 *  
 * @access public 
 * @var array
 */
 public $paginate    = array('limit' => 8, 'page' => 1, 'order' => array('News.id' => 'DESC'));

/**
 *  CakePHP components
 *  @var array
 *  @access public
 */
 public $components    = array('Captcha');

/**
 *
 * @access public 
 * @return void 
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'view', 'rankNews', 'addvote', 'category', 'rss'));
 }

/**
 *
 * @access public 
 * @return mixed array or Null
 */
 public function rankNews() 
 {  
   $params = array('conditions' => array('"News"."status" = 1 AND "News"."created" >= (CURRENT_DATE - 10)'),
                     'fields'     => array('News.title', 'News.id', 'News.user_id', 'User.username'),
                     'order'      => 'News.votes DESC',
                     'limit'      => 10);
   return $this->News->find('all', $params);
 }
 
/**
 *
 * @access public 
 * @return void 
 */
 public function display()
 {
   if (!$this->RequestHandler->isAjax() ):
       $this->layout    = 'portal';
   endif;

   $this->layout = 'portal';
   $this->paginate['limit'] = 8; 
   $this->paginate['order'] = array('News.id' => 'DESC');
   $this->paginate['conditions'] = array('News.status = 1');
   $this->paginate['fields'] = array('News.id', 'News.title', 'News.body','News.created','News.theme_id', 'News.comments', 'News.reference', 'User.username',
                                     'Theme.theme',  'Theme.img', 'Theme.description');
   $data = $this->paginate('News');
   $this->set(compact('data')); 
 }
 
/**
 *
 * @access public 
 * @return void 
 */
 public function view($news_id)
 {
  try{
   $this->layout = 'portal';     
   $params = array('conditions'=> array('News.status'=>'1', 'News.id'=>$news_id), 
                   'fields'    => array('News.id', 'News.title', 'News.votes','News.comments','News.body','News.created','News.reference','News.theme_id', 
                                        'News.user_id', 'Theme.img', 'Theme.theme', 'User.username', 'User.avatar'),
                   'contain'   => array('User', 'Theme', 'Commentnews'=>array('User')));
   $data =  $this->News->find('first', $params);
   $this->set('data',$data);
  }
  catch(Exception $e)
  {
    echo $e->getMessage();
  }
 }
  
/**
 * Create an rss feed of the 15 last uploaded uses the RSS component 
 * @access public 
 * @return void 
 */
  public function rss() 
  {
    $channelData = array('title'       => 'Despabilando la MonoNeurona',
		                 'link'        => array('controller' => 'newss', 'action' => 'view'),
		                 'description' => 'Hacktivismo',
		                 'language'    => 'es-mx'
	                    );
      
    $this->News->unbindModel(array('hasMany'=>array('Commentnews')));
   
    $params = array('conditions'      => array('News.status'=>1),
                    'fields'          => array('News.id', 'News.title', 'News.created'),
                    'order'           => 'News.id DESC',
                    'limit'           => 20);
     
    $newss = $this->News->find('all',$params);
    #die(debug($newss));
    $this->set(compact('channelData', 'newss'));
  }

/**
 * add vote to new 
 *
 * @access public 
 * @return void 
 */
  public function addvote($new_id, $karma) 
  {
   $votes = $this->News->field('News.votes', array('News.id'=>$new_id));   
   if ( !$this->Session->check('new'.$new_id) ):  
       $votes = ($karma == 'more') ?  ( $votes + 1 ) :  ( $votes - 1 ); 
       $this->News->id = $new_id;
       $this->News->saveField('votes', $votes);
       $this->Session->write('new'.$new_id);  // add the new_id to session
   endif;
   $this->set('new_id', $new_id);
   $this->set('votes', $votes);
   $this->render('votes', 'ajax');
  }

/**
 *
 * @access public 
 * @return void 
 */  
  public function category($theme_id = null) 
  {  
   $this->layout    = 'portal';
   $params = array('conditions'=> array('Theme.id' => $theme_id),
                   'fields'     => array('News.id', 'News.title', 'Theme.theme', 'Theme.img')
                  );
  
   $this->News->bindModel(
        array('belongsTo' => array(
                'Theme' => array(
                    'className' => 'Theme'
                 )
             )
          )
   );
   
   $this->set('data', $this->News->find('all', $params));
  }
  
 /***      ======ADMIN METHODS ===   *****/
/**
 *
 * @access public 
 * @return void 
 */
 public function admin_listing() 
 {     
   $this->layout    = 'admin';
   $this->pageTitle = 'My News';
   $this->paginate['fields']     = array('News.id', 'News.title', 'News.status', 'News.created');
   $this->paginate['order']  = 'News.id DESC';
   $this->paginate['limit'] = 15;
   $this->paginate['conditions']   = array('News.user_id' => $this->Auth->user('id') );             // only the user's news
   $data = $this->paginate('News');
   $this->set(compact('data'));        
 }

/**
 *
 * @access public 
 * @return void 
 */
 public function admin_spam($new_id)
 { 
  $status = 0;
  $this->News->id = (int) $new_id;
  
  if ($this->News->saveField('status',$status)):
      $this->msgFlash(__('Noticia eliminada por SPAM'),'/news/view');
  endif;
 }

/**
 *
 * @access public 
 * @return void 
 */
 public function admin_comments($page=1) 
 {
   # Pagination
   $this->layout    = 'admin';
   $this->paginate['News'] = array(   
                 'conditions' => array('News.user_id' => $this->Auth->user('id')),  # only the user news
                 'fields'     => array('News.id', 'News.title', 'News.status'),
                 'order'      => 'News.id DESC',
                 'contain'    => array('Commentnews'=>array('User')),
                 'limit'      => 45);
   $data = $this->paginate('News');
   $this->set(compact('data'));
  }

/**
 *
 * @access public 
 * @return void 
 */
  public function admin_edit($news_id = null)
  {
    if ( !$this->Auth->user('id') ):
        $this->redirect('/');
    	return False;
    endif;
    $this->layout = 'admin';   
    $this->set('themes',Set::combine($this->News->Theme->find('all',array('order'=>'theme')),"{n}.Theme.id","{n}.Theme.theme"));
    if (!empty($this->request->data['News'])):       
        $this->request->data['News']['user_id'] = (int) $this->Auth->user('id');
        if ($this->News->save($this->request->data)):
            if ($this->request->data['News']['end'] == 0 && !isset($this->request->data['News']['id'])):
                 $id = $this->News->getLastInsertID();
                 $return = '/admin/news/edit/'.$id;   
            elseif ($this->request->data['News']['end'] == 0 && isset($this->request->data['News']['id'])):
                 $return = '/admin/news/edit/'.$this->request->data['News']['id'];
            elseif ($this->request->data['News']['end'] == 1 ):
                 $return = '/admin/news/listing';
            endif;
            $this->msgFlash(__('Data saved', true),$return);
       endif;
    elseif($news_id != Null && intval($news_id)):
       $this->News->contain('Theme');
       $fields= array('News.title', 'News.body', 'News.theme_id', 'News.comments', 'News.status', 'News.reference', 'News.id');
       $this->request->data = $this->News->read($fields, $news_id);
    endif;
  }

/**
 * Change news status published/draft
 * @access public 
 * @return void 
 */
  public function  admin_delete($news_id) 
  {
   if ( $this->News->delete($news_id) ):
       $this->msgFlash('Data saved', '/admin/news/listing');
   else: 
       $this->flash('Database error!', '/admin/news/listing');
   endif; 
  }
  
 
/**
 * Change news status published/draft
 * @access public 
 * @return void 
 */
 public function admin_change($news_id, $status)
 {  
   $new_status     = ($status == 0 ) ? 1 : 0;
     
   $this->News->id = $news_id;
     
   if ($this->News->saveField('status', $new_status)):
           $this->msgFlash('News status changed', '/admin/news/listing');
   endif;
 }
}
# ? > EOF
