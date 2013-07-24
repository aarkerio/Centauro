<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/media.php

class Media extends AppModel
{
  public $name        = 'Media';

  public $belongsTo   = 'User';
    
  public $validate = array(
                          'file'  =>  array('rule'       => array('minLength', 4),
                                            'message'    => 'Must be at least four characters long',
                                            'allowEmpty' => False,
                                            'required'   => True ),
                         'user_id' => array('rule'       => 'numeric',
                                            'message'    => 'Must be at least four characters long',
                                            'allowEmpty' => False,
                                            'on'         =>'create',
                                            'required'   => True )
   );
}

# ? > EOF
