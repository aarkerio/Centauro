<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: Models/Theme.php

class Theme extends AppModel {

 public $name = 'Theme';

/**
 *  CakePHP behaviour
 *  @access public
 *  @var array
 */
 public $actsAs = array('Containable');


/**
 *  Validate  CakePHP framework array element
 *  @access public
 *  @var array
 */
public $validate = array(
                 'theme'      => array('rule' => array('minLength', 4),
                                       'message' => 'Minimum 8 characters long',
                                       'allowEmpty' => False,
                                       'required'   => True),
                 'description' => array('rule' => array('minLength', 4),
                                        'message' => 'Minimum 8 characters long',
                                        'allowEmpty' => False,
                                        'required'   => True),
                 'img'         => array('rule'       => array('minLength', 4),
                                        'message'    => 'Minimum 8 characters long',
                                        'on'         =>'create', # but not at update
                                        'allowEmpty' => False,
                                        'required'   => True)
   );
}

# ? > EOF
