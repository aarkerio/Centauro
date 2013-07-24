<div id="cintillo">Noticias</div><br />
<div class="barra">Noticias del mundo libre</div><br />
<?php //exit(print_r($data));  ?>
   
 <div class="titnew"><?php echo $data['News']['title']; ?></div>
    <div class="redaccion">Desde la redacci&oacute;n de <i><?php echo $data['Theme']['theme']; ?></i>, 
    <a style="font-size:7pt;" href="/blog/<?php echo $data['News']['title']; ?>"><?php echo $data['User']['username']; ?></a> informa.  &nbsp; <?php echo $data['News']['created']; ?></div> 
    <div class="bodynew">
    
    <div class="img_new">			
    <?php echo $this->Html->link(
                           $this->Html->image('themes/'.$data['Theme']['img'], array('alt'=>$data['Theme']['theme'], 'title'=>$data['Theme']['theme'], 'class'=>"themes")), 
                           '/themes/category/' .$data['News']['theme_id'], 
                           null, null, false); 
    ?>
    </div>
     
    <?php 
       echo $news->newVote($data['News']['id'], $data['News']['votes']);
       echo $data['News']['body']; ?>
    
    
    <br />
    <span style="font-size:7pt;">Permalink:</span> <br />
    <a style="font-size:7pt;" href="/news/single/<?php echo $data['News']['id']; ?>">http://www.mononeurona.org/news/single/<?php echo $data['News']['id']; ?></a>
    <br /><br />

    <b>Reference:</b>
    
    <?php echo $this->Html->link(
                           $this->Html->image('/admin/newwindow.gif', array('alt'=>"Abre Ventana", 'title'=>"Abre Ventana")),
                           $data['News']['reference'],
                           array("onclick"=>"window.open(this.href, '_help', 'status,scrollbars,resizable,width=800,height=600,left=10,top=10,menubar,toolbar')"), 
                           null, 
                           null, 
                           false);
                          
    
    if ( $data['News']['comments'] == 1 )  //Ya hay comentarios??
    {
            $num_coment = count($data["Comentnew"]);
            echo  "&nbsp;". $this->Html->link($num_coment . 'Comentarios', '/news/comments/'.$data['News']['id']);
            echo "&nbsp;&nbsp;";
            echo  $this->Html->link('Pon tu comentario', '/news/comments/'.$data['News']['id']) . "<br />";
            
    }
    
    
    echo $news->socialNets($data['News']['id'], $data['News']['title']); // Social nets buttons
    
    echo "</div><br />"; 
?>
