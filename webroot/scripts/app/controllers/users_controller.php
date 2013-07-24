<?php
/**
*  Chipotle Software
*  Manuel Montoya 2002-2007 
*  GPL manuel<at>mononeurona.org
*/ 
//File: /app/controllers/users_controller.php

uses('sanitize');

class UsersController extends AppController {
    
    public $helpers          = array('Javascript', 'Ajax', 'Form', 'Time');
    
    public function blogger($username = null, $page=1) 
    {
        $this->layout    = 'blog';
        
        $this->pageTitle = $username . '\'s Blog';
        
        $this->Entry     = new Entry;
        
        $user_id = $this->User->field("id", array("username"=>$username));
        
        //exit($user_id);
        
        if ($username == null || $user_id == null)
        {
           $this->redirect("/");
        }
        
        $order    = "Entry.id DESC";
        
        $fields   = array("Entry.title", "Entry.body", "Entry.created", "Entry.user_id", "Entry.discution", "Entry.themeblog_id", "Entry.id", "User.username", "Themeblog.title", "Themeblog.id");
        
        //pagination
        $total_rows = $this->Entry->findCount(array("Entry.user_id"=>$user_id, "Entry.status"=>1)); 
        
        $lmt        = 10; // limit news
        
        $targetpage = "/blog/".$username."/";
        
        $pagination = $this->Mypagination->init($total_rows, $page, $lmt, $targetpage); //Pagination
        
        $this->set('pagination', $pagination);
        
        $offset     = (($page * $lmt) - 10);
        
        $limit      = $lmt . " OFFSET " . $offset;
        
        $conditions = array("Entry.user_id"=>$user_id, "Entry.status"=>1);
        
        $this->set('data', $this->Entry->findAll($conditions, $fields, $order, $limit)); 
        
        $this->set('Element', $this->Blog->bloggerStuff($user_id)); // Charge Blog components aka Sidebars
		  
		  $this->set('tagCloud', $this->Blog->tagCloud($username)); // tagCloud
        
        $this->set('style', $this->Blog->getStyle($user_id));     // CSS style
 }
 
 public function about($username) 
 {	    
       $this->layout    = 'blog';
       
 	    $this->pageTitle = 'About me, ' . $username;
 	    
       $user_id = $this->User->field("id", array("username"=>$username));
 	    
 	    $conditions      = array("User.id"=>$user_id);
       
       $this->set('Element', $this->Blog->bloggerStuff($user_id)); // Charge Blog components aka Sidebars
 	    
 	    $this->set('data', $this->User->findAll($conditions));
 	    
       $this->set('style', $this->Blog->getStyle($user_id));
		 
		 $this->set('tagCloud', $this->Blog->tagCloud($username)); // tagCloud
  }
  
  public function entry($username = null, $Entry_id = null) 
  {
        if ($Entry_id == null) // if no entry_id: go out from here sick bastard!! 
        {
           $this->redirect('/blog/'.$username);
           exit;
        }
        
        $this->layout    = 'blog';
        $this->pageTitle = $username . '\'s Blog';
        //exit($username);
        $this->Entry     = new Entry;
        
        $user_id = $this->User->field("id", array("username"=>$username));
        
        //exit($user_id);
        
        if ($username == null || $user_id == null)
        {
           $this->redirect("/");
        }
        
        $order    = "Entry.id DESC";
        
        $fields   = array("Entry.title", "Entry.body", "Entry.created", "Entry.user_id", "Entry.discution", "Entry.themeblog_id", "Entry.id", "User.username", "Themeblog.title", "Themeblog.id");
        
        if ( $Entry_id != null && is_numeric( $Entry_id ) ) // show only one new
        {
           $limit      = 1;
           
           $conditions = array("Entry.user_id"=>$user_id, "Entry.id"=>$Entry_id);
        }
        
        $this->set('data', $this->Entry->find($conditions, $fields)); 
        
        $this->set('Element', $this->Blog->bloggerStuff($user_id)); // Charge Blog components aka Sidebars
        
        $this->set('Entry_id', $Entry_id);
        
        $this->set('style', $this->Blog->getStyle($user_id));
		  
		  $this->set('tagCloud', $this->Blog->tagCloud($username)); // tagCloud
    }
    
