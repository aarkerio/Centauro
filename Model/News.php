<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/News.php

class News extends AppModel {

 public $name      = 'News';

 public $actsAs = array('Containable');    

 public $virtualFields = array(
                               'news_count' => 'DISTINCT COUNT("News"."user_id")'
                              );
/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */ 
  public $hasMany  = array(
             'Commentnews' => array(
                             'className'    => 'Commentnews',
                             'foreignKey'   => 'new_id',
                             'order'        => 'id'
                               ));
/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */     
  public $belongsTo  = array(
             'User' => array(
                             'className'    => 'User',
                             'foreignKey'   => 'user_id'
                            ), 
             'Theme' => array(
                             'className'    => 'Theme',    
                             'foreignKey'   => 'theme_id'
                              )
             );
/**
 *  Validate CakePHP framework array validations rulz
 *  @access public
 *  @var array
 */   
  public $validate = array(
                               'title' => array('rule' => array('minLength', 4),
                                                'message'    => 'Must be at least four characters long',
                                                'allowEmpty' => False,
                                                'required'   => True ),
                                'body' => array('rule' => array('minLength', 4),
                                                'message'    => 'Must be at least four characters long',
                                                'allowEmpty' => False,
                                                'required'   => True )
                                 );  
}

# ? > EOF
