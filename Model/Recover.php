<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/recover.php

class Recover extends AppModel
{
  public $name      = 'Recover';

  public $belongsTo  = array(
             'User' => array(
                         'className'  => 'User',
                         'foreignkey' => 'user_id'
                         ));

/**
 *  Validate   CakePHP framework array element
 *  @access public
 *  @var array
 */           
  public $validate = array(
                           'user_id' => array('rule'       => 'numeric',
                                              'message'    => 'Must be at least four characters long',
                                              'allowEmpty' => False,
                                              'on'         =>'create',
                                              'required'   => True ),
                           'random' => array('rule'        => array('minLength', 4),
                                             'message'     => 'Must be at least four characters long',
                                             'allowEmpty'  => False,
                                             'required'    => True ));
}
# ? >
