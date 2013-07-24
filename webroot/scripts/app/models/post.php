<?php
/***
*    Chipotle Software 2002-2007 
*    GPLv3
*/
class Post extends AppModel
{
    public $name      = 'Post';
 
    public $hasMany  = array(
             "Comment" => array(
                             "className"    => "Comment",
                             "foreignKey"   => "post_id",
                             "order"        => "id"
                               ));
    
    public $belongsTo  = array(
             "User" => array(
                             "className"    => "User",
                             "foreignKey"   => "user_id"
                               ), 
             "Theme" => array(
                             "className"    => "Theme",    
                             "foreignKey"   => "theme_id"
                              )
             );
    
       public $validate = array(
      'title' => VALID_NOT_EMPTY,//'/[a-z0-9\_\-]{3,}$/i',
      'body' => VALID_NOT_EMPTY
   );
   
}
?>
