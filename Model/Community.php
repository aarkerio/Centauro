<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Community.php

class Community extends AppModel
{
    public $name      = 'Community';
    
    public $belongsTo  = array(
             'User' => array(
                             'className'    => 'User',
                             'foreignKey'   => 'user_id'
                               )
             );
    
       public $validate = array(
                                'id' => array('rule' => array('minLength', 4),
                                              'message'    => 'Must be at least four characters long',
                                              'allowEmpty' => False,
                                              'required'   => True
                                              ),
                                'name' => array('rule' => array('minLength', 4),
                                                'message'    => 'Must be at least four characters long',
                                                'allowEmpty' => False,
                                                'required'   => True
                                               )
   );
   
}

# ? > EOF
