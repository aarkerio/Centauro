<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: APP/Model/Commentblog.php

class Commentblog extends AppModel
{
  public $name = 'Commentblog';
  
  public $belongsTo = array(
             'User' =>
		               array('className'  => 'User',
		                     'conditions' => Null,
		                     'order'      => Null,
                             'fields'     => 'id, username, avatar',
                             'foreignKey' => 'user_id'
		                     ),
			 'Entry' =>
			      array('className'  => 'Entry',
			            'conditions' => Null,
			            'order'      => Null,
                        'fields'     => 'id, title',
                        'foreignKey' => 'entry_id'
			           )
			 );

  public $validate = array(
           'comment' => array(
                        array(
                            'rule'       => 'notEmpty',
                            'message'    => 'Comment field must not be empty',
	                        'allowEmpty' => False,
		                    'required'   => True
			                 )
		               ),

           'user_id' => array(
                        array(
                            'rule'       => 'notEmpty',
                            'message'    => 'username and user id is required.',
	                        'allowEmpty' => false,
                            'on'          => 'create', # but not on update
		                    'required'   => true
			                 )
		               ),


           'username' => array(
                        array(
                            'rule'       => 'notEmpty',
                            'message'    => 'Name must not be empty',
	                        'allowEmpty' => False,
		                    'required'   => True
			                 )
		               )
	 );
 
}
# ? > EOF
