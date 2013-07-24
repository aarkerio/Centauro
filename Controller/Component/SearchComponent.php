<?php
/**
*
* GPLv3 Chipotle Software 2002-2007 
*
**/
App::import('Model','Entry');
App::import('Model','News');
App::import('Model','Podcast');
App::import('Model','Faq');
App::import('Model','Glossary');
App::import('Model','Lesson');

class SearchComponent extends Object
{

public $controller = true; 

/**
 * Startup - Link the component to the controller.
 *
 * @param controller
 */
 public function startup(&$controller)
 {
		 $this->controller =& $controller;
 }
 
 /**
 * Build and execute search query
 */
 
 private $Models   = null; // fields to search
 
 private $Keywords = null;
 
 private $Fields   = null;
 
 private $Limit    = null;
 
 private $Order    = null;
 
 public $Data      = array();
 
 public function getRows($keywords) 
 {    
      //at least three letters
      if (strlen($keywords) < 3)
      {
         return null;
      }
      
      $this->Models = array('Entry', 'News', 'Podcast', 'Faq', 'Glossary', 'Lesson'); // models to search in
      
      $this->Keywords = explode(' ', $keywords); // convert to array
      
      //exit(print_r($this->Keywords));
      
      foreach ($this->Models as $model)
      {
         $conditions = "(";
         
         foreach ($this->Keywords as $f)
         {  
            if ( strlen($conditions) > 5)
            {
                      $conditions  .= " OR ";
            }
            
            switch ($model)
            {
               case 'Entry':
                   
                   $conditions  .= "Entry.body ~* '$f' OR Entry.title ~* '$f' AND Entry.status=1";
                   
                   $this->Fields = array('Entry.id', 'Entry.title');
                   $this->Limit  = 20;
                   $this->Order  = "Entry.id DESC";
                   break;
                   
               case 'News':
                   $conditions  .= "News.body ~* '$f' OR News.title ~* '$f' AND News.status=1";
                   $this->Fields = array('News.id', 'News.title');
                   $this->Limit  = 20;
                   $this->Order  = "News.id DESC";
                   break;
                   
               case 'Faq':
                   $conditions  .= "Faq.question ~* '$f' OR Faq.answer ~* '$f'";
                   $this->Fields = array('Faq.id', 'Faq.question');
                   $this->Limit  = 20;
                   $this->Order  = "Faq.id DESC";
                   break;
               
               case 'Podcast':
                   $conditions  .= "Podcast.title ~* '$f' OR Podcast.description ~* '$f' AND Podcast.status=1";
                   $this->Fields = array('Podcast.id', 'Podcast.title');
                   $this->Limit  = 20;
                   $this->Order  = "Podcast.id DESC";
                   break;
                   
               case 'Glossary':
                   $conditions  .= "Glossary.item ~* '$f' OR Glossary.definition ~* '$f'";
                   $this->Fields = array('Glossary.id', 'Glossary.item');
                   $this->Limit  = 20;
                   $this->Order  = "Glossary.id DESC";
                   break;
                   
               case 'Lesson':
                   $conditions  .= "Lesson.title ~* '$f' OR Lesson.body ~* '$f'";
                   $this->Fields = array('Lesson.id', 'Lesson.title');
                   $this->Limit  = 20;
                   $this->Order  = "Lesson.id DESC";
                   break;
            }
          }
          
          $conditions .= ")";
          
          $Model =& new $model;
          
          $this->Data[$model] = $Model->findAll($conditions, $this->Fields, $this->Order, $this->Limit);
          
          $conditions = '';
      }
      
      return $this->Data;
		
  }
}
?>
