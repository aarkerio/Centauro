<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: models/poll.php

class Poll extends AppModel
{ 
  public $hasMany = array(
                  'Pollrow' =>
                         array('className'     => 'Pollrow',
                               'conditions'    => null,
                               'order'         => 'id',
                               'limit'         => null,
                               'foreignKey'    => 'poll_id',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                               ),
                   'PollsComment' =>
                         array('className'     => 'PollsComment',
                               'conditions'    => null,
                               'order'         => 'id',
                               'limit'         => null,
                               'foreignKey'    => 'poll_id',
                               )
                  );

 public $belongsTo  = array('User' => array(
                             'className'    => 'User',
                             'foreignKey'   => 'user_id',
                             'fields'       => 'id, username'
			     ));

}
# ? >
