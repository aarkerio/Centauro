<?php
/**
 *  Centauro Intranet Portal
 *  GPLv3
 *  @copyright Copyright 2002-2012, Chipotle Software, Inc.
 *  @version 0.8
 *  @package links
 *  @license http://www.gnu.org/licenses/gpl-3.0.html
 */
# File: /app/controllers/pollrows_controller.php

class PollrowsController extends AppController
{
 public $name          = 'Pollrows';
  
 public $helpers       = array('Form');
  
 #public $components    = array('Security');
 public function beforeFilter() 
 {
   parent::beforeFilter();
   $this->Auth->allow(array('vote'));
 }
  
 public function vote() 
 {
  $this->layout = 'ajax';    
  # adds new vote to database
  if (!empty($this->request->data['Pollrow'])):
      $vote  = (int) $this->Pollrow->field('vote', array('Pollrow.id' => $this->request->data['Pollrow']['id']));
           
      $vote += 1;
      #exit("votos " . $vote);
      $this->Pollrow->id = (int) $this->request->data['Pollrow']['id']; 
              
      if ($this->Pollrow->saveField('vote', $vote)):  # add the Poll vote
          $this->Session->write('poll_id',  $this->request->data['Pollrow']['poll_id']); #set session, only one vote per session
          $params =array('conditions' => array('Pollrow.poll_id' => $this->request->data['Pollrow']['poll_id']),
                         'fields'     => array('Pollrow.answer', 'Pollrow.color', 'Pollrow.vote', 'Pollrow.poll_id', 'Poll.id', 'Poll.question'),
                         'order'      => 'Pollrow.id');
          $this->set('poll', $this->Pollrow->find('all', $params));
          $this->render('results', 'ajax');
      else:
          echo "Ajax error, check with the company's computer guy...";
      endif;
  endif;  
 }
  
 public function admin_add() 
 {
   # adds new pollrow to database
   if (!empty($this->request->data['Pollrow']))
   {
      if ($this->Pollrow->save($this->request->data))   //save the Poll vote
      {
          $conditions = array("poll_id" => $this->request->data['Pollrow']['poll_id'], "GROUP BY"=> "answer, color");
          $fields     = array("id", "answer, color");
          $order      = "Pollrow.vote ASC";
        
        //$poll = $this->Pollrow->findAll($conditions, $fields, $order, $limit);
        
				$this->set('data', $this->Pollrow->findAll($conditions,  $fields, $order));  //get all
				$this->render('results', 'ajax');
			}
			else
			{
				// do nothing
			}
		}
	}
 
public function admin_edit($id)
{
     
    if (empty($this->request->data))
    {
        $this->layout = 'admin';
        
        $this->Pollrow->poll_id = $id;
              
        $this->request->data = $this->Pollrow->read();
    }
    else
    {
        if ($this->Message->save($this->request->data))
        {
            $this->redirect('/polls/listing');
        }
    }
}
   
	public function undo($id)
	{
		// moves task from done to todo
		$this->Pollrow->id = $id;
		$this->request->data['Pollrow']['done'] = 0;
		if ($this->Pollrow->save($this->request->data))
		{
			$this->set('data', $this->Pollrow->findAll());
			$this->render('todo', 'ajax');
		}
	}
	
	public function admin_delete($id)
	{
		// deletes task from database
		$this->Pollrow->delete($id);
		$this->set('data', $this->Pollrow->findAll());
		$this->render('done', 'ajax');
  }
}
?>
