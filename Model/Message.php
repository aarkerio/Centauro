<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.7
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file:
class Message extends AppModel
{
  public $name      = 'Message';
    
  public $belongsTo = array('User' =>
                         array('className'     => 'User',
                               'conditions'    => null,
                               'order'         => null,
                               'limit'         => null,
                               'foreignKey'    => 'sender_id',
                               'dependent'     => True,
                               'exclusive'     => False,
                               'finderQuery'   => ''
                         )
                  );
}

# ? > EOF
