<?php
/**
 *  Centauro Intranet Portal
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:APP/Controller/SharesController.php

App::uses('Sanitize', 'Utility');

class SharesController extends AppController {
 
 public $paginate = Null;

/**
 * Load CakePHP helpers
 * @access public
 * @var array
 */
 public $helpers = array('User', 'Gags');

/**
 * Extension files allowed to upload
 * @access private
 * @var array
 */
 private $_allowed  = array('mht', 'pdf', 'doc', 'xls', 'xcf', 'pptx', 'pps', 'docx', 'xlsx', 'ppt', 'sxw', 'sxi', 'sxc','sxd', 'stw', 'odt', 'odc', 'swf', 'ods', 'odp', 
                            'abw', 'html', 'zip', 'rar', 'gz', 'png', 'jpg', 'gif', 'svg', 'mp3', 'ogg', 'flac', 'txt', 'mpg', 'mpeg', 'flv', 'avi', 'mob', 'ppsx');
 
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'index'));
 }
 
 public function index($username=null, $entry_id=null)
 {   
  $this->pageTitle = $username . '\'s Share';   
  $conditions      = array('status'=>1); 
      
  if ($username != null):
      $user_id    = $this->User->field('id', array('username'=>$username));  
      $conditions['user_id'] = $user_id;      
      $this->set('username', $username);
  endif;
      
  if ($entry_id != null):
      $conditions['id'] = $entry_id;  
  endif;
      
  $params = array(
                  'conditions' => $conditions,
                  'fields'     => array('id', 'title', 'description', 'created', 'lenght', 'user_id', 'filename'),
                  'order'      => 'id DESC',
                  'limit'      => 12
                  );
      
  $this->set('data', $this->Share->find('all', $params)); 
 }
 
/**
 * @param mixed Null or string $username
 * @param mixed Null or integer $entry_id
 * @access public
 * @return void
 */
 public function show($user_id, $share_id)
 {   
   $this->layout    = $this->Edublog->layout($user_id);
   $this->set('blog', $this->Edublog->blog($user_id));
   $params = array('conditions' => array('Share.id'=>$share_id, 'Share.status'=>1),
                   'fields'     => array('id', 'title', 'description', 'created', 'filename', 'length', 'size', 'duration'));
   $this->set('data', $this->Share->find('first',$params));
  }
  
/**
 * @param mixed Null or string $username
 * @param mixed Null or integer $entry_id
 * @access public
 * @return void
 */
 public function all($username=Null, $entry_id=Null) 
 {
   $conditions      = array('status'=>1);
        
   if ( $username != null ):
       $user_id    = $this->User->field('id', array("username"=>$username));    
       $conditions['user_id'] = $user_id;
   endif;
                
   if ($entry_id != null):
       $conditions['id'] = $entry_id;  
   endif;
        
   $params = array('conditions'=>$conditions,
                   'fields'     => array('id', 'title', 'description', 'created', 'length', 'duration'),
                   'order'      => 'id DESC',
                   'limit'      => 12);
   $this->set('data', $this->Share->find('all', $params)); 
  }
  
/***==== ADMIN METHODS ====***/
/**
 * Display shares 
 * @return mixed array or null
 * @access public
 */
 public function admin_listing()
 {     
  $this->layout = 'admin'; 
  $this->paginate = array('limit'      => 20,
                          'fields'     => array('Share.id', 'Share.file', 'Share.description', 'Share.public', 'Share.created'),
                          'conditions' => array('Share.user_id'=>$this->Auth->user('id')),
                          'order'      => 'Share.id DESC');
  $data = $this->paginate('Share');
  $this->set(compact('data'));
  }
 
/**
 * Remove share data and file
 * @return void
 * @access public
 */ 
  public function admin_delete($id) 
  {
    $this->Share->delete($id);
    $this->redirect('/admin/shares/listing');
  }
    
/**
 * Add file and database
 * @return void
 * @access public
 */
 public function admin_add() 
 {
  $this->layout    = 'admin';
  if (!empty($this->request->data['Share']) && is_uploaded_file($this->request->data['Share']['file']['tmp_name'])):    
      /* SUBMITTED INFORMATION - use what you need
       *  temporary filename (pointer): $file
       *  original filename           : $file_name
       *  size of uploaded file       : $file_size
       *  mime-type of uploaded file  : $file_type
       */ 
      $uploaddir    = (string) '../webroot/files/userfiles';    #  Uploaddir:  directory relative to where script is runing 
      $maxfilesize  = (int) 89999790;    # 80 MB max size
      $file_name    = (string) $this->request->data['Share']['file']['name'];
      $file_size    = (string) $this->request->data['Share']['file']['size'];
      $file         = (string) $this->request->data['Share']['file']['tmp_name'];
      $type         = (string) $this->request->data['Share']['file']['type'];
    
      /** Security: checks to see if file is an image, if not do not allow upload ==*/
      if ( $type == "application/x-php"):    # file is valid ??
          $msg = "<h1>ERROR</h1> The file ". $_FILES['file']['name'] . " is not valid.<br /><p>You can add .php files, try using .txt<br /><br />";
          #  Delete uploaded file 
          unlink($file);
          $this->flash($msg,'/admin/shares/listing');
          exit();
      endif;
   
      if ( $file_size > $maxfilesize):    #check size
          $msg  = "<h1>ERROR</h1> The image is too big.<br \><p>Bigger than 80.0 MB <br \><br \>The current size: " . $file_size ."</p>\n";
          /** delete uploaded file */
          unlink($file);
          $this->flash($msg,'/admin/shares/listing');
          exit();
      endif;
    
      $current_id  = $this->Share->field('id', array('id >'=>0), 'id DESC');
      $next_id     = ($current_id + 1);    
      $extension   = $this->getExtension($file_name);
    
      if ( !in_array($extension, $this->_allowed) ):
          die('This does not look like one allowed file '. $extension);
      endif;
    
      $Name  = $this->Auth->user('username') . '_' . $next_id . '.'. $extension;
    
      /** setup final file location and name */
      $final_filename = str_replace(' ', '_', $Name);    # Change spaces to underscores in filename  
    
      $newfile = $uploaddir . '/' . $final_filename;
      # die( $newfile );  
      /** do extra security check to prevent malicious abuse */
      if (is_uploaded_file($file)):
          /** move file to proper directory ==*/
          if (!move_uploaded_file($file, $newfile)):
              /** if an error occurs the file could not be written, read or possibly does not exist ==*/
              $this->flash('Error Uploading File.', '/admin/shares/listing/');
          endif;
      endif;
    
      # Now the database stuff  
      $this->request->data['Share']['file']      = (string) $final_filename;
      $this->request->data['Share']['user_id']   = (int) $this->Auth->user('id');
      #die(debug($this->request->data));
      if ($this->Share->save($this->request->data)):
          $this->msgFlash('Your share has been saved', '/admin/shares/listing');
      endif;
  endif;
 }

/**
 * Change status
 * @return void
 * @access public
 */
 public function admin_change($id, $public)
 {   
  $new_public = ($public == 0 ) ? 1 : 0;      
  $this->Share->id = $id;
  
  if ($this->Share->saveField('public',$new_public)):
      $this->msgFlash('The Share has been modified', '/admin/shares/listing/');
  endif;       
 }

/**
 * Get file extension
 * @param string $filename
 * @return string
 * @access public 
 */
 private function getExtension($filename) 
 {
   $parts = explode('.',$filename);
   $last = count($parts) - 1;
   $ext = $parts[$last];
   return $ext;
 }
}

# ? > EOF
