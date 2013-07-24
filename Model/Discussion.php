<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Discussion.php
 
class Discussion extends AppModel
{
  public $name = 'Discussion';
  
  public $belongsTo = array('User', 'Page');
 
}
# ? > EOF

