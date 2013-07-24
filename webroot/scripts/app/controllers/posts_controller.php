<?php
/**
    *  Karamelo E-Learning Platform
    *  Manuel Montoya 2002-2007 
    *  GPL License manuel<at>mononeurona.org
    *  Chipotle Software
*/ 

loadModel('Entry');
uses('Sanitize');
//vendor('inputfilter');

class PostsController extends AppController {
  
  public $helpers          = array('Javascript', 'Ajax', 'Form', 'Html', 'Time', 'Session');
  
  public $components       = array('Security', 'Session');
  
  public function view() 
  {     
        $this->layout    = 'portal';
        
        $total_rows = $this->Post->findCount(array("status"=>1)); 
                
        $conditions = array("Post.status"=>1);
        $fields     = array("Post.id", "Post.title", "Post.body", "Post.created", "Post.theme_id", "Post.user_id");
        
        $order      = "Post.id DESC";
        
        $limit      = 20;
        
        $this->pageTitle = 'Mis posts';
        
        $results = $this->Post->findAll($conditions, $fields, $order, $limit);
        
        $this->set('data', $results);
    }
    
    public function display($id = null)
    {   
        // $this->layout    = 'portal';
        
        if ($id == null)
        {
            $this->redirect("/");
        }
        
        $conditions = array("Post.status"=>1, "Post.id"=>$id);
        
        $fields     = array("Post.id", "Post.title", "Post.votes", "Post.comments", "Post.body", "Post.created", "Post.reference", "Post.theme_id", "Post.user_id", "Theme.img", "Theme.theme", "User.username");
        
        $this->pageTitle = 'Hacktivismo';
        
        $this->set('data', $this->Post->find($conditions, $fields, null, 1));
        
        $this->set('Element', $this->Portal->statics()); // Charge Portal components aka Sidebars
    }
  
   /**
   * Create an rss feed of the 15 last uploaded uses the RSS component
   *
   */
   public function rss() 
   {
       $this->layout    = 'rss';
       
       $conditions = array("Post.status"=>1);
       
       $fields     = array("Post.id", "Post.title", "Post.body", "Post.created", "Post.theme_id", "Post.user_id");
       
       $order      = "Post.id DESC";
       
       $limit      = 15;
       
       $this->Post->unbindModel(array("hasMany"=>array("CommentPost")));
       
       $this->set('data', $this->Post->findAll($conditions, $fields, $order, $limit));
       
  }
  
  /*** 
     ======ADMIN METHODS === 
  *****/
   public function admin_listing($page=1) 
   {
        //pagination
        $total_rows = $this->Post->findCount(array("user_id"=>$this->othAuth->user('id'))); 
        
        $lmt        = 25; // limit Post
        
        $targetpage = "/admin/Post/listing/";
        
        $pagination = $this->Mypagination->init($total_rows, $page, $lmt, $targetpage); //Pagination
        
        $this->set('pagination', $pagination);
        
        $this->pageTitle = $this->othAuth->user('username') . '\'s Post';
        
        $this->layout = 'admin';
        
        $conditions   = array("Post.user_id" => $this->othAuth->user('id') );             // only the user's Post
        $fields       = array("id", "title", "body", "created", "status", "theme_id", "user_id");
        $order        = "Post.id DESC";
        
        $offset     = (($page * $lmt) - $lmt);
        
        $limit      = $lmt . " OFFSET " . $offset;
        
        $this->set('data', $this->Post->findAll($conditions, $fields, $order, $limit)); 
  }
  
  public function admin_add() 
  {
    $this->layout    = 'admin';
    
    if (!empty($this->data["Post"]))
    {
       $this->Sanitize = new Sanitize;
       
       $this->Sanitize->paranoid($this->data["Post"]["title"]);
       
       $this->Sanitize->paranoid($this->data["Post"]["reference"]);
       
       $this->Sanitize->html($this->data["Post"]["body"]);
       
       $this->data["Post"]["user_id"] = $this->othAuth->user('id');
		 
		 $this->Post->create();
       
	    if ($this->Post->save($this->data["Post"]))
       {
             if ( $this->data["Post"]["end"] == 1 )
             {
                          $this->redirect('/admin/Post/listing');
             } 
             else 
             {
                          $id = $this->Post->getLastInsertID();
                           $this->msgFlash('Your story has been added!','/admin/Post/edit/'.$id);
                           exit();
             }
        }
    }
    else
    {
      $this->set('themes', $this->Post->Theme->generateList(null, 'theme ASC', null, '{n}.Theme.id', '{n}.Theme.theme'));
    }
 }
 
 public function admin_edit($id=null)
 {
     $this->layout    = 'admin';
     
     if ( empty( $this->data["Post"] ) )
     {
         $this->Post->id  = $id;
         
			$this->Post->unbindModel(array("belongsTo"=>array("User")));
			
         $this->data      = $this->Post->read();
			
			//exit(var_dump($this->data));
         
         $this->set('themes', $this->Post->Theme->generateList(null, 'theme ASC', null, '{n}.Theme.id', '{n}.Theme.theme'));
     }
     else
     {   
         $this->Sanitize = new Sanitize;
         
         $this->Sanitize->paranoid($this->data["Post"]["title"]);
         
         $this->Sanitize->paranoid($this->data["Post"]["reference"]);
         
         $this->Sanitize->html($this->data["Post"]["body"]);
         
         /* $myFilter = new InputFilter($this->tags, $this->attr, 0, 0);
         
         $tmp = $myFilter->process($this->data["Post"]["body"]);
         
         $this->data["Post"]["body"] = utf8_encode($tmp); */
         
         if ($this->Post->save($this->data["Post"]))
         {   
             if ( $this->data["Post"]["end"] == 1 )
             {
                   $this->msgFlash('Your story has been saved!', '/admin/Post/listing');
             } 
             else
             {
                  $this->msgFlash('Your story has been saved!', '/admin/Post/edit/'.$this->data["Post"]["id"]);
             }
        }
     }
  }
  
  public function  admin_delete($id) {
      // deletes new from database
      
      if ( $this->Post->del($id) )
      {
            $this->redirect('/admin/Post/listing');
      } 
      else 
      {
            $this->flash('Database error!', '/admin/Post/listing');
      }
  }
  
  // change Post status published/draft
  public function admin_change($id, $status)
  {  
     $this->data['Post']['status'] = ($status == 0 ) ? 1 : 0;
     
     $this->data['Post']['id']     = $id;
     
     if ($this->Post->save($this->data['Post']))
     {
           $this->msgFlash('Post status changed', '/admin/Post/listing');
     }
  }
}
?>
