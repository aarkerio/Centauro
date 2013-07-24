<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc. (http://www.chipotle-software.com)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: /APP/Controller/UsersController.php

App::uses('Sanitize', 'Utility');

class UsersController extends AppController {


 public $helpers          = array('User');
    
 public $components       = array('Email', 'Blog', 'Adds');

/**
 *  Display current users
 *  @access public
 *  @return void
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $perms = array('bloggers', 'blogger', 'about', 'entry', 'register', 'insert', 'newMembers', 'topNews', 'topBloggers', 'topNews', 'listing');
   $this->Auth->allow($perms);
   
   if ( isset($this->request->data['User']['pwd'] ) ): 
       if ( strlen($this->request->data['User']['pwd']) < 5 &&  strlen($this->request->data['User']['pwd']) != 0 ):    // passwd too short, so unset
             unset($this->request->data['User']['pwd']);
             $this->Session->setFlash(__('Password too short', true));
       elseif(  strlen($this->request->data['User']['pwd']) == 0 ):
              unset($this->request->data['User']['pwd']);
       endif;
   endif;
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function topBloggers()
 {
   # no SQL!!
   $query='SELECT username, count(user_id) FROM entries, users 
                  WHERE users.id = entries.user_id
                  GROUP BY username
                  ORDER BY count(user_id) DESC 
                  LIMIT 10;';
   
   return $this->User->query($query);
   
 } 

/**
 *  
 *  @access public
 *  @return void
 */
 public function topNews()
 {
  /* $query= 'SELECT username, count(user_id) FROM news, users
                 WHERE users.id = news.user_id
                 GROUP BY username
                 ORDER BY count(user_id) DESC
                 LIMIT 10'; */
  $q ='SELECT "User"."username", count("News"."user_id") FROM news as "News", users as "User" WHERE "User"."id" = "News"."user_id" 
         GROUP BY "User"."username" ORDER BY count("News"."user_id") DESC  LIMIT 10';

   #return $this->User->query($q);

   $params = array('conditions' => array('News.status'=>1),
                   'fields'     => array('News.id', 'News.user_id', 'News.news_count', 'User.username'),
                   'limit'      => 10,
                   'contain'    => 'User',
                   'order'      => 'news_count DESC',
                   'group'      => 'News.user_id, News.id, User.id'
                   );

   $data = $this->User->query($q);

   #die(debug($data));

   return $data;
 }

/**
 *  
 *  @access public
 *  @return void
 */
 public function newMembers()
 {   
  $params  = array(
         'order'   => 'User.id DESC',
         'fields'  => array('User.username', 'User.avatar', 'User.id'),
         'limit'   => 10);
  if (isset($this->params['requested'])):
      return $this->User->find('all', $params);
  endif;
  $this->set('data', $this->User->find('all', $params));
 }
  
/**
 *  
 *  @access public
 *  @return void
 */
 public function about($username) 
 {	    
  $this->layout    = 'blog';
  $this->Blog->setUserID($username);
  $params =  array('conditions' => array('User.username'=>trim($username)),
                   'contain'    => False);
  $data = $this->User->find('first',$params);
  $this->set('data', $data);
 }  
   
/**
 *  
 *  @access public
 *  @return void
 */ 
 public function login()
 {
   if ($this->request->is('post')):
       if ( $this->Auth->login() ):
           if (!empty($this->request->data)):
               if (empty($this->request->data['User']['remember_me'])):
                   $this->Cookie->delete('User');
               else:
                   $cookie = array();       
                   $cookie['email'] = $this->request->data['User']['email'];
                   $cookie['token'] = $this->request->data['User']['pwd'];
                   $this->Cookie->write('Auth.User', $cookie, True, '+2 weeks');
              endif;
              unset($this->request->data['User']['remember_me']);
              # We use next line to allow only one session per user
           endif;
       endif;
       $this->redirect($this->Auth->redirect());
   else:
       $this->layout    = 'portal';
   endif; 
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function logout() 
 {
   $this->Cookie->delete('User');
   $this->Session->destroy();
   $this->Session->setFlash('Logout');
   $this->redirect($this->Auth->logout());
 }
   
/**
 *  
 *  @access public
 *  @return void
 */
 public function register() 
 {
  if ( $this->Auth->user('id')):
      $this->msgFlash('You are already logged in', '/');
  endif;
  $this->layout    = 'portal';
  
 }
   
/**
 *  
 *  @access public
 *  @return void
 */
 public function insert() 
 {
  $this->layout = 'ajax';
       
  //print_r($this->request->data['User']);
  $this->request->data['User']['username'] = Sanitize::paranoid($this->request->data['User']['username'], $this->para_allowed);
  $this->request->data['User']['name']     = Sanitize::paranoid($this->request->data['User']['name'], $this->para_allowed);
  # $this->request->data['User']['passwd'] = md5($this->request->data['User']['passwd']); /
  $this->request->data['User']['active']   = (int) 0;
  $this->request->data['User']['quote']    = 'Esta es mi frase';
  $this->request->data['User']['name_blog']= 'El rincon de '.$this->request->data['User']['username'];
  $this->request->data['User']['group_id'] = (int) 0;  
  if ($this->User->save($this->request->data)):
         $this->request->data['Confirm']['user_id']  = $this->User->getLastInsertID();   //the user id
         $this->request->data['Confirm']['secret']   = $this->Adds->genPassword(14);
         
         if ($this->User->Confirm->save($this->request->data)):  // put the user in confirm model, this is, waiting confirmation
              //Send the confirmation email
	          if ( $this->_sendMail($this->request->data['User']['email'], $this->request->data['Confirm']['secret']) ):
                   $this->set('message', array("Suceess"=>"<h2>You have been registered!</h2> <p>A confirmation email have 
                     been sent to: ".$this->request->data['User']['email']." </p>"));
                   $this->set('ok', true);
                   $this->render('validate', 'ajax');
              else:
                   $this->flash('Error!, call to the companie\'s computers guy ', '/users/register');
	          endif;
         endif; 
  else: 
         $this->set('message', $this->User->validationErrors);
         $this->render('validate', 'ajax'); //if error exist, stop here   
  endif;
 }
  
/**
 *  
 *  @access private
 *  @return void
 */
 private function _sendMail($email, $secret) 
 {       
  $this->Email->sender    = '::MonoNeurona.org::';
  $this->Email->to        = $email;
  $this->Email->subject   = 'Confirm Centauro activation account';
  $this->Email->sendAs    = 'html';
  $this->Email->template  = null;
  $this->Email->from      = 'noreply@ononeurona.org';
  //$this->set('foo', 'Cake tastes good today'); 
  //Set the body of the mail as we send it.
  //Note: the text can be an array, each element will appear as a
  //seperate line in the message body.
        
  $url  = '<h2>Centauro</h2><p>Open this in new tab to confirm: ';
  $url .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/confirms/signup/'.$secret.'">';
  $url .= 'http://'.$_SERVER['SERVER_NAME'].'/confirms/signup/'.$secret.'</a></p>';
  if ( $this->Email->send($url) ):
      return True; 
  else: 
      return False;
  endif;
}

  
 /***==== ADMIN SECTION  ====**/

/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_login() 
 {
    $this->redirect('/users/login'); 
 }
 
/**
 *  
 *  @access public
 *  @return void
 */
 public function admin_edit() 
 {
  $this->layout    = 'admin';   
  if (empty($this->request->data['User'])):
      $this->User->contain();
      $this->request->data = $this->User->read(Null, $this->Auth->user('id'));
  else:   
      #die(debug( $this->request->data['User']));
      unset($this->request->data['User']['username']); #do not save this
      #  unset($this->request->data['User']['email']); 
      if ($this->User->save($this->request->data)):
          $this->msgFlash('Profile has been saved','/admin/users/edit/');
      else:
          die(debug($this->User->validationErrors));
      endif;
  endif;   
 }

/**
 *  Display current users
 *  @access public
 *  @return void
 */
 public function admin_listing() 
 {
  $this->layout     = 'admin';
  $this->pageTitle  = __('Users', True);
  $this->paginate['conditions'] = array('User.id != 2');
  $this->paginate['fields']     = array('User.group_id','User.name','User.created','User.email','User.active','User.id','User.username','Group.name');
  $this->paginate['order']      = 'User.created DESC';
  $this->paginate['limit']      = 40;
  $this->paginate['contain']    = array('Group');
  $data = $this->paginate('User');
  #die(debug($data));
  $this->set(compact('data'));
 }
 public function listing() 
 {
  $this->layout     = 'portal';
  $this->pageTitle  = __('Users', True);
  $this->paginate['conditions'] = array('User.id != 2');
  $this->paginate['fields']     = array('User.group_id','User.name','User.created','User.email','User.active','User.id','User.username');
  $this->paginate['order']      = 'User.created DESC';
  $this->paginate['limit']      = 40;
  $this->paginate['contain']    = array('Group');
  $data = $this->paginate('User');
  #die(debug($data));
  $this->set(compact('data'));
 }

/**
 * Remove user
 * @access public
 * @return void
 */   
 public function admin_delete($user_id)
 {
   if ($this->User->delete($user_id) ):
       $msg = 'User deleted';
   else:
       $msg = 'User NOT deleted';
   endif;
   $this->msgFlash($msg, '/admin/users/listing');
 }
 
 public function admin_backup()
 {
  $this->layout = 'admin';
 }
 
/**
 * Change user status actived/no actived
 * @access public
 *
 */
 public function admin_change($user_id, $status)
 {   
  $new_status = ($status == 0 ) ? 1 : 0;
  $this->User->id = (int) $user_id;
  if ($this->User->saveField('active', $new_status)):
      $this->msgFlash('User status changed', '/admin/users/listing/');
  endif;
 }

/**
  *  AVATAR   
***/
 public function admin_avatar() 
 {
  #die(print_r($this->request->data));
  $this->layout    = 'admin';  
  if (!empty($this->request->data) && is_uploaded_file($this->request->data['User']['file']['tmp_name'])):
      $this->flash('Error uploading image, please contact the support team', '/admin/users/edit');
  endif;
    
    /** SUBMITTED INFORMATION - use what you need
    *  temporary filename (pointer): $imgfile
    *  original filename           : $imgfile_name
    *  size of uploaded file       : $imgfile_size
    *  mime-type of uploaded file  : $imgfile_type
    */
    
    /** uploaddir:  directory relative to where script is running */
    $uploaddir    = '../webroot/img/avatars';
    $maxfilesize  = 2097152; /** 2MB max size */
    $imgfile_name = $this->request->data['User']['file']['name'];
    $imgfile_size = $this->request->data['User']['file']['size'];
    $imgfile      = $this->request->data['User']['file']['tmp_name'];
    $type         = $this->request->data['User']['file']['type'];
    
    /** Security: checks to see if file is an image, if not do not allow upload ==*/
    
    if ( $type != "image/jpeg" && $type != "image/pjpeg" && $type != "image/png" && $type != "image/gif"):
         /** is this a valid file? */
        $msg   = "ERROR the file is not valid. Only .jpg, .gif or .png files Current type file: " . $type;
        /** delete uploaded file  */
        unlink($imgfile);
        die($this->flash($msg, '/users/edit/'. $this->Auth->user('id')) );
    endif;
    
    if ( $imgfile_size > $maxfilesize):
	    $msg  = "ERROR The image is too big. Bigger than 2.0 MB Current size: " . $imgfile_size;	     
        /** delete uploaded file */
        unlink($imgfile);
        die( $this->flash($msg,'/users/edit/'.$this->Auth->user('id')) );
    endif;
    
    $extension   = $this->Adds->get_extension($type);
    
	$name        = $this->Auth->user('username') . "_avatar" . $extension;
	 
    /** setup final file location and name */
    /** change spaces to underscores in filename  */
    $final_filename = str_replace(" ", "_", $name);
    //die($final_filename);
    $newfile = $uploaddir . "/" . $final_filename;
    
    /** do extra security check to prevent malicious abuse */
    if (is_uploaded_file($imgfile)):
        /** move file to proper directory ==*/
        if ( !move_uploaded_file($imgfile, $newfile) ):
            /** if an error occurs the file could not be written, read or possibly does not exist */
            die($this->flash('Error Uploading File.', '/users/edit/'.$this->Auth->user('id')));
        endif;
   endif;
   
   /** Now the database stuff  **/
   if ($this->User->saveField('avatar',  $final_filename)):
            $this->msgFlash('Data saved', '/admin/users/edit/');
   endif;
	 
   /** delete the temporary uploaded file **/
   unlink($imgfile);
  }
}
# ? > EOF
