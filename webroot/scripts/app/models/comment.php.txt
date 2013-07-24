<?php
	class Comment extends AppModel
	{
	  public $name = 'Comment';
	 
	  public $belongsTo = array('Post' =>
	                         array('className'     => 'Post',
	                               'conditions'    => null,
                                   'order'         => 'id DESC',
	                               'limit'         => null,
	                               'foreignKey'    => 'post_id',
	                               'dependent'     => true,
	                               'exclusive'     => false,
	                               'finderQuery'   => ''
 	                         )
	                  );
	      
	 public $validate = array(
        'comment' => VALID_NOT_EMPTY,
        'post_id' => VALID_NOT_EMPTY
      );                  
	                  
	}
?>
