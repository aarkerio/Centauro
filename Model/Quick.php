<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Model/Quick.php

class Quick extends AppModel
{
 public $name      = 'Quick';

 public $actsAs    = array('Containable');   

 public $hasMany  = array(
                          'QuicksComment' => array(
                          'className'     => 'QuicksComment',
                          'foreignKey'    => 'quick_id'
                         ),
                          'QuicksVote' => array(
                          'className'     => 'QuicksVote',
                          'foreignKey'    => 'quick_id',
                          'fields'        => 'vote, user_id'
                         )
                       );
    
 public $belongsTo  = array(
             'User' => array(
                             'className'    => 'User',
                             'foreignKey'   => 'user_id',
                             'fields'       => 'id, username'
			     ),
             'Theme' => array(
                             'className'    => 'Theme',    
                             'foreignKey'   => 'theme_id'
                              )

                   );
 public $validate = array(
  'title' => array(
                   'rule'       => array('minLength', 4),
                   'message'    => 'Title must be at least four characters long',
		           'allowEmpty' => False,
                   'required'   => True 
		    ),
      
  'reference' => array(
		       array(
                   'rule'       => 'url',
                   'message'    => 'Does not look like a valid URL',
		           'allowEmpty' => False,
		           'required'   => True
			     ) ,
               array(
		           'rule'       => 'isUnique',
                   'message'    => 'This URL has already been taken.'
		       )
		    ),
  'user_id' => array(
		           'rule'       => 'numeric',
                   'allowEmpty' => False,
                   'on'         => 'create', # but not on update
                   'required'   => true 
		     ),
  'theme_id' => array(
                   'rule'       => 'numeric',
                   'allowEmpty' => False,
                   'on'         => 'create', # but not on update
                   'required'   => True 
		     )
   );

 public function validateUrl($data) 
 {
   return (filter_var($data['reference'], FILTER_VALIDATE_URL)) ? True : False;
 }
}
# ? > EOF
