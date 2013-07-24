<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/photo.php

class Photo extends AppModel
{

 public $name        = 'Photo';
    
 public $belongsTo  = array(      
             'Gallery' => array(
                         'className'  => 'Gallery',
                         'foreignkey' => 'gallery_id'
                         )
                     );
  
 public $hasMany = array('Commentphoto' =>
                       array('className'     => 'Commentphoto',
                             'conditions'    =>  null,
                             'order'         => 'created',
                             'limit'         =>  null,
                             'foreignKey'    => 'photo_id'
                              )
                        );

/**
 *  Validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
 public $validate = array(
                    'title'  => array('rule'         => array('minLength', 4),
                                      'message'      => 'Must be at least four characters long',
                                      'allowEmpty'   => False,
                                      'required'     => True ),
                    'user_id' => array('rule'        => 'numeric',
                                        'message'    => 'Must be numeric',
                                        'allowEmpty' => False,
                                        'on'         => 'create',  # but not in update
                                        'required'   => True )
                );
}

# ? > EOF
