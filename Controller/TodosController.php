<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc. (http://www.chipotle-software.com)
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
#file:app/controller/todos_controller.php

App::uses('Sanitize', 'Utility');

class TodosController extends AppController {
    
 public $helpers    = array('User', 'Ck');
    
 public $components = array('Email');

 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('display', 'chkTodos'));
 }

 public function chkTodos()
 {   
   if ($this->Auth->user()):
       $params  = array(
                        'conditions'      => array('Todo.user_id' => $this->Auth->user('id'), 'Todo.completed'=>0),
                        'fields'          => array('Todo.id', 'Todo.name', 'Todo.priority', 'Todo.deadline'),
                        'order'           => 'Todo.priority DESC',
                        'limit'           => 7);  #first five, resolv 
       return $this->Todo->find('all', $params);
   else:
       return false;
   endif;
 }

/**
 * Cron reminder
 * @return void
 * @accesss public
 */
 public function reminders()  # crontab every six hours:  1 6,12 * * * lynx -dum htt://server/todos/reminders > /dev/null
 {
  $params = array(
        'conditions' => array('Todo.deadline' => "< now() + '1 day'", 'Todo.completed' => 0),
        'fields'     => array('Todo.id', 'Todo.user_id', 'Todo.name', 'Todo.priority', 'Todo.deadline', 'User.username', 'User.email'));
  $data  = $this->Todo->find('all', $params);
 
  #exit(print_r($data));
  $k = 0;
  foreach ($data as $val):
      # echo print_r($val);
      $this->sendMail($val);
  endforeach;
 }

/**
 * Feeder
 * @access public
 * @return void
 */
 public function rss($username) 
 {   
   $this->layout = 'rss';
    
   $user_id = (int) $this->Todo->User->field('id', array('User.username'=>$username));
   $params = array(
          'conditions' => array('Todo.completed'=>0, 'Todo.user_id'=>$user_id),
          'fields'     => array('Todo.id', 'Todo.user_id', 'Todo.name', 'Todo.priority', 'Todo.created', 'Todo.modified', 'Todo.completed', 
                                'Todo.task', 'Todo.deadline', 'User.username'),
          'order'      => 'Todo.deadline DESC',
          'limit'      => 30);
   $this->set('data', $this->Todo->find('all', $params));
 }

 private function sendMail($v = array()) 
 {      
  $url='';
        
  $this->Email->sender    = '::MonoNeurona.org::';
  $this->Email->to        = $v["User"]["email"];
  $this->Email->subject   = '::MonoNeurona.org::TODO Reminder';
  $this->Email->sendAs    = 'html';
  $this->Email->template  = null;
  $this->Email->from      = 'noreply@mononeurona.org';
        
  $url  .= '<h2>'.$v['User']['username'].'</h2><p>You must finish  <b>' .$v['Todo']['name']. '</b> with priority '.$v['Todo']['priority'].' during the next 24 hours';
  $url  .= '<br />Deadline date: ' . $v['Todo']['deadline'] .'<br />';
  $url  .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/admin/todos/listing/">';
  $url  .= 'http://'.$_SERVER['SERVER_NAME'].'/admin/todos/listing/</a></p>';
        
  if ( $this->Email->send($url) ):
      return True;
  else:
      return False;
  endif;
 }

/*** ====  ADMIN SECTION    =====****/

 public function admin_add() 
 {
  $this->layout    = 'ajax';   
  if (!empty($this->request->data['Todo'])):
      $this->request->data['Todo']['user_id'] = (int) $this->Auth->user('id');
      if ( $this->Todo->save($this->request->data)): 
           $params = array(
            'conditions' => array('Todo.user_id' => $this->Auth->user('id')),
            'fields' => array('Todo.id', 'Todo.user_id', 'Todo.name', 'Todo.deadline', 'Todo.priority', 'Todo.created', 'Todo.modified', 'Todo.completed'),
            'order'  => 'Todo.id DESC'
              );
            
           $this->set('data', $this->Todo->find('all', $params));
           $this->render('updated', 'ajax');
      endif;
   endif;
 }

 public function admin_listing($order_field = 'id')
 {     
  $this->layout    = 'admin';
  $params = array(
        'conditions' => array('Todo.user_id' => $this->Auth->user('id')),     
        'fields' => array('Todo.id', 'Todo.user_id', 'Todo.name', 'Todo.priority', 'Todo.created', 'Todo.modified', 'Todo.completed', 'Todo.deadline'),
        'order'  => 'Todo.completed ASC, Todo.' . $order_field . ' DESC'
         );
  $this->set('data', $this->Todo->find('all', $params));
 }

 public function admin_edit()
 {
  $this->layout        = 'ajax';
  if (isset($this->request->data['Todo']['get'])):   # get indicate shows edit form action 
      $this->Todo->id  = $this->request->data['Todo']['id'];
      $this->request->data = $this->Todo->read();
      $this->set('data', $this->request->data );       
      $this->render('admin_edit', 'ajax');
  else:
      $this->request->data['Todo']['modified'] = 'now()';
      
      if ($this->Todo->save($this->request->data)):
          $this->msgFlash('Todo has been saved!','/admin/todos/listing');
      endif;
  endif;
}

 public function admin_export($username)
 {
  $this->layout        = 'admin';
  $params = array('conditions'  => array('Todo.id'=>$id, 'Todo.user_id'=>$this->Auth->user('id')));
  $this->set('data', $this->Todo->find('first', $params));
 }

 public function admin_change($todo_id, $status)
 {
  $this->layout                    = 'ajax';
  $this->request->data['Todo']['id']        = $todo_id;
  $this->request->data['Todo']['completed'] = ($status == 0) ? 1 : 0;
    
  if ($this->Todo->save($this->request->data)):
      $this->msgFlash('ToDo has been changed','/admin/todos/listing');
      return True;
  endif;
 }

/**
 * Remove todo
 * @return void
 * @access public
 */
 public function admin_delete($id)
 {
  if ( $this->Todo->delete($id) ):
      $msg = 'Todo has been deleted!';
  else:
	  $msg = 'Todo has NOT been deleted!';
  endif;
 $this->msgFlash($msg, '/admin/todos/listing');
 }
}
# ? > EOF