   /*** Recover password ****/
   public function recover() 
   {    
        $this->layout    = 'portal';
        
        $this->pageTitle = 'Recover password :: Centauro';
        
        $this->set('Element', $this->Portal->statics()); // Charge Portal components aka Sidebars
        
   }
   /*** Recover password check****/
   public function check()
   {    
        $this->Sanitize = new Sanitize;
        
        $this->Sanitize->cleanArray($this->data["User"]);
        
        if ( ! empty( $this->data["User"] ) )
        {
           $user_id = $this->User->field('id', array("email" => $this->data["User"]["email"] ));
           
           if ($user_id == null)
           {
                   $this->set('error_message', "Error: email <b>" . $this->data["User"]["email"] . "</b> does not exist on database");
                   $this->render('check', 'ajax');
           }
           else
           {   
               $this->Recover = new Recover;                                                    //confirm model
               $this->data['Recover']['user_id']  = $user_id;   //the user id
               $this->data['Recover']['random']   = $this->Adds->genPassword(14);
               
               if ( $this->Recover->save($this->data['Recover']) )
               {
                   if ( $this->sendRecover($this->data["User"]['email'], $this->data['Recover']['random']) ) 
                   {
                       $this->set('message', "Success. An email has been sent to: <b>".$this->data["User"]["email"]) . "</b>";
                       
                       $this->render('check', 'ajax');
                   }
               }
           }
        }
   }
   
   public function login() 
   {
       $this->layout    = 'portal';
       
       $this->pageTitle = 'Login :: Centauro';
       
       $this->set('Element', $this->Portal->statics());
       
       if (isset($this->data["User"]))
       { 
          $auth_num = $this->othAuth->login($this->data["User"]);
          
          $this->set('auth_msg', $this->othAuth->getMsg($auth_num));
       }
   }
   
   public function logout()
   {
       $this->othAuth->logout();
       
       $this->redirect('/');
       exit();
   }
   
   public function noaccess() 
   {
        $this->flash("You don't have permissions to access this page.",'/users/login');
   }
   
   public function register() 
   {
      
      $this->layout    = 'portal';
      
      $this->set('Element', $this->Portal->statics()); // Charge Blog components
 }
   
