<?php 
  $this->Html->addCrumb('Control Tools', '/admin/entries/start');  
  $this->Html->addCrumb('Contact', '/admin/contacts/listing'); 
  echo $this->Html->getCrumbs(' > '); 
  echo $this->Form->create('Contact'); 
?>
<div>
<fieldset>
<legend>New Contact</legend>
<?php
 #title varchar(6),
 $opts = array("Mr."=>"Mr.", "Ms."=>"Ms.", "Miss"=>"Miss", "Young fellow"=>"Young fellow", "Dr."=>"Dr.", "Lic."=>"Lic.", 'Hacker'=>'Hacker');
 echo $this->Form->input('Contact.title', array('type'=>'select', 'options'=>$opts));
     
 echo $this->Form->input('Contact.firstname', array('size' => 40, 'maxlength' => 40)); 
     
 #lastname
 echo $this->Form->input('Contact.lastname', array('size' => 40, 'maxlength' => 40)); 
     
 #nickname varchar(30),
 echo $this->Form->input('Contact.nickname', array('size' => 30, 'maxlength' => 30));
      
 #email1 varchar(100),
 echo $this->Form->input('Contact.email1', array('size' => 40, 'maxlength' => 100)); 

//email2 varchar(100),
      echo $this->Form->input('Contact.email2', array('size' => 40, 'maxlength' => 100)); 

//cellphone varchar(100),
      echo $this->Form->input('Contact.cellphone', array('size' => 40, 'maxlength' => 100));
      
//homephone varchar(100)
      echo $this->Form->input('Contact.homephone', array('size' => 40, 'maxlength' => 100)); 

//workphone varchar(100),
      echo $this->Form->input('Contact.workphone', array('size' => 40, 'maxlength' => 100)); 

//fax varchar(100),
      echo $this->Form->input('Contact.fax', array('size' => 40, 'maxlength' => 100)); 

//website varchar(400),
      echo $this->Form->input('Contact.website', array('size' => 40, 'maxlength' => 250, "value"=>"http://")); 

//skype varchar(150),
      echo $this->Form->input('Contact.skype', array('size' => 40, 'maxlength' => 100)); 

//msn varchar(150),
      echo $this->Form->input('Contact.msn', array('size' => 40, 'maxlength' => 50, 'label'=>'MSN')); 

//address varchar(400),
      echo $this->Form->input('Contact.address', array('size' => 70, 'maxlength' => 250, 'label'=>'Address')); 

 #address varchar(8),
 echo $this->Form->input('Contact.cp', array('size' => 4, 'maxlength' => 8, 'label'=>'Postal Code')); 

 # organization varchar(100),
 echo $this->Form->input('Contact.organization', array('size' => 35, 'maxlength' => 100, 'label'=>'Organization')); 

 # birthday date,
      echo $this->Form->input('Contact.birthday', array('type'=>'date','label'=>'Birthday', 'dateFormat'=>'DMY'));      
      echo '<div style="clear:both;margin-top:15px"> </dvi>';
      echo $this->Form->end('Save'); 
  ?>
</fieldset>
</div>
