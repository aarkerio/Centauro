<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/comentnews.php

class Download extends AppModel
{
 public $name      = 'Download';
    
 public $belongsTo  = array(
                            'Catdownload' =>
                                           array('className'  => 'Catdownload',
                                                 'conditions' => '',
                                                 'order'      => '',
                                                 'foreignKey' => 'catdownload_id'
                                                 ),
                            'User' =>
                                    array('className'  => 'User',
                                          'fields'     => 'id, username',
                                          'foreignKey' => 'user_id'
                                          )
                       );
    
 public $validate = array(
                             'user_id' => array('rule'    => 'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'on'         =>'create', # not update
                                             'required'   => True ),     
                              'title' => array('rule'     => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                            'description' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True )
   );
}

# ? > EOF
