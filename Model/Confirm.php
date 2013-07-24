<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.7
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: APP/Model/Confirm.php

class Confirm extends AppModel
{
  public $belongsTo = array(
                          'User' => array(
                                         'className'    => 'User',
                                         'foreignKey'    => 'user_id'
                                         )
                         );  
    
  public $validate = array(
    'secret'      => array(
                            'rule'       => array('minLength', 8),
                            'message'    => 'Secret must be at least 8 characters long',
	                        'allowEmpty' => False,
		                    'required'   => True  
		               ),
    'user_id' => array(
		             'rule'       => 'numeric',
                     'allowEmpty' => False,
                     'on'         => 'create', # but not on update
                     'required'   => True 
		            )
   );
}

# ? > EOF
