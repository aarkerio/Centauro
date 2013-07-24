<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Page.php

class Page extends AppModel {

    public $name        = 'Page';

/**
 * CakePHP Containable behaviour 
 * @acces public
 * @var array
 */
 public $actsAs = array('Containable');

/**
 * CakePHP  
 * @acces public
 * @var array
 */   
 public $belongsTo = array('User' =>
                           array('className'  => 'User',
                                 'conditions' => '',
                                 'fields'     => 'id, username, avatar, cv, email, quote',
                                 'foreignKey' => 'user_id'
                           ),
                           'Section' =>
                           array('className'   => 'Section',
                                 'conditions'  => Null,
                                 'order'       => Null,
                                 'fields'      => 'Section.id, Section.description, Section.img',
                                 'foreignKey'  => 'section_id'
                           )
                     );
    
/**
 * CakePHP  
 * @acces public
 * @var array
 */   
    public $hasMany     = array('Discussion' =>
                           array('className'  => 'Discussion',
                                 'conditions' => '',
                                 'order'      => 'id ASC',
                                 'foreignKey' => 'page_id'
                           ));
    
/**
 * CakePHP  
 * @acces public
 * @var array
 */   
    public $validate = array(
          'title'   => array('rule' => array('minLength', 4),
                             'message'    => 'Must be at least four characters long',
                             'allowEmpty' => False,
                             'required'   => True ),
          'body'    => array('rule' => array('minLength', 4),
                             'message'    => 'Must be at least four characters long',
                             'allowEmpty' => False,
                             'required'   => True ),
          'user_id' => array('rule' => 'numeric',
                             'message'    => 'Must be at least four characters long',
                             'allowEmpty' => False,
                             'on'         => 'create',
                             'required'   => True )
   );

/**
 * Add one visit to page
 * @param integer $page_id
 * @access public
 * @return void 
 */
 public function oneMore($page_id) 
 {
   $rank = (int) $this->Page->field('rank', array('Page.id' => $id));     
   $rank++;
   if ($this->Page->saveField('rank', $rank)):
       $this->Session->write('page_'.$id,  $id);
   endif;
 }
}

# ? > EOF
