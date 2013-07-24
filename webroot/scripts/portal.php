<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
            "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>::My Portal::</title>

<link rel="stylesheet" type="text/css" href="css/portal.css">
</head>
<body>
 <div id="wrapper">  
   <div id="header">
    <?php echo date('l dS \de F Y h:i:s A'); ?> 
    <a href="portal.php?tmpl=3">Profile</a>
   </div>
<div style="clear:both;"></div>    
   <div id="container">
	 <div id="main">
        <?php
         // Pear database abstraction
         //require_once 'inc/conexion.inc.php'; 

         //set template
         $tmpl = ( isset($_GET['tmpl']) && intval($_GET['tmpl']) ) ? $_GET['tmpl'] : 1;
         
         $file = '';

         switch($tmpl)
         {
            case 1:
                   $file = 'posts';
                   break;
            case 2:
                   $file = 'add_user';
                   break;
         }
         
         //insert template
         include_once 'tmpl/'.$file.'.tmpl.php';
        ?>
	</div>  
   <div id="footer">My name &copy; 2007</div>  
   </div>
 </div><!-- wrapper ends -->
</body>
</html>