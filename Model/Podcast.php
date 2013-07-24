<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/podcast.php

class Podcast extends AppModel {

  public $name = 'Podcast';
   
  public $belongsTo = 'User';

/**
 *  validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
 public $validate = array(
        'title'       =>  array(
                                'rule'    => array('minLength', '4'),
                                'message' => 'Mimimum 4 characters long'), 
        'description' =>  array(
                                'rule'    => array('minLength', '8'),
                                'message' => 'Description must be at least 8 characters long') 
                        ); 

}
# ? > EOF
