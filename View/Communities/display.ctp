<div id="cintillo">Noticias</div>
<div class="barra">Noticias del mundo libre</div>
   
 <div class="titnew"><?php echo $data['News']['title']; ?></div>
    <div class="redaccion">Desde la redacci&oacute;n de <i><?php echo $data['Theme']['theme']; ?></i>, 
    <a style="font-size:7pt;" href="/users/blogger/<?php echo $data['User']['username']; ?>"><?php echo $data['User']['username']; ?></a> informa.  &nbsp; <?php echo $data['News']['created']; ?></div> 
    <div class="bodynew">
    
    <div class="img_new">			
    <?php echo $this->Html->link(
                           $this->Html->image('themes/'.$data['Theme']['img'], array('alt'=>$data['Theme']['theme'], 'title'=>$data['Theme']['theme'], 'class'=>"themes")), 
                           '/news/category/' .$data['News']['theme_id'], 
                           null, null, false); 
    ?>
    </div>
     
    <?php 
       echo $news->newVote($data['News']['id'], $data['News']['votes']);
       
       echo $data['News']['body']; 
       ?>
    
    <br />
    <span style="font-size:7pt;">Permalink:</span> <br />
    <a style="font-size:7pt;" href="/news/display/<?php echo $data['News']['id']; ?>">http://www.mononeurona.org/news/display/<?php echo $data['News']['id']; ?></a>
    <br /><br />
    <?php echo $this->Gags->googleAds(2); ?>
    <b>Reference:</b>
    
    <?php echo $this->Html->link(
                           $this->Html->image('/admin/newwindow.gif', array('alt'=>"Abre Ventana", 'title'=>"Abre Ventana")),
                           $data['News']['reference'],
                           array("onclick"=>"window.open(this.href, '_help', 'status,scrollbars,resizable,width=800,height=600,left=10,top=10,menubar,toolbar')"), 
                           null,
                           null,
                           false);
    
    
    echo $news->socialNets($data['News']['id'], $data['News']['title']); // Social nets buttons
    
  if ( $data['News']['comments'] == 1 )  // comments are actived ??
  {
         $i = 1;
            echo '<div id="cnews">';
            foreach($data["Comentnew"] as $v)
            {
              $bg = ( ($i / 2) == 1) ? "#e2e2e2" : "#fff";
              
              echo '<div class="comentnew" style="background-color:'.$bg.'">';  
                 echo $time->timeAgoInWords($v["created"]) . " <b>". $v["name"]    . "</b> wrote:<br />";
                 echo $v["comment"] ;
              echo "</div>";
              $i++;
            }
            echo "</div>";
            ?>


<?php 
   echo $this->Form->create('/comentnews/add/','post', array("onsubmit"=>"return validateNew()")); 
   echo $this->Form->hidden('Comentnews/new_id', $data['News']['id']); 
   echo $this->Form->hidden('Comentnews/level', 1);
   echo $this->Form->hidden('Comentnews/comentnew_id', 1); 
?>

<fieldset>
<legend>Add comment:</legend>
<p>
  <?php 
  if ($this->Session->read('Auth.User.username') ) 
  {
     echo $this->Form->hidden('Comentnews/user_id',$this->Session->read('Auth.User.id'));
     echo $this->Form->hidden('Comentnews/name',$this->Session->read('Auth.User.username'));
     echo$this->Session->read('Auth.User.username') . "  escribe:";
  }
  else
  {
     echo $this->Form->hidden('Comentnews/user_id', 0);
     echo $this->Form->input('Comentnews/name', array('size' => 25, 'maxlength' => 50));
     echo $this->Form->label('Comentnews/name', ' Nombre (requerido)' );  
     echo $this->Form->error('Comentnews/name', 'Name is required.'); 
  }
  ?>
</p>
  
  <?php echo $this->Form->label('Comentnews/comment', 'Comentario:' );?><br />
  <?php echo $this->Form->textarea('Comentnews/comment', array("cols"=>50, "rows"=>10)) ?>
  <?php echo $this->Form->error('Comentnews/comment', 'Comment is required.'); ?>
  <br />
  </p>
  
  <br />
  <?php echo $this->Form->end('Add comment') ?>
</fieldset>
</form>
</div>
<?php } ?>
