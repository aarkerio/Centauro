<?php
# Chipotle Software GPLv3 2002-2012
if ( $this->Session->read('Auth.User.username') ): # User is logged in
    $list = array($this->Html->link('MyMONO', '/admin/entries/start') => array(
							       $this->Html->link(__('New blog Entry'), '/admin/entries/edit'),
			                       $this->Html->link(__('Submit Quick'), '/admin/quicks/listing'),
                                   $this->Html->link(__('Submit New'), '/admin/news/edit'),
                                   $this->Html->link(__('Pending stuff'), '/admin/todos/listing'),
                                   $this->Html->link(__('Images'), '/admin/images/listing'),
                                   $this->Html->link(__('Shares'), '/admin/shares/listing'),
                                   $this->Html->link(__('Logout'), '/users/logout')
								 ));
else:
    $list = array();
endif;

$themes = $this->requestAction('themes/display');
   
foreach ($themes as $t):
              $theme = $this->Html->link('&#187;'.$t['Theme']['theme'], 
                                         '/themes/view/'.$t['Theme']['id'], array('title'=>$t['Theme']['description'], 'escape'=>False));
              array_push($list, $theme);
endforeach;
$more = $this->Html->link('&#187;More','/themes/display', array('title'=>'All themes', 'style'=>'font-weight:bolder', 'escape'=>False));
array_push($list, $more);

echo  $this->Html->div('tnav', $this->Html->nestedList($list, array('id'=>'navmenu')));

# ? > EOF
