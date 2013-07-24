<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.7
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# file: APP/Model/Catdownload.php

class Catdownload extends AppModel
{
  public $name      = 'Catdownload';

  public $actsAs = array('Containable');
    
  public $hasMany  = array('Download' =>
                           array('className'  => 'Download',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'catdownload_id'
                           )
                     );
    
    public $validate = array(
                             'id'    => array('rule' => array('minLength', 4),
                                              'message'    => 'Must be at least four characters long',
                                              'allowEmpty' => False,
                                              'required'   => True 
                                              ),
                             'title' => array('rule' => array('minLength', 4),
                                              'message'    => 'Must be at least four characters long',
                                              'allowEmpty' => False,
                                              'required'   => True 
                                             )
   );
}

# ? > EOF

