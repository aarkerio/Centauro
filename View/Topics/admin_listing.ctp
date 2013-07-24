<?php
//exit(print_r($data));
echo $this->Html->addCrumb('Control Tools', '/admin/topics/start'); 
echo $this->Html->getCrumbs(' / '); 
?>

<div class="title_section">Comments on your blog</div>

<?php
//var_dump($data);
$i = 1;
foreach ($data as $val) 
{
  $bg = ($i%2==0) ? "#e2e2e2" : "#fff";
  
  $i++;
  
  echo '<div style="margin:8px 2px 8px 2px;padding:5px;border:1px dotted gray;background-color:'.$bg.'">';
    
    echo  $this->Html->link($val['Entry']['title'], '/users/entry/'.$this->Session->read('Auth.User.username') .'/'.$val['Entry']['id'], array("style"=>"font-size:14pt;font-weight:bold")) . "<br />";
    
    if ( $val['Topic']['user_id'] == 0 ) // the user does not belong to portal, or not was logged
    {
        $user =   "<b>" . $val['Topic']['username'] . "</b>";
    }
    else
    {
        $user =    $this->Html->link($val['Topic']['username'], '/blog/'.$val['Topic']['username']);
    }
    
    echo '<p style="font-size:8pt;font-weight:bold">On ' . $val['Topic']['created'] . "  " . $user ."  wrote: </p>"; 
    
    echo  $val['Topic']['comment'] . "<br /><br />";
    
    echo  '<div style="float:right">'.$this->Gags->sendEdit($val['Topic']['id'], 'comentblogs'). "</div>";
    
    echo  $this->Gags->confirmDel($val['Topic']['id'], 'comentblogs') . "<br />";
    
    echo '</div>';
}
?>

