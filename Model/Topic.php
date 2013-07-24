<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/topic.php

class Topic extends AppModel
{
 public $name = 'Topic';

/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */   
public $belongsTo = array('Forum' => 
                                     array('className' => 'Forum', 
                                           'foreignkey' => 'forum_id'),
                          'User' => 
                                     array('className' => 'User', 
                                           'foreignkey' => 'user_id')
                                           ); 

/**
 *  Validate CakePHP framework array validations rulz
 *  @access public
 *  @var array
 */
 public $validate = array(
                          'subject' => array(
                                             'rule' => array('minLength', '8'),
                                             'message' => 'Minimum 8 characters long'
                                             ),
                          'message' => array(
                                             'rule' => array('minLength', '8'),
                                             'message' => 'Minimum 8 characters long'
                                             ),
                          'user_id' => array(
                                             'rule'       => 'numeric',
                                             'allowEmpty' => false,
                                             'required'   => true,
                                             'on'         => 'create' 
                                             ),
                          'forum_id' => array(
                                              'rule'       => 'numeric',
                                              'allowEmpty' => false,
                                              'required'   => true,
                                              'on'         => 'create' 
                                              )
                          );

 /* Indicates user is watching this topic by first time and is not a new topoc anymore*/  
 public function addVisitor($topic_id, $user_id)  
 { 
     $this->data['Visitor']['topic_id'] = $topic_id; 
     $this->data['Visitor']['user_id']  = $user_id;

     if ( $this->Visitor->save( $this->data) ):
         return true;
     else:
         die('Error on addVisitor function');
     endif;

     return true;
 }
}
# ? >
