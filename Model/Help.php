<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: Model/Help.php

class Help extends AppModel
{
    public $name        = 'Help';
    
    public $validate = array(
                             'url' => array('rule'        => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),
                             'help' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),
                            'lang' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True )
   );
}

# ? > EOF

