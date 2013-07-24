<?php
#exit(print_r($data));
echo $this->Html->div('cintillo');
echo  $data['Section']['description'] . ' ';	
if  ($data['Page']['display'] == 2  || $data['Page']['display'] == 3):  #como desplegar el cintillo 
    echo  ' \ '.  $data['Page']['title'];
endif;
 
echo '</div><div style="text-align:right;float:right">';
echo $this->Html->link($this->Html->image('secs/'.$data['Section']['img'], 
        array('alt'=>$data['Section']['description'], 'title'=>$data['Section']['description'], 'class'=>'imgborder')), 
        '/pages/section/'.$data['Section']['id'], array('escape'=>False));
echo '</div>';

echo $this->Html->div('barra', $data['Page']['title']);

echo $this->Gags->googleAds('page'); #publicity  

echo '<p><span style="font-weight:bold;font-size:8pt;">Este art&iacute;culo ha sido consultado en ' . number_format($data['Page']['rank']) . ' ocasiones.</span></p>';

echo $this->Html->div('divbody', $data['Page']['body']);

if  ($data['Page']['cv'] == 1):
  echo $this->Html->div('cv');
     echo  "Ficha del autor:<br /><span class=\"login\">".$data['User']['username'].'</span><br />';      
     echo "<b>". str_replace('@', '_ARRROBA_', $data['User']['email'])."</b><br />".$data['User']['cv'].'<br />';
           
echo $this->Html->link($this->Html->image('avatars/'.$data['User']['avatar'], array('class'=>'imgborder', 'alt'=>$data['User']['username'], 'title'=>$data['User']['username'])), '/blog/'.$data['User']['username'], array('escape'=>False)) . "<br />";
	      
     echo '<i>'.$data['User']['quote'].'</i><br />';
     echo $this->Html->link('Ver todos los articulos de '.$data['User']['username'], '/pages/author/'.$data['User']['username'].'/'.$data['User']['id']) .'</div>';
endif;

echo '<br /><p class="negrita" style="text-align:right">&Uacute;ltima actualizaci&oacute;n: ' . $data['Page']['updated']. '</p>';

echo '<p style="margin:10px auto 10px auto;width:100%;">';
echo $this->Html->link($this->Html->image('static/print-icon.gif', array('alt'=>"Printable version", 'title'=>"Printable version")), '/pages/printing/'.$data['Page']['id'], array('escape'=>False));
echo '</p>';

/*
if ( $data['Page']['discussion'] == 1 ):  // discussions
   $i = 1;
   echo '<div id="discussions">';
   foreach($data['Discussion'] as $v):
       $bg = ($i%2==0) ? '#e2e2e2' : '#fff';
       echo '<div class="comentnew" style="background-color:'.$bg.'"><span style="font-size:7pt">';
              echo $time->timeAgoInWords($v['created']) . ' <b>'. $v['username']    . '</b> wrote:</span><br />';
              echo nl2br(h($v['comment']));
              if ( $this->Session->read('Auth.User') and $this->Session->read('Auth.User.group_id') == 1):
                  echo '<br />'.$this->Html->link($this->Html->image('static/delete_icon.png', array('width'=>'12px', 'alt'=>__('Delete', True), 
                                    'title'=>__('Delete', True))), '/admin/discussions/remove/'.$v['id'].'/'.$v['page_id'],
                                                  array('onclick'=>"return confirm('Are you sure to delete this?')", 'escape'=>False));
              endif;
              echo '</div>';
              $i++;
    endforeach;
    echo '</div>';
  
  # Coment Form
  echo $this->Form->create('Discussion', array('action'=>'add'));
  echo $this->Form->hidden('Discussion.page_id', array('value'=>$data['Page']['id'])) . "\n";

echo '<fieldset>';
echo '<legend>Add comment:</legend>';
  if ($this->Session->read('Auth.User.username') ):
       echo $this->Session->read('Auth.User.username') . '  escribe:';
       echo $this->Form->hidden('Discussion.username',array('value'=>$this->Session->read('Auth.User.username')));
       echo $this->Form->hidden('Discussion.user_id',array('value'=>$this->Session->read('Auth .User.id')));
   else:
       echo $this->Form->input('Discussion.username', array('size' => 25, 'maxlength' => 50, 'class'=>'required'));
       $this->Session->del('captcha'); //del session
       echo '<br /><br /> <img src="'. $this->Html->url('/discussions/captcha') .'" alt="Captcha" /> <br />';
       echo $this->Form->input('Discussion.captcha', array('size' => 6, 'maxlength' => 6));
       echo $this->Form->label('Discussion.captcha', 'Introduce el codigo, todas la letras son minusculas' );
   endif;

   echo $this->Form->input('Discussion.comment', array('type'=>'textarea', 'cols'=>70, 'rows'=>10, 'label'=>False));
   echo $this->Form->end('Add comment'); 
*/
?>

<div id="disqus_thread"></div>
<script type="text/javascript" src="http://disqus.com/forums/mononeurona/embed.js"></script>
<noscript><a href="http://disqus.com/forums/mononeurona/?url=ref">View the discussion thread.</a></noscript><a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>

</div>
<?php 
#endif; 
?>

<script type="text/javascript">
    //<![CDATA[
        (function() {
            var links = document.getElementsByTagName('a');
            var query = '?';
            for(var i = 0; i < links.length; i++) {
                if(links[i].href.indexOf('#disqus_thread') >= 0) {
                    query += 'url' + i + '=' + encodeURIComponent(links[i].href) + '&';
                }
            }
            document.write('<script charset="utf-8" type="text/javascript" src="http://disqus.com/forums/mononeurona/get_num_replies.js' + query + '"></' + 'script>');
        })();
//]]>
</script>
