<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/quicks_controller.php
 
App::uses('Sanitize', 'Utility');

class QuicksController extends AppController
{  
 public $components  = array('RequestHandler', 'Mailer');
 
 public $cacheAction = array(
                             'view' => '3 minutes',
                             'all'  => '15 minutes'
                             );
  
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('lastQuicks', 'vote', 'all', 'site', 'comment', 'addcomment', 'index','feeder'));
 }

/**
 * Display quicks
 * @access public
 * @return void
 */
 public function index()
 {
   if (!$this->RequestHandler->isAjax()):
      $this->layout = 'portal';  
   endif;
   $this->paginate = array(
                           'order'      => 'Quick.id DESC',
                           'limit'      => 15
                           );
   $data = $this->paginate('Quick');
   $this->set(compact('data'));
 }

/**
 * Create an rss feed of the 15 last uploaded uses the RSS component
 * @access public
 * @return void
 */
 public function lastQuicks()
 {  

   $params = array('order'  => 'Quick.id DESC',
                   'limit'  => 12
                    );
   $this->set('quicks', $this->Quick->find('all', $params));
   return $this->Quick->find('all', $params);
 }

/**
 * Create an rss feed of the 15 last uploaded uses the RSS component
 * @access public
 * @return void
 */
  public function feeder() 
  {
    $channelData = array('title' => 'Despabilando la MonoNeurona',
		                 'link'  => array('controller' => 'newss', 'action' => 'view'),
		                 'description' => 'Hacktivismo',
		                 'language' => 'es-mx'
	                );
      
    $this->Quick->contain();
   
    $params = array('fields' => array('Quick.id', 'Quick.title', 'Quick.reference'),
                    'order'  => 'Quick.id DESC',
                    'limit'  => 20);
     
    $quicks = $this->Quick->find('all', $params);
    
    $this->set(compact('channelData', 'quicks'));  
  }

/**
 * Vote
 * @access public
 * @return void
 */
 public function vote($karma, $quick_id) 
 {
  $already_votes = $this->Quick->QuicksVote->field('user_id', array('quick_id'=>$quick_id, 'user_id'=>$this->Auth->user('id')));
  if ( $already_votes ):
      $this->render('wrong', 'ajax');
  else:
      $vote = (int) 0;
      $new_vote = $karma == 'up' ? $vote + 1 : $vote - 1;
      $this->request->data['QuicksVote']['user_id']  = (int) $this->Auth->user('id');
      $this->request->data['QuicksVote']['quick_id'] = (int) $quick_id;
      $this->request->data['QuicksVote']['vote']     = (int) $new_vote;
      $this->Quick->QuicksVote->save($this->request->data);
      $params = array('conditions'=>array('quick_id'=>$quick_id));
      $new_vote = $this->Quick->QuicksVote->find('count', $params);
      $this->set('votes', $new_vote);
      $this->set('karma',$karma);
      $this->render('voted', 'ajax');
  endif;
 }

/**
 * All links from site
 * @access public
 */
 public function site($site)
 {  
   $this->layout = 'portal';
   $params = array('conditions'   => array('Quick.site'=>$site), 
                   'order'        => 'Quick.id DESC',
                   'limit'        => 30);   
   $this->set('data', $this->Quick->find('all', $params));
 }


/**
 *  Comment
 *  @access public
 *  @return void
 */
 public function comment($quick_id)
 {  
    if (!$this->RequestHandler->isAjax()):
        $this->layout = 'portal';
    endif;

   #$this->Quick->contain('QuicksComment');
   $params = array('conditions'=> array('Quick.id'=>$quick_id), 
                   'contain'   => array('User', 'Theme', 'QuicksVote', 'QuicksComment' => array('User'))
                  );
   $data =  $this->Quick->find('first', $params);
   if (!$data):
           $this->cakeError('error404', array(array('url'=>$this->name.'/'.$this->action)));
   endif;
   $this->set('data',$data);
 }

/**
 *  Single theme
 *  @access public
 *  @return void
 */
 public function theme($theme_id)
 {  
   $params = array('conditions' => array('Quick.theme_id'=>$theme_id),
                   'order'      => 'Quick.id DESC');
 
   $this->set('data', $this->Quick->Theme->find('all', $params));
 }

/**
 *  All themes
 *  @access public
 *  @return void
 */
 public function all()
 {  
   $params = array('order' => 'Quick.id DESC');
   $this->set('data', $this->Quick->find('all', $params));
 }

