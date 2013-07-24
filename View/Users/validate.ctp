<?php
//die(print_r($message));
foreach ($message as $m):
     echo $m . "  <br />";
endforeach;

#this is just to delete the form after new user data was saved
if ( isset($ok) ):
?>
    <script type="text/javascript">
		<!--
			var ok = true; 
 			if ( ok == true ) 
       { 
              //alert('I am in!!');
              var myDiv = document.getElementById('form_register');
              myDiv.innerHTML = '';
       }
		//-->
		</script>
    
<?php 
endif; 
?>
