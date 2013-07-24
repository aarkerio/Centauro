<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/wayding.php

class Wayding extends AppModel {

 public $name = 'Wayding';

/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */
 public $belongsTo  = array(
             'User' => array(
                        'className' => 'User',
                        'foreignkey' => 'user_id'
                          ));

/**
 *  Validate CakePHP framework array validations rulz
 *  @access public
 *  @var array
 */   
    public $validate = array(
                            'user_id' => array(
                                           'rule'       => 'numeric',
                                           'allowEmpty' => False,
                                           'on'         => 'create', # but not on update
                                           'required'   => True 
                                             ),
                            'task' => array('rule' => array('minLength', 4),
                                           'message'    => 'Name must be at least four characters long',
                                           'allowEmpty' => False,
                                           'required'   => True 
                                           )
     );
}
# ? >
