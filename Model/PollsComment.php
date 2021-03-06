<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.7
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#File: /app/models/polls_comment.php

class PollsComment extends AppModel
{
    
 public $belongsTo  = array(
             'User' => array(
                             'className'    => 'User',
                             'foreignKey'   => 'user_id',
                             'fields'       => 'id, username, avatar'
			     )
                   );
 public $validate = array(
  'comment' => array(
                    'rule'       => array('minLength', 2),
                    'message'    => 'Comment must be at least f2 characters long',
		    'allowEmpty' => false,
                    'required'   => true 
		    ),
  'user_id' => array(
		     'rule'       => 'numeric',
                     'allowEmpty' => false,
                     'on' => 'create', # but not on update
                     'required'   => true 
		     ),
  'poll_id' => array(
		     'rule'       => 'numeric',
                     'allowEmpty' => false,
                     'on' => 'create', # but not on update
                     'required'   => true 
		     )
   );
}
# ? >
