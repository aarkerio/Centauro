<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: models/quote.php

class Quote extends AppModel
{
  public $name        = 'Quote';
  public $belongsTo   = array('User');

/**
 *  Validate   CakePHP framework array element
 *  @access public
 *  @var array
 */
  public $validate = array('author' => array('rule' => array('minLength', 4),
                                            'message'    => 'Must be at least four characters long',
                                            'allowEmpty' => False,
                                            'required'   => True ),
                           'quote' => array('rule'       => array('minLength', 4),
                                            'message'    => 'Must be at least four characters long',
                                            'allowEmpty' => False,
                                            'required'   => True ));
}

# ? >
