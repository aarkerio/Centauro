<h1><?php __('Reporting bugs'); ?></h1>
<?php 
  echo $this->Html->para(null, 
  __('You can help the Centauro development team by reporting bugs and making suggestions to improve this application', true));
  echo $this->Form->create('Help', array('action'=>'submit'));
  
  echo $this->Form->label('Help.report', __('Description', true)) . '<br />';
  echo $this->Form->textarea('Help.report', array('rows'=>8, 'cols'=>60)) . '<br />';
  
  echo $this->Form->label('Help.kind', __('Kind', true)) . '<br />';
  echo $this->Form->select('Help.kind', array('Enhancement'=>__('Enhancement', true), 'Bug'=>'Bug', 'Suggestion'=>__('Suggestion', true)), null, array(), false) . '<br /><br />';
  
  echo $this->Form->end(__('Send', true)) .'<br />';
  
  echo $this->Html->link('Or even better, join the team!', 'http://centauro.chipotle-software.com'); 
?>