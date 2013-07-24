<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/section.php

class Section extends AppModel
{
  public $name    = 'Section';
  
/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */
  public $hasMany = array('Page' =>
                       array('className'  => 'Page',
                             'fields'     => 'id, title',
                             'foreignKey' => 'section_id')
                   );
}
# ? >
