<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: Model/Gallery.php

class Gallery extends AppModel
{

/**
 * CakePHP Containable behaviour 
 * @acces public
 * @var array
 */
 public $actsAs = array('Containable');

 public $belongsTo   = 'User';

 public $hasMany     = 'Photo';
  
/**
 * Validation model 
 * @var array
 */   
 public $validate = array(
                        'title' => array('rule'         => array('minLength', 4),
                                         'message'      => 'Must be at least four characters long',
                                         'allowEmpty'   => False,
                                         'required'     => True ),
                        'user_id' => array('rule'       => 'numeric',
                                           'message'    => 'Must be at least four characters long',
                                           'on'         =>'create',
                                           'allowEmpty' => False,
                                           'required'   => True 
                ));
}

# ? > EOF
