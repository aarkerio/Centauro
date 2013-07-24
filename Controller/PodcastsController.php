<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/podcasts_controller.php

App::import('Vendor','CMP3File',array('file' => 'CMP3File.php'));
App::uses('Sanitize', 'Utility');

class PodcastsController extends AppController {
   
 public $name       = 'Podcasts';

/**
 * Load CakePHP helpers
 * @access public
 * @var array
 */
 public $helpers    = array('Rss', 'Text');

/**
 * Load CakePHP components
 * @access public
 * @var array
 */
 public $components = array('Blog', 'RequestHandler');

/**
 * Load CakePHP Acl-Auth
 * @access public
 * @var array
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('all', 'view', 'index'));
 }

/**
 * View one podcast
 * @access public
 * @var array
 */
 public function view($username, $podcast_id)
 {   
  $this->layout    = 'blog';
  $this->Blog->setUserId($username);   # set blog sidebars
  $user_id = $this->Blog->getUserId();
  $params = array(
                 'conditions' => array('Podcast.id'=>$podcast_id, 'Podcast.status'=>1),
                 'fields'     => array('id', 'title', 'description', 'created', 'filename', 'length')
                   );
   $this->set('data', $this->Podcast->find('first', $params));
  }

/**
 * View all podcast
 * @access public
 * @var array
 */  
 public function all($username=null, $podcast_id=null) 
 { 
   $conditions      = array('status'=>1);        
   if ($username != null):
       $user_id    = $this->User->field('id', array('username'=>$username));
       $conditions['user_id'] = $user_id;
   endif;
        
   $params = array(
                   'conditions' => $conditions,
                   'fields'     => array('id', 'title', 'description', 'created', 'length', 'duration'),
                   'order'      => 'id DESC',
                   'limit'      => 12);
   $this->set('data', $this->Podcast->find('all', $params)); 
  }

/**
 * RSS feeder
 * @access public
 * @return void
 */
 public function index($username) 
 {
  $params = array('conditions' => array('username'=>$username),
                  'contain'    => False,
                  'fields'     => array('User.id', 'User.username','User.name','User.email', 'User.avatar'));
  $user = $this->Podcast->User->find('first', $params);
  
  $this->set('user', $user);
  $params = array('conditions' => array('Podcast.status'=>1, 'Podcast.user_id'=>$user['User']['id']),
                  'fields'     => array('Podcast.id', 'Podcast.title', 'Podcast.filename', 'Podcast.description', 'Podcast.created', 'Podcast.duration', 
                                        'Podcast.title', 'Podcast.length'),
                  'order'      => 'Podcast.created DESC',
                  'contain'    => False,
                  'limit'      => 40);
  $podcasts = $this->Podcast->find('all', $params);
  $this->set(compact('podcasts'));
 }
    
/***********====ADMIN SECTION====***/    

 public function admin_listing()
 {
   $this->pageTitle = $this->Auth->user('username') . '\'s Podcasts';
   $this->layout = 'admin';

   $conditions   = array('Podcast.user_id'=>$this->Auth->user('id'));
   $fields       = array('Podcast.id', 'Podcast.title', 'Podcast.description', 'Podcast.created', 'Podcast.length', 'Podcast.status', 'Podcast.filename');
   $order        = 'Podcast.id DESC';
   $limit        = 30;
        
   $this->paginate = array('conditions'   => $conditions,
                           'fields'       => $fields,
                           'order'        => $order,
                           'limit'        => $limit);        
   $data = $this->paginate('Podcast');
   $this->set(compact('data')); 
 }

 public function admin_listall()
 {
   $this->pageTitle = $this->Auth->user('username') . '\'s Podcasts';
        
   $this->layout = 'admin';

   $conditions   = array('Podcast.user_id'=>$this->Auth->user('id'));
   $fields       = array('Podcast.id', 'Podcast.title', 'Podcast.description', 'Podcast.created', 'Podcast.length', 'Podcast.status', 'Podcast.filename');
   $order        = 'Podcast.id DESC';
        
   $this->paginate['conditions']   = $conditions;
   $this->paginate['fields']       = $fields;
   $this->paginate['order']        = $order;     
   $data = $this->paginate('Podcast');

   $this->set(compact('data'));
  }


 public function admin_delete($podcast_id)
 {
   if ( $this->Podcast->delete( $podcast_id ) ):
       $this->msgFlash(__('Data removed', True), '/admin/podcasts/listing');
   endif;
 }


 public function admin_edit($podcast_id=null)
 {
  $this->pageTitle = $this->Auth->user('username') . '\'s Podcasts';
      
  $this->layout = 'admin';

  #$this->set('subjects', Set::combine($this->Podcast->Subject->find('all',array('order'=>'title')),'{n}.Subject.id','{n}.Subject.title'));
 
  if (empty($this->request->data['Podcast'])):
      $this->request->data = $this->Podcast->read(null, $podcast_id);
  else:
      $this->request->data['Podcast']['title'] = Sanitize::paranoid($this->request->data['Podcast']['title'], $this->para_allowed);
      if ($this->Podcast->save($this->request->data)):
          $this->msgFlash('Podcast updated','/admin/podcasts/listing'); 
      endif;
   endif;
 }

