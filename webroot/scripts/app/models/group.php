<?php
 class Group extends AppModel	{
 	public $name = 'Group';
 	
 	public $hasMany = 'User';
 	
 	/*public $hasAndBelongsToMany = array('Permission' =>
 	                                                   array('className' => 'Permission', 
 	                                                   'joinTable' => 'groups_permissions')); */
 }
?>
