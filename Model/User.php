<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#File: /APP/Model/User.php

class User extends AppModel {

  public $name   = 'User';

/**
 * CakePHP Containable behaviour 
 * @acces public
 * @var array
 */
 public $actsAs = array('Containable');

/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */   
  public $belongsTo  = array(
             'Group' => array(
                         'className' => 'Group',
                         'foreignkey'=>'group_id'
                         ));
    
/**
 *  CakePHP hasOne relation
 *  @access public
 *  @var array
 */   
  public $hasOne = array(
      'Style' => array(
        'className'  => 'Style',
        'dependent'  =>  True,
        'foreignKey' => 'user_id'
        ),
      'Confirm' => array(
        'className'  => 'Confirm',
        'dependent'  =>  True,
        'foreignKey' => 'user_id'
        )

    );

/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */ 
   public $hasMany = array(
    'Entry' => array(
      'className' => 'Entry'
    ),
    'Themeblog' => array(
      'className' => 'Themeblog'
    ),
    'Bookmark' => array(
      'className' => 'Bookmark'
    ),
    'Page' => array(
      'className' => 'Page'
    ),
    'Podcast' => array(
      'className' => 'Podcast'
    ),
    'News' => array(
      'className' => 'News'
    ),
  'Wayding' => array(
      'className' => 'Wayding'
    )
  );

/**
 *  Validate CakePHP framework array validations rulz
 *  @access public
 *  @var array
 */   
 public $validate = array(
   'username' => array(
                        array(
                            'rule'       => array('minLength', 5),
                            'message'    => 'Username must be at least 5 characters long',
	                        'allowEmpty' => False,
                            'on'         => 'create', # but not on update
		                    'required'   => True
			                 ),
                      array(
		                    'rule'    => 'isUnique',
                            'on'      => 'create', # but not on update
                            'message' => 'This username has already been taken.'
		                   )
		               ),
  'email'    => array(
		              array(
                            'rule'       => array('email'),
                            'message'    => 'Please supply a valid email address.',
	                        'allowEmpty' => False, # but not on update
		                    'required'   => True
			                 ),
                      array(
		                    'rule'    => 'isUnique',
                            'message' => 'This email has already been taken.',
                            'on'      => 'create' # but not on update
                            ),
                      array(
                            'rule'    => array('email', True),
                            'message' => 'Please supply a valid email address.',
                            'on'      => 'create' # but not on updat
                            )
                      ),
  'name'     => array(
		              array(
                            'rule'       => array('minLength', 8),
                            'message'    => 'Name must be at least 8 characters long',
	                        'allowEmpty' => False,
		                    'required'   => True
			                 ),
		               ),
  'group_id' => array(
		             'rule'       => 'numeric',
                     'allowEmpty' => False,
                     'on'         => 'create', # but not on update
                     'required'   => True 
		     )
   );
}

# ? > EOF
