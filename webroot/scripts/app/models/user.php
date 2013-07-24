<?php
//AppModel gives you all of Cake's Model functionality

class User extends AppModel {
    
    // Its always good practice to include this variable.
    public $name       = 'User';
    
    public $belongsTo  = array(
             "Group" => array(
                        "className" => "Group",
                         "foreignkey"=>"group_id"
                         ));
    
   
    public $hasMany = array(
    "Post" => array(
      "className" => "Post"
    ),
    "File" => array(
      "className" => "File"
    )
  );
   
    public $validate = array(
      'username' => VALID_NOT_EMPTY,
      'passwd' => VALID_NOT_EMPTY,
      'name' => VALID_NOT_EMPTY,
      'email' => VALID_EMAIL,
      'cv' => VALID_NOT_EMPTY
   );

}
?>