/**
 *  Save comment
 *  @access public
 *  @return void
 */
 public function addcomment()
 { 
   $this->request->data['QuicksComment']['user_id'] = (int) $this->Auth->user('id');    

   if($this->Quick->QuicksComment->save($this->request->data)):
        $this->Session->setFlash(__('Comment saved', True));
   endif;

   $quick_comment_id = (int) $this->Quick->QuicksComment->getInsertID();
   $this->__sendMail($this->request->data['QuicksComment']['user_id'], $this->request->data['QuicksComment']['quick_id']);

   if ($this->RequestHandler->isAjax()):
       $this->set('data', $this->Quick->QuicksComment->find('all', 
            array(
                'conditions'=> array('QuicksComment.quick_id'=>$this->request->data['QuicksComment']['quick_id'])
                )));
   else:
       $this->set('data', $this->Quick->QuicksComment->find(array('QuicksComment.id'=>$quick_comment_id)));
   endif;

   $this->render('done', 'ajax');
 }

/**
 *  Send mail
 *  @access private
 */
 private function __sendMail($user_id, $quick_id) 
 {
  $fields = array('email', 'username');      
  $email = $this->Quick->User->field('User.email', array('User.id'=>$user_id));
  $data = array('msg'=>'New comment in quicknew: http://'.$_SERVER['SERVER_NAME'].'/quicks/comment/'.$quick_id,'quick_id'=>$quick_id, 'template'=>'newcomment', 'email'=>$email);
  #die(debug($data));
  $this->Mailer->send($data);
 } 
 
/**
 *
 *  @access public
 *  @return void
 */
 public function qnform()
 { 
   $this->set('themes',Set::combine($this->Quick->Theme->find('all',array('order'=>'theme')),"{n}.Theme.id","{n}.Theme.theme"));
   $this->render('qnform', 'ajax');
 }
 
/**
 *
 *  @access public
 *  @return void
 */
 public function addquick()
 { 
    if ($this->RequestHandler->isAjax()):
        $return = '/quicks/lastQuicks';
    else:
        $return = '/';
    endif;

    if (!empty($this->request->data['Quick'])):
        if ( strlen($this->request->data['Quick']['reference']) > 10 ):
            $this->request->data['Quick']['site'] = parse_url($this->request->data['Quick']['reference'], PHP_URL_HOST);
        endif;
        $this->request->data['Quick']['user_id'] = (int) $this->Auth->user('id');
	    if ($this->Quick->save($this->request->data)):
	         $this->msgFlash('Data saved', $return); 
        else:
	         $msg =implode('<br />',$this->Quick->validationErrors);
	         $this->msgFlash($msg, $return);
	    endif;
    endif;
 }
 
 /*** ======ADMIN SECTION === *****/ 
/**
 *
 *  @access public
 *  @return void
 */
 public function admin_add() 
 {
    if (!empty($this->request->data['Quick'])):
        if ( strlen($this->request->data['Quick']['reference']) > 10 ):
            $this->request->data['Quick']['site'] = parse_url($this->request->data['Quick']['reference'], PHP_URL_HOST);
        endif;
        $this->request->data['Quick']['user_id'] = (int) $this->Auth->user('id');
	    if ($this->Quick->save($this->request->data)):
	        $this->msgFlash('Data saved', '/admin/quicks/listing'); 
        else:
	        $msg =implode('<br />',$this->Quick->validationErrors);
	        $this->msgFlash($msg, '/admin/quicks/listing');
	    endif;
    endif;
 }

/**
 *
 *  @access public
 *  @return void
 */
 public function admin_edit($quick_id) 
 {
    $this->layout = 'admin';
    $this->set('themes',Set::combine($this->Quick->Theme->find('all',array('order'=>'theme')),"{n}.Theme.id","{n}.Theme.theme"));
    if (!empty($this->request->data['Quick'])):
        $this->request->data['Quick']['site'] = parse_url($this->request->data['Quick']['reference'], PHP_URL_HOST);
	    if ($this->Quick->save($this->request->data)):
	        $this->msgFlash('Data saved', '/admin/quicks/listing'); 
        else:
	        $msg =implode('<br />',$this->Quick->validationErrors);
	        $this->msgFlash($msg, '/admin/quicks/listing');
	    endif;
    else:
        $this->request->data  = $this->Quick->read(null, $quick_id);
    endif;
 }

/**
 *  Display user quick news
 *  @access public
 *  @return void
 */
 public function admin_listing() 
 {
  $this->set('themes',Set::combine($this->Quick->Theme->find('all',array('order'=>'theme')),"{n}.Theme.id","{n}.Theme.theme"));
  $this->layout = 'admin';
  $params = array('conditions'   => array('Quick.user_id' => $this->Auth->user('id')),          # only the user\'s news
                  'fields'       => array('id', 'title', 'reference', 'votes'),
                  'order'        => 'Quick.id DESC',
                  'limit'        => 25);
  $this->set('data', $this->Quick->find('all', $params)); 
  }
  
/**
 * Remove
 * @access public
 * @return void
 */
  public function admin_delete($quick_id)
  {   
    if ( $this->Quick->delete($quick_id) ):
	    $this->msgFlash('Data removed', '/admin/quicks/listing');
	endif;
  }
}
# ? > EOF
