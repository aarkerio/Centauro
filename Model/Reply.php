<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: models/reply.php
class Reply extends AppModel
{

/**
 *  CakePHP Relation belongsTo
 *  @access public
 *  @var array
 */
public $belongsTo = array('Topic' => 
                                     array('className' => 'Topic', 
                                           'foreignkey' => 'topic_id'),
                          'User' => 
                                     array('className' => 'User', 
                                           'foreignkey' => 'user_id')
                                           );

/**
 *  Validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
public $validate = array(
                         'title'    => array('rule'       => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ), 
                         'body'     => array('rule'       => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                         'user_id'  => array('rule'       => 'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                              'on'        =>'create',
                                             'required'   => True ),
                         'topic_id' => array('rule'       => 'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'on'         =>'create',
                                             'allowEmpty' => False,
                                             'required'   => True ));

}
# ? >