 public function insert() 
 {
    $this->layout = 'ajax';
    // adds new classroom to database
    if (!empty($this->data))
    {
    //die(print_r($this->params));
    /** Get the code **/
    $this->Group = new Group;  //Instantiate the model
    
    $code        = $this->Group->field('code', array("id"=>2)); // get the secret code for teachers registration process
    
    $message     = array("oops"=>"Oooppps!");
    
    /** Check Passwd **/
    if (strlen($this->data["User"]['passwd']) < 6)
    {
       $message['pwd_worng'] = "The password has less than 6 characters ";
    }
    
    if (strpos($this->data["User"]['username'], ' '))  // nos spaces
    {
       $message['username_spaces'] = "Your username should not contain spaces";
    }
    
    /** username check **/
    if (strlen($this->data["User"]['username']) < 5)
    {
       $message['pwd_username'] = "The username has less than 5 characters ";
    }
    
    /** name check **/
    if (strlen($this->data["User"]['name']) < 5)
    {
       $message['pwd_username'] = "The name is too short";
    }
    
    if (strpos($this->data["User"]['passwd'], ' '))  // nos spaces
    {
       $message['username_spaces'] = "Your password should not contain spaces";
    }
    
    /** description check **/
    if (strlen($this->data["User"]['cv']) < 5)
    {
       $message['description_too_short'] = "C'mon pal, talk us about you!";
    }
    
    /** email check **/
    if ($this->Adds->validEmail($this->data["User"]['email']) === false)
    {
       $message['pwd_username'] = "The email is invalid";
    }
    
    /** Check the user **/
    $username        = $this->User->field('username', array("username" => $this->data["User"]['username']));
    
    if ($username != null)
    {
       $message['username_exist'] = "The username already exist ";
    }
    
    /** Check the email **/
     $email        = $this->User->field('email', array("email" => $this->data["User"]['email']));
    
    if ($email != null)
    {
       $message['email_exist'] = "The email already exist ";
    }
    
    if ( $this->data["User"]['group_id'] == 3 && $this->data["User"]['code'] != $code)
    {
        $message['wrong_code'] = "The access code is incorrect";
    }
    
    if ( count($message) > 1 )
    {  
       $this->set('message', $message);
       die($this->render('validate', 'ajax')); //if error exist, stop here
    }
    
    $this->Sanitize = new Sanitize;
    
    //print_r($this->data["User"]);
    
    $this->Sanitize->paranoid($this->data["User"]['cv']);
    $this->Sanitize->paranoid($this->data["User"]['username']);
    $this->Sanitize->paranoid($this->data["User"]['name']);
    
    $this->data["User"]['passwd'] = md5($this->data["User"]['passwd']); // MD5
    $this->data["User"]['active'] = 0;
    
    $this->User->create($this->data["User"]);
    
    if ($this->User->save($this->data["User"]))
    {
         $this->Confirm = new Confirm;                                          //confirm model
         $this->data['Confirm']['user_id']  = $this->User->getLastInsertID();   //the user id
         $this->data['Confirm']['secret']   = $this->Adds->genPassword(14);
         
         if ($this->Confirm->save($this->data["Confirm"]))  // put the user in confirm model, this is, waiting confirmation
         {
          //Send the confirmation email
            if ( $this->sendMail($this->data["User"]['email'], $this->data['Confirm']['secret']) ) 
            {       
              $this->set('message', array("Suceess"=>"<h2>You have been registered!</h2> <p>A confirmation email have 
                  been sent to: ".$this->data["User"]['email']." </p>"));
               $this->set('ok', true);
               $this->render('validate', 'ajax');
            }
            else
            {
               $this->flash('Error!, call to the companie\'s computers guy ', '/users/register');
            }
          }     
       }
       
       else 
       {
            $this->set('message', array("Error"=>"Error, something is wrong"));
            $this->render('validate', 'ajax');
      } 
    }
  }
  
private function sendMail($email, $secret) 
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
        
        //die($url);
        
        if ( $this->Email->send($url) ) 
        {
            return true; 
        }
        else 
        {
            return false;
        }
}

private function sendRecover($email, $random) 
{
        
        $this->Email->to        = $email;
        $this->Email->subject   = 'Confirm Centauro new password';
        //$this->Email->replyTo   = 'noreply@mononeurona.org';
        $this->Email->sendAs    = 'html';
        $this->Email->template  = null;
        $this->Email->from      = 'noreply@mononeurona.org';
        //$this->set('foo', 'Cake tastes good today'); 
        //Set the body of the mail as we send it.
        //Note: the text can be an array, each element will appear as a
        //seperate line in the message body.
        
        $url  = '<h2>Centauro</h2><p>Open this in new tab to confirm new password: ';
        $url .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/recovers/newpwd/'.$random.'">';
        $url .= 'http://'.$_SERVER['SERVER_NAME'].'/recovers/newpwd/'.$random.'</a></p>';
        
        //die($url);
        
        if ( $this->Email->send($url) ) 
        {
            return true; 
        } 
        else 
        {
            return false;
        }
}
  
  /***==== ADMIN SECTION  ====**/
  public function admin_edit() 
  {
    $this->layout    = 'admin';
    
    $this->set('Groups', $this->User->Group->generateList());
    
    $this->License = new License;
    
    $this->set('Licenses', $this->License->generateList(null, "type", null, "{n}.License.id", "{n}.License.type")); 
    
    $this->Lang = new Lang;
    
    $this->set('Langs', $this->Lang->generateList(null, "lang", null, "{n}.Lang.id", "{n}.Lang.lang")); 
    
    if (empty($this->data["User"]))
    {
        $this->User->id  = $this->othAuth->user('id');
        $this->data      = $this->User->read();
    }
    else
    {   
        //exit(print_r($this->data["User"]));
        if (strlen($this->data["User"]["passwd"]) > 5)
        {
             $this->data["User"]["passwd"] = md5($this->data["User"]["passwd"]); // MD5 
        } else {
             unset($this->data["User"]["passwd"]);      
        }
        $this->Sanitize = new Sanitize;
        
        $this->Sanitize->cleanArray($this->data["User"]);
        
        //$this->data["User"]["cv"] = nl2br($this->data["User"]["cv"]);
        
        if ($this->User->save($this->data["User"]))
        {   
            $this->msgFlash('Profile has been saved','/admin/users/edit/');
        }
    }
  }

  public function admin_listing($order = null) 
  {
       
       $this->layout    = 'admin';
       
       $conditions = null; //array("Entry.user_id"=>$this->othAuth->user('id'));
       
       if ($order == null)
       {
           $order = "User.id DESC";
       }
       
       $limit = 40;
       
       $this->set('data', $this->User->findAll( $conditions, null, $order, $limit));
       
   }
   
 public function admin_delete($id)
 {
    $this->User->del($id);
    $this->msgFlash('User deleted', '/admin/users/listing');
    exit();
 }
 
 public function admin_backup()
 {
  $this->layout = 'admin';
  
  
 }
 // change user status actived/no actived
 public function admin_change($id, $status)
 {   
     $this->data['User']['active'] = ($status == 0 ) ? 1 : 0;
     
     $this->data['User']['id']     = $id;
     
     if ($this->User->save($this->data))
     {
           $this->msgFlash('User status changed', '/admin/users/listing/');
     } 
     else 
     {
            $this->flash('Problem!!', '/admi/users/listing/');
     }
 }

 /****   AVATAR   ***/
 public function admin_avatar() 
 {
    //die(print_r($this->params));
    $this->layout    = 'admin';
    
    if (!empty($this->data) && is_uploaded_file($this->data["User"]['file']['tmp_name']))
    {
    
    // echo "tmp_name : ". $this->data["User"]['file']['tmp_name'] . "<br />"; // usefull print
    
    $this->Sanitize = new Sanitize;
    
    $this->Sanitize->cleanArray($this->data); //Hopefully this is enough
    
    /** SUBMITTED INFORMATION - use what you need
    *  temporary filename (pointer): $imgfile
    *  original filename           : $imgfile_name
    *  size of uploaded file       : $imgfile_size
    *  mime-type of uploaded file  : $imgfile_type
    */
    
    /** uploaddir:  directory relative to where script is running */
    $uploaddir    = "../webroot/img/avatars";
    
    $maxfilesize  = 2097152; /** 2MB max size */
    
    $imgfile_name = $this->data["User"]['file']['name'];
    
    $imgfile_size = $this->data["User"]['file']['size'];
    
    $imgfile      = $this->data["User"]['file']['tmp_name'];
	  
    $type         = $this->data["User"]['file']['type'];
    
    /** Security: checks to see if file is an image, if not do not allow upload ==*/
    
    if ( $type != "image/jpeg" && $type != "image/pjpeg" && $type != "image/png" && $type != "image/gif") 
    {   /** is this a valid file? */
        $ErrMsg   = "<h1>ERROR</h1> the file $imgfile_name $imgfile is not valid.<br>";
        $ErrMsg  .= "<p>Only .jpg, .gif or .png files<br><br>";
        $ErrMsg  .= "Current type file: " . $type . "</p>\n";
		    
        /** delete uploaded file  */
        unlink($imgfile);
        die($this->flash($ErrMsg, '/users/edit/'. $this->othAuth->user('id')) );
    }
    
    if ( $imgfile_size > $maxfilesize) 
    {
	     $ErrMsg  = "<h1>ERROR</h1> The image is too big.<br>";
         $ErrMsg .= "<p>Bigger than 2.0 MB <br><br>";
         $ErrMsg .= "Current size: " . $imgfile_size ."</p>\n";
		     
         /** delete uploaded file */
         unlink($imgfile);
         die( $this->flash($ErrMsg,'/users/edit/'.$this->othAuth->user('id')) );
    }
    
    $extension   = $this->get_extension($type);
    
	 $Name        = $this->othAuth->user('username') . "_avatar" . $extension;
	 
    /** setup final file location and name */
    /** change spaces to underscores in filename  */
    $final_filename = str_replace(" ", "_", $Name);
    //die($final_filename);
    $newfile = $uploaddir . "/" . $final_filename;
    
    /** do extra security check to prevent malicious abuse */
    if (is_uploaded_file($imgfile))
    {
       /** move file to proper directory ==*/
       if (!copy($imgfile, $newfile))
       {
          /** if an error occurs the file could not be written, read or possibly does not exist */
          die($this->flash('Error Uploading File.', '/users/edit/'.$this->othAuth->user('id')));
       }
   }
   
   /** Database stuff  **/
   
   $this->data["User"]['avatar'] = $final_filename;
   
   if ($this->User->save($this->data))
	 {
           $this->redirect('/admin/users/edit/');
	 }
	 
	 /** delete the temporary uploaded file **/
   unlink($imgfile);
   
   }
}
}
?>
