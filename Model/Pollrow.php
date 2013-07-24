<?php
/**
 *  Centauro Intranet Portal
 *  GPLv
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/pollrow.php 

class Pollrow extends AppModel
{
  public $name      = 'Pollrow';
  
  public $belongsTo = array('Poll' =>
                           array('className'  => 'Poll'
                           )
                     );
}
# ? >
