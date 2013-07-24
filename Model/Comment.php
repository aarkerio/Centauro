<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Comment.php

class Comment extends AppModel
{
  public $name = 'Comment';
  
  public $belongsTo = array('User', 'Entry');
  
}

# ? > EOF

