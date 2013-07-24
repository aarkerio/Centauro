<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#File: /APP/Model/Catforum.php

class Catforum extends AppModel
{
  public $name = 'Catforum';
 
/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */
  public $hasMany = array('Forum' =>
                         array('className'     => 'Forum',
                               'conditions'    => null,
                               'order'         => 'id',
                               'limit'         => null,
                               'foreignKey'    => 'catforum_id',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         ));

/**
 *  Validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
 public $validate = array(
                          'title'  =>  array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                          'message' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),
                          'user_id' => array('rule' =>'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'on'          => 'create', # but not on update
                                             'required'   => True ),
                          'forum_id' => array('rule'       => 'numeric',
                                              'on'         => 'create', # but not on update
                                              'message'    => 'Must be at least four characters long',
                                              'allowEmpty' => False,
                                              'required'   => True )  
      );

}

# ? > EOF

