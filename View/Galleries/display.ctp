<?php
exit(print_r($data));

 echo '<div id="cintillo">' . $data["Section"]["description"];
	
 if  ($data["Page"]["display"] == 2  || $data["Page"]["display"] == 3) //como desplegar el cintillo ?
 {   
	            echo  " \ ".  $data["Page"]['title'];
 }
 
 echo '</div><div style="text-align:right;float:right">';
 
 echo $this->Html->link($this->Html->image('secs/'.$data['Section']['img'], 
        array('alt'=>$data['Section']['description'], 'title'=>$data['Section']['description'], 'class'=>"imgborder")), 
        '/pages/section/'.$data['Section']['id'], null, null, false);
 
echo '</div>';

echo $this->Gags->googleAds('page'); //publicity

echo '<div class="barra">'. $data["Page"]['title'] .'</div>';
  
echo "<span style=\"font-weight:bold;font-size:8pt;\">Este art&iacute;culo ha sido consultado en " . number_format($data["Page"]["rank"]) . " ocasiones.</span>";

echo $data["Page"]["body"];

 /*  if  ($data["Page"]["cv"] == 1) 
     {
	     "<div class=\"cv\">Ficha del autor:<br /><span class=\"login\">$login</span><br />";
	       "<b>$email</b><br />$cv<br />"; 
	      "<a href=\"$website\"><img class=\"imgborder\" src=\"img/avatars/$avatar\" title=\"$login\" alt=\"$login\"><br />";
	       "Website</a><br />";
	       "<i>$frase</i><br />Ver todos los articulos de ".$login." </div>";
	      
	   }*/

echo "<br />\n <p class=\"negrita\" style=\"text-align:right;\">&Uacute;ltima actualizaci&oacute;n: " . $data["Page"]["created"]."</p> \n";

if ( $data['Page']['discution'] == 1 )  // discutions
{
         $i = 1;
            echo "<div id=\"discutions\">";
            foreach($data["Discution"] as $v)
            {
              $bg = ($i%2==0) ? "#e2e2e2" : "#fff";
              
              echo "<div class=\"comentnew\" style=\"background-color:".$bg.";\"><span style=\"font-size:7pt\">";  
                 echo $time->timeAgoInWords($v["created"]) . " <b>". $v["username"]    . "</b> wrote:</span><br />";
                 echo $v["comment"];
              echo "</div>";
              $i++;
            }
            echo "</div>";
?>
            
<?php 
echo $this->Form->create('/discutions/add/','post', array("onsubmit"=>"return validateNew()")); 
echo $this->Form->hidden('Discution/page_id', $data["Page"]["id"]);
?>

<fieldset>
<legend>Add comment:</legend>
<p>
  <?php 
  if ($this->Session->read('Auth.User.username') ) 
  {
     echo$this->Session->read('Auth.User.username') . "  escribe:";
     
  } else {
   echo $this->Form->input('Discution/username', array('size' => 25, 'maxlength' => 50));
   echo $this->Form->label('Discution/username', ' Nombre (requerido)' );  
   echo $this->Form->error('Discution/username', 'Name is required.'); 
  }
  ?>
</p>
  
  <?php echo $this->Form->label('Discution/comment', 'Comentario:' );?><br />
  <?php echo $this->Form->textarea('Discution/comment', array("cols"=>30, "rows"=>10)) ?>
  <?php echo $this->Form->error('Discution/comment', 'coment is required.'); ?>
  <br />
  </p>
  
  <br />
  <?php echo $this->Form->end('Add comment') ?>
</fieldset>
</form>
</div>
<?php } ?>

