<?php
class Theme extends AppModel {

 	public $name = 'Theme';
 	
 	public $validate = array(
 	      'theme' => VALID_NOT_EMPTY
 	      );
 }
?>
