<?php 
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Commentnews.php

class Commentnews extends AppModel {

  public $name = 'Commentnews';
  
  public $belongsTo = array(
                         'News' =>
                            array('className'     => 'News',
                                  'conditions'    => Null,
                                  'order'         => 'id DESC',
                                  'limit'         => Null,
                                  'foreignKey'    => 'new_id',
                                  'dependent'     => True,
                                  'exclusive'     => False,
                                  'finderQuery'   => ''
                                  ),
                         'User' =>
                            array('className'     => 'User',
                                  'limit'         => Null,
                                  'foreignKey'    => 'user_id',
                                  'dependent'     => True,
                                  'exclusive'     => False,
                                  'fields'        => 'username, avatar'
                                  )
                  );
}

# ? > EOF