 public function admin_add() 
 {
  $this->layout    = 'admin';
  if (!is_uploaded_file($this->request->data['Podcast']['file']['tmp_name'])):    
      $this->flash('Something were wrong','/admin/podcasts/edit/');
      return False;
  endif;
  # echo "tmp_name : ". $this->request->data['Podcast']['file']['tmp_name'] . "<br />";//  
  $this->request->data['Podcast'] =  Sanitize::clean($this->request->data['Podcast']); 

  /* SUBMITTED INFORMATION - use what you need
   *  temporary filename (pointer): $podfile
   *  original filename           : $podfile_name
   *  size of uploaded file       : $podfile_size
   *  mime-type of uploaded file  : $podfile_type
   */
   /** uploaddir:  directory relative to where script is runing */

   $uploaddir    = '..'.DS.'webroot'.DS.'files'.DS.'podcasts'; 
   $maxfilesize  = 41943040; # 40 MB max size
   $podfile_name = $this->request->data['Podcast']['file']['name'];   
   $podfile_size = $this->request->data['Podcast']['file']['size'];
   $podfile      = $this->request->data['Podcast']['file']['tmp_name'];
	
   $type         = $this->request->data['Podcast']['file']['type'];
    
   /** Security: checks to see if file is an image, if not do not allow upload ==*/
   #die($type);
   $types = array('audio/mpeg', 'audio/x-mp3', 'audio/mp3');

   if ( !in_array($type, $types) ):  # valid file ??
        $ErrMsg   = "<h1>ERROR</h1> the file $podfile_name $podfile is not valid.<br>";
        $ErrMsg  .= "<p>Only .mp3 files<br><br>";
        $ErrMsg  .= "The current type file: " . $type . "</p>\n";
        /** delete uploaded file ==*/
        unlink($podfile);
        $this->flash($ErrMsg,'/admin/podcasts/edit/');
        return False;
   endif;
    
   if ($podfile_size > $maxfilesize):
	    $ErrMsg  = "<h1>ERROR</h1> The image is too big.<br>";
        $ErrMsg .= "<p>Bigger than 10.0 MB <br><br>";
        $ErrMsg .= "The current size: " . $podfile_size ."</p>\n";
        /** delete uploaded file */
        $this->flash($ErrMsg,'/admin/podcasts/edit/');
        unlink($podfile);
   endif;
    
   $field       = 'id';
   $conditions  = array('user_id' =>  $this->Auth->user('id'));
   $order       = 'Podcast.id DESC';
   $current_id  = $this->Podcast->field($field, $conditions, $order);
   
   $next_id     = ($current_id + 1);
   $extension = substr($podfile_name, -3);
    
   if ($extension != 'mp3'):
       die('This does not look like one MP3 file');
   endif;
    
   $Name  = $this->Auth->user('username') . "_" . $next_id . '.'. $extension;
	 
   /** setup final file location and name */
   /** change spaces to underscores in filename  */
   $final_filename = str_replace(" ", "_", $Name);
   $newfile = $uploaddir.'/'.$final_filename;
   #die(debug($newfile));
   if (is_uploaded_file($podfile)):
       /** move file to proper directory ==*/
       if (!move_uploaded_file($podfile, $newfile)):	      # if an error occurs the file could not be written, read or possibly does not exist
           $this->flash('Error Uploading File.', '/admin/podcasts/listing/', 3);
           return False;
       endif;
   endif;
   
   #die(debug($newfile));
   $mp3file = new CMP3File;
   #die(debug($mp3file));
   $infoFile = $mp3file->getid3($newfile);
  
   #die(debug($infoFile));
   /** The database stuff  **/
   
   $this->request->data['Podcast']['filename']    = $final_filename;
   $this->request->data['Podcast']['length']      = $infoFile['size'];
   $this->request->data['Podcast']['duration']    = $infoFile['duration'];
   $this->request->data['Podcast']['user_id']     = $this->Auth->user('id');
   
   if ($this->Podcast->save($this->request->data)):
        $this->msgflash('Your podcast has been saved.','/admin/podcasts/listing');
   endif;
 }


/**
 * Change status enabled/disabled actived 
 * @access public
 * @return void
 */
 public function admin_change($podcast_id, $status)
 {
   $new_status          = ($status == 0 ) ? 1 : 0;
    
   $this->Podcast->id   = (int) $podcast_id;
   
   if ($this->Podcast->saveField('status', $new_status)):
        $this->msgFlash(__('Status modified', true), '/admin/podcasts/listing');
   endif;
 }

 public function see()
 {
   $this->layout    = 'admin';
 }

}
# ? > EOF
