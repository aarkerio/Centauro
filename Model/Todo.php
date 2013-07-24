<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: Model/Todo.php

class Todo extends AppModel
{
 public $name        = 'Todo';
 
/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */   
  public $belongsTo = array('User' =>
                           array('className'  => 'User',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'user_id'
                           )
                    );   
}

# ? > EOF
