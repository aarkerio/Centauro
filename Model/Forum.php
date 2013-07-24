<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Forum.php  (DEPRECATED)

class Forum extends AppModel {

 public $actsAs = array('Containable');

 public $hasMany = array('Topic' => 
                                     array('className'  => 'Topic', 
                                           'foreignkey' => 'forum_id',
                                           'conditions' => 'Topic.topic_id = 1',
                                           'order'      => 'id',
                                           'fields'     => 'id, subject, created, user_id, views'
                                           ));

 public $belongsTo = array('Catforum' => 
                                     array('className' => 'Catforum', 
                                           'foreignkey' => 'catforum_id')
                                           );

 public $validate = array(
                   'title' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                   'user_id' => array('rule' => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'on'=>'create', 
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                   'catforum_id' => array('rule' => 'numeric',
                                          'message'    => 'Must be at least four characters long',
                                          'allowEmpty' => False,
                                          'required'   => True )
      );

}
# ? >
