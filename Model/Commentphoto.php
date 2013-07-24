<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: APP/Model/Commentphoto.php

class Commentphoto extends AppModel
{

/**
 *  CakePHP belongsTo
 *  @access public   
 *  @var array
 */   
  public $belongsTo = array(
             'User' =>
		               array('className'  => 'User',
		                     'conditions' => Null,
		                     'order'      => Null,
                             'fields'     => 'id, username, avatar',
                             'foreignKey' => 'user_id'
		                     ),
			 'Photo' =>
			      array('className'  => 'Photo',
			            'conditions' => Null,
			            'order'      => Null,
                        'fields'     => 'id, name',
                        'foreignKey' => 'photo_id'
			           )
			 );

/**
 *  validate  CakePHP framework array element
 *  @access public
 *  @public array
 */
  public $validate = array(
           'coment' => array(
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
	                        'allowEmpty' => False,
                            'on'         => 'create', # but not on update
		                    'required'   => True
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
