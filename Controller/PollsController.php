<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /APP/Controller/PollsController.php

App::uses('Sanitize', 'Utility');

class PollsController extends AppController {

 private $__PollsComment = array('hasMany' => array(
                                                     'PollsComment' => array(
                                                           'className' => 'PollsComment'
                                                          )
                                                     )
                     );
 
/**
 *
 *
 * @access public
 * @void mixed
 */
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('poll', 'comments', 'addcomment'));
 }

/**
 *
 *
 * @access public
 * @void mixed
 */
 public function poll() 
 {  
     $params = array('conditions' => array('Poll.status'=>1),
                     'fields'     => array('Poll.id', 'Poll.question', 'Poll.comments'),
                     'order'      => 'Poll.id DESC');
   $this->Poll->unbindModel(
                              array('hasMany' => array('PollsComment'))
                              );

   return $this->Poll->find('first', $params);
 }

 /**
  *
  * @access public
  * @void mixed array or null
  */   
 public function comments($poll_id) 
 { 
   $this->layout = 'portal'; 
   $conditions   = array('Poll.status'=>1, 'Poll.id'=>$poll_id);  
   $fields       = array('Poll.id', 'Poll.question');
   $order        = 'Poll.id DESC';

   $data         = $this->Poll->find($conditions, $fields, $order, 2);
   if ( !$data ):
       $this->redirect('/');
   else:
       $this->set('data', $data);
   endif;
 }

/**
 *
 *
 * @access public
 * @void mixed
 */
 public function addcomment()
 { 
   $this->request->data['PollsComment']['user_id'] = (int) $this->Auth->user('id');    
   $this->Poll->PollsComment->save($this->request->data);
   $poll_comment_id = $this->Poll->PollsComment->getInsertID();
   $this->set('data', $this->Poll->PollsComment->find(array('PollsComment.id'=>$poll_comment_id)));
   $this->render('done', 'ajax');
 }

 /**== ADMIN METHODS==**/

 /**
  *
  * @access public
  * @void mixed array or null
  */   
 public function admin_comments()
 {
   $this->layout    = 'admin';

   $params = array('conditions'   => array('Poll.status'=>1, 'Poll.id'=>$poll_id),
                   'fields'       => array('Poll.id', 'Poll.question'),
                   'order'        => 'Poll.id DESC');

   $data         = $this->Poll->find('first', $params);
   if ( !$data ):
       $this->redirect('/');
   else:
       $this->set('data', $data);
   endif;
}

 /**
  *
  * @access public
  * @void mixed array or null
  */   
public function admin_add() 
{
 $this->layout    = 'admin';     
 if (!empty($this->request->data['Poll'])):
     $this->request->data['Poll']['user_id'] = (int) $this->Auth->user('id');
     if ( $this->Poll->save($this->request->data)):   
         $this->Poll->id    = False;
         $this->Pollrow->id = False;             
         $poll_id = $this->Poll->getLastInsertID();
                
         $colors = array('green', 'blue', 'brown', 'yellow', 'orange', 'red', 'black');
                
         $i = (int) 0;
                
         foreach($this->request->data['Row'] as $pollrow):
             if ( strlen($pollrow) > 0 ):  
                 $new_row = array('Pollrow' => array('answer' => $pollrow, 'poll_id' => $poll_id, 'color'=>$colors[$i], 'id'=>False));
                 if ( !$this->Poll->Pollrow->save($new_row )):
                     die('Error ' . $pollrow . '<br />' . $poll_id . '<br />');
                 endif;
                 $i++;
             endif;
          endforeach;  
          $this->msgFlash(__('Poll added'), '/admin/polls/listing');     
      endif;
  endif;
 }
 
 /**
  *
  * @access public
  * @void mixed array or null
  */   
 public function admin_listing()
 {
   $this->layout    = 'admin';
      
   $params = array(
        'conditions' => array('Poll.user_id' => $this->Auth->user('id')),
        'fields'     => array('Poll.id', 'Poll.question', 'Poll.created', 'Poll.status'),
        'order'      => 'Poll.created DESC',
        'recursive'  => 2 );
   $this->set('data', $this->Poll->find('all', $params));
 }

 /**
  *
  * @access public
  * @void mixed array or null
  */   
 public function admin_edit($id=null)
 {  
  $this->layout = 'admin';
  if (empty($this->request->data['Poll'])):
        $this->Poll->id = $id;
        $this->request->data = $this->Poll->read();
  else:
        if ($this->Poll->save($this->request->data)):
            $this->msgFlash('Poll saved', '/admin/polls/listing');
            exit();
        endif;
  endif;
 }

/**
 * Change status
 * @access public
 * @return void
 */
 public function admin_change($poll_id, $status)
 { 
   $new_status       = ($status == 0 ) ? 1 : 0;
   $this->Poll->id = (int) $poll_id;
       
   if ($this->Poll->saveField('status', $new_status)):
       $this->msgFlash(__('Status modified'), '/admin/polls/listing');
   endif;
  }

/**
 *
 *
 * @access public
 * @void mixed
 */
  public function admin_delete($id)
  {
    $this->Poll->delete($id);
    $this->msgFlash('Poll deleted', '/admin/polls/listing');
  }
}

# ? > EOF
