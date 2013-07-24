<?php
class File extends AppModel
 	{
 	    // Its always good practice to include this variable.
 	    public $name      = 'File';
 	    
 	    public $validate = array(
 	      'user_id' => VALID_NOT_EMPTY,
 	      'file' => VALID_NOT_EMPTY,
 	      'description' => VALID_NOT_EMPTY
  );
 	}
?>
