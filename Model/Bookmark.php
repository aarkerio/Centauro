<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */

# file: APP/Model/Bookmark.php

class Bookmark extends AppModel {
   
   public $name     = 'Bookmark';
   
   public $belongsTo = 'User';

/**
 *  validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
  public $validate = array(
                           'name' => array(
                                           'rule'       => array('minLength', 4),
                                           'message'    => 'Name must be at least four characters long',
                                           'allowEmpty' => False,
                                           'required'   => True 
                                           ),
                            'url' => array(
                                           'rule'       => 'url',
                                           'message'    => 'Please enter a valid URL',
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

