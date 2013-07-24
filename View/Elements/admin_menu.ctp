<div style="margin:0 0 0 60px;text-align:left;">
<?php 
$list = array(
             $this->Html->link(__('Control Panel'), '/admin/entries/start') => array(
		                                                          $this->Html->link(__('My files'), '/admin/shares/listing'),
                                                                  $this->Html->link(__('Podcasts'), '/admin/podcasts/listing'),
                                                                  $this->Html->link(__('Bookmarks'), '/admin/bookmarks/listing'),
                                                                  $this->Html->link('Mis pendientes', '/admin/todos/listing'),
                                                                  $this->Html->link(__('Google Maps'), '/admin/markers/index')
			                                                 ),
             $this->Html->link('myBlog', '/admin/entries/listing') => array(
							                                   $this->Html->link(__('New Entry'), '/admin/entries/edit'),
                                                               $this->Html->link(__('Themes'), '/admin/themeblogs/listing'),
			                                                   $this->Html->link(__('Comments'), '/admin/commentblogs/listing'),
                                                               $this->Html->link(__('Quotes'), '/admin/quotes/listing'),
                                                               $this->Html->link('LiveChat', '/admin/livechats/listing'),
                                                               $this->Html->link(__('CSS'), '/admin/styles/edit'),
                                                                ),
            $this->Html->link(__('Images'), '/admin/images/listing'),
            $this->Html->link(__('Messages'), '/admin/messages/listing'),
            $this->Html->link(__('Quick News'), '/admin/quicks/listing'),
            $this->Html->link(__('wIwD'), '/admin/waydings/listing'),
	        $this->Html->link(__('Pages'), '/admin/pages/sections') => array(
                                                                           $this->Html->link(__('New Page'), '/admin/pages/edit')
                                                                          ),
             $this->Html->link(__('Helps'), '/helps/index')  => array(
		    					         $this->Html->link(__('Report bug'), '/admin/helps/newticket'),
                                         $this->Html->link(__('Get support'), '#header', array('onclick'=>"javascript:window.open('http://www.chipotle-software.com/', 'blank', 'toolbar=no, scrollbars=yes,width=900,height=700')"))
                                                            )
             );
  echo $this->Html->nestedList($list, array('id'=>'navmenu'));
?>
</div>