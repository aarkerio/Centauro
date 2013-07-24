<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/entry.php

class Livechat extends AppModel {
   
   public $name     = 'Livechat';
   
   public $belongsTo = array('User' =>
                         array('className'     => 'User',
                               'conditions'    => null,
                               'order'         => null,
                               'limit'         => 7,
                               'foreignKey'    => 'user_id',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         )
                  );
   
}

# ? > EOF

