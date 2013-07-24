<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software(c)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file: APP/Model/Entry.php

class Entry extends AppModel
{
  public $name      = 'Entry';

/**
 * used in search
 * @var array
 * @access private
 */
 private $_Keywords   = Null;

/**
 * used in search
 * @var array
 * @access public
 */

 public $lang = 'es';

/**
 *  Load behaviours
 *  @access public   
 *  @var array
 */ 
 public $actsAs  = array('Containable');
  

/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */ 
 public $belongsTo = array('User', 'Themeblog');

/**
 *  CakePHP hasMany relation
 *  @access public
 *  @var array
 */ 
    public $hasMany = array('Commentblog' =>
		       array('className'     => 'Commentblog',
			     'conditions'        => Null,
			     'order'             => 'Commentblog.id ASC'
			     )
		       );
 
/**
 *  CakePHP belongsTo relation
 *  @access public
 *  @var array
 */     
  public $validate = array(
                           'title' =>  array('rule'       => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ),     
                           'user_id' => array('rule'      => 'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'on'         => 'create', # but not on update
                                             'required'   => True ),     
                           'body' => array('rule'         => array('minLength', 4),
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True ), 
                           'status' => array('rule'       => 'numeric',
                                             'message'    => 'Must be at least four characters long',
                                             'allowEmpty' => False,
                                             'required'   => True )  
                           ); 

/**
  * Sum 1 to number of times this entry has been saw
  * @access public
  * @return boolean
  */ 
 public function addVisit($entry_id) 
 { 
   $conditions = array('Entry.id'=>$entry_id);
  
   $visits = $this->field('visits',$conditions);
  
   $this->id  = (int) $entry_id; 
   $n_visits  = (int) ($visits + 1);
  
   if ( $this->saveField('visits', $n_visits) ):
       return True;
   else:
       die('Error on addVisit function');
   endif;
   
   return True;
  }

/**
  * Sum 1 to number of times this entry has been saw
  * @access public
  * @return boolean
  */ 
 public function totalVisits($user_id) 
 { 
  $visits = (int) 0;
  $params = array(
            'conditions' => array('Entry.status'=>1, 'Entry.user_id'=>$user_id),
            'fields'     => array('Entry.visits'),
            'contain'    => False
           );
   
  $fields =  $this->find('all', $params);
  foreach($fields as $f):
      $visits  += $f['Entry']['visits'];
  endforeach;

  return $visits;
 }

/**
 * Search in entries
 * @param array $terms
 * @param integer $user_id
 * @access public 
 */
 public function search($terms, $user_id)
 {
  $this->_Keywords = explode(' ', trim($terms));  # convert to array
  $count = (int) count($this->_Keywords);
  # build terms array
  $t = (string) '';
  if ( $count < 2 ):
      $t = trim($this->_Keywords[0]);
  elseif( $count > 1 ):
        $last = $count - 1; # last element in array
      for($i=0; $i<$count; $i++):
          #die('fdsf '.$this->_Keywords[$i]);
          $t .= $this->_Keywords[$i];
          if (  $i < $last ):
              $t .=  ' | ';    # "OR" postgresql search operator
          endif;
       endfor;
   endif;
   #die(debug($t));
   $q  = "SELECT id, user_id, title, created, ts_headline('karamelo_".$this->lang."', body, to_tsquery('karamelo_".$this->lang."','".$t."')) AS headline, ";
   $q .= "rank, username FROM (";
   $q .= "SELECT DISTINCT \"User\".\"username\",\"Entry\".\"id\",\"Entry\".\"user_id\",\"Entry\".\"title\",\"Entry\".\"created\",substr(\"Entry\".\"body\",0,260) AS body, ";
   $q .= "ts_rank_cd(to_tsvector('karamelo_".$this->lang."', body), to_tsquery('karamelo_es','".$t."')) AS rank ";
   $q .= "FROM \"entries\" AS \"Entry\", \"users\" AS \"User\" ";
   $q .= "WHERE to_tsquery('karamelo_".$this->lang."','".$t."') @@ to_tsvector('karamelo_".$this->lang."', \"Entry\".\"body\")";
   $q .= " AND \"User\".\"id\"=\"Entry\".\"user_id\" AND \"Entry\".\"status\"=1 AND \"Entry\".\"user_id\" = $user_id ORDER BY rank DESC LIMIT 80) AS entries";
   #die(debug($q));

   $data = $this->query($q);
   #die(debug($data));
   return $data;
 }
}

# ? > EOF
