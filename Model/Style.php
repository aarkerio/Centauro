<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/style.php

class Style extends AppModel
{
  public $name = 'Style';

/**
 *  CakePHP validation rulz
 *  @access public
 *  @var array
 */
   public $validate = array(
                            'user_id' => array('rule'       => 'numeric',
                                               'message'    => 'Must be at least four characters long',
                                               'allowEmpty' => False,
                                               'on'         => 'create', # but not in update
                                               'required'   => True ),
                             'style'  => array('rule'       => array('minLength', 10),
                                               'message'    => 'Must be at least ten characters long',
                                               'allowEmpty' => False,
                                               'required'   => True )
                          );
}

# ? > EOF
