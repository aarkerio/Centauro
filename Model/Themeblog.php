<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/themeblog.php

class Themeblog extends AppModel
{
public $name    = 'Themeblog';

/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */
public $hasMany = 'Entry';

/**
 *  CakePHP validation rulz
 *  @access public
 *  @var array
 */
public $validate = array(
                    'title' =>    array('rule'      => array('minLength', 2),
                                       'message'    => 'Minimum 2 characters long',
                                       'required'   => True,
                                       'allowEmpty' => False),
                    'user_id' => array('rule'       => 'numeric',
                                      'allowEmpty'  => False,
                                      'required'    => True,
                                      'on'          => 'create' # but not on update 
                                       )
   );
}
# ? > EOF
