<?xml version="1.0"?> 
	 	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
	 	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs"> 
	 	<head> 
  <?php
    if ( isset($javascript) ):
          echo $this->Html->charsetTag('UTF-8');
          echo $this->Html->script('prototype');
          echo $this->Html->script('myfunctions');
          echo $this->Html->script('scriptaculous.js?load=effects');
     endif;
?>

	 	    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	 	    <meta http-equiv="content-language" content="cs" /> 
	 	    <meta name="robots" content="all,follow" />
 	      <meta name="author" content="All: ... [Nazev webu - www.url.cz]; e-mail: info@url.cz" /> 
	 	    <meta name="copyright" content="Design/Code: Vit Dlouhy [Nuvio - www.nuvio.cz]; e-mail: vit.dlouhy@nuvio.cz" /> 
	 	     
	 	    <title> <?php echo $title_for_layout?> </title> 
	 	    <meta name="description" content="..." /> 
	 	    <meta name="keywords" content="..." /> 
	 	     
	 	    <link rel="index" href="./" title="Home" /> 
	 	    <link rel="stylesheet" media="screen,projection" type="text/css" href="/css/rubyx/rubyx.css" /> 
	 	    <link rel="stylesheet" media="print" type="text/css" href="/css/rubyx/rubyx_print.css" /> 
	 	    <link rel="stylesheet" media="aural" type="text/css" href="/css/rubyx/rubyx_aural.css" /> 
	 	</head> 
	 	 
	 	<body id="www-url-cz"> 
	 	 
	 	<!-- Main --> 
	 	<div id="main" class="box"> 
	 	 
	 	    <!-- Header --> 
	 	    <div id="header"> 
	 	      <!-- user_name_blog --> 
	 	      
	 	      <h1 id="logo">
				<?php echo $this->Html->link($blog[0]["User"]["name_blog"], '/blog/'.$blog[0]["User"]["username"], array('title'=>$blog[0]["User"]["name_blog"]) ); ?>
				</h1> 
	 	      <div id="quote"><?php echo $blog[0]["User"]["quote"] ?></div> 
	 	       <hr class="noscreen" />           
	 	      
	 	        <!-- Quick links --> 
	 	        <div class="noscreen noprint"> 
	 	            <p><em>Quick links: <a href="#content">content</a>, <a href="#tabs">navigation</a>, <a href="#search">search</a>.</em></p> 
	 	            <hr /> 
	 	        </div> 
	 	 
	 	        <!-- Search --> 
	 	        <div id="search" class="noprint"> 
	 	            <form action="/entries/search" method="post"> 
	 	             <input type="hidden" name="user_id" value="<?php echo $blog[0]["User"]["id"] ?>" /> 
	 	                <fieldset><legend>Search</legend> 
 	                    <label><span class="noscreen">Find:</span> 
 	                    <span id="search-input-out"><input type="text" name="" id="search-input" size="30" /></span></label> 
	 	                    <input type="image" src="/css/rubyx/design/search_submit.gif" id="search-submit" value="OK" /> 
	 	                </fieldset> 
 	            </form> 
 	        </div> <!-- /search --> 
 	 
	 	    </div> <!-- /header --> 
	 	 
	 	     <!-- Main menu (tabs) --> 
	 	     <div id="tabs" class="noprint"> 
 	            <h3 class="noscreen">Navigation</h3> 
 	            <ul class="box"> 
 	            <?php 
 	                $url = substr($_SERVER['argv'][0], 4, 10); 
 	                 echo ($url == 'users/blog') ? '<li id="active">' : '<li>'; ?>  
 	                <a href="/users/blog/<?php echo $blog[0]["User"]["id"] ?>">eduBlog<span class="tab-l"></span><span class="tab-r"></span></a></li> 
 	                 
 	                <?php echo ($url == 'lessons/port') ? '<li id="active">' : '<li>'; ?> 
 	                <a href="/lessons/portfolio/<?php echo $blog[0]["User"]["id"] ?>">Portfolio<span class="tab-l"></span><span class="tab-r"></span></a></li> 
 	                 
 	                <?php echo ($url == 'users/abou') ? '<li id="active">' : '<li>'; ?> 
 	                <a href="/users/about/<?php echo $blog[0]["User"]["id"] ?>">About Me<span class="tab-l"></span><span class="tab-r"></span></a></li> 
	 	                 
	 	                <?php echo ($url == 'messages/c') ? '<li id="active">' : '<li>'; ?> 
 	                <a href="/messages/message/<?php echo $blog[0]["User"]["id"] ?>">Contact<span class="tab-l"></span><span class="tab-r"></span></a></li> 
 	            </ul> 
	 	        <hr class="noscreen" /> 
	 	     </div> <!-- /tabs --> 
	 	 
 	    <!-- Page (2 columns) --> 
	 	    <div id="page" class="box"> 
 	    <div id="page-in" class="box"> 
	 	 
	 	        <div id="strip" class="box noprint"> 
 	 
	 	            <!-- RSS feeds --> 
	 	            <p id="rss"><strong>RSS:</strong> <a href="/entries/rss/<?php echo $blog[0]["User"]["id"] ?>">articles</a> / <a href="/podcast/rss/<?php echo $blog[0]["User"]["id"] ?>">Podcast</a></p> 
	 	            <hr class="noscreen" /> 
	 	 
	 	            <!-- Breadcrumbs --> 
	 	            <p id="breadcrumbs">You are here: <a href="#">eduBlog</a> &gt; <a href="#">Category</a> &gt;  <strong>Page</strong></p> 
	 	            <hr class="noscreen" /> 
	 	             
	 	        </div> <!-- /strip --> 
	 	 
	 	        <!-- Content --> 
	 	        <div id="content"> 
	 	 
	 	           <?php echo $content_for_layout ?> 
	 	            
	 	        </div> <!-- /content --> 
	 	 
	 	        <!-- Right column --> 
	 	        <div id="col" class="noprint"> 
	 	            <div id="col-in"> 
	 	<div class="temas"><?php echo $blog[0]["User"]["username"] ?> profile</div> 
	 	<p><?php echo "<p>".$blog[0]["User"]["cv"] ?> </p> 
	 	<p style="text-align:center"> 
	 	    <?php echo $this->Html->image('avatars/'.$blog[0]["User"]["avatar"], array('alt'=>$blog[0]["User"]["username"], 'title'=>$blog[0]["User"]["username"])) ?> 
	 	</p> 
	 	 
	 	 
	 	<?php  
	 	 
	 	if ( $blog[0]["Lesson"] != null) 
	 	{ 
	 	     echo $this->renderElement('lesson', $blog[0]["Lesson"]);  
	 	} 
	 	 
	 	if ( $blog[0]["Podcast"] != null ) 
	 	{ 
	 	     echo $this->renderElement('podcast', $blog[0]["Podcast"]);  
	 	} 
	 	 
	 	if ( $blog[0]["Catfaq"] != null ) 
	 	{ 
	 	     echo $this->renderElement('catfaqs', $blog[0]["Catfaq"]);  
	 	} 
	 	 
	 	if ( $blog[0]["Acquaintance"] != null) 
	 	{ 
	 	     echo $this->renderElement('acquaintances', $blog[0]["Acquaintance"]);  
	 	}
    
	 	if ( $blog[0]["Vclassroom"] != null) 
	 	{ 
	 	     echo $this->renderElement('vclassrooms', $blog[0]["Vclassroom"]);  
	 	}
		
	 	if ( !$Auth->sessionValid() ) 
	 	{  
	 	    echo "<p style=\"text-align:center;margin:35px 0 35px 0\">" . $this->Html->link($this->Html->image('static/login.png', array('alt'=>'Login', 'title'=>'Login')), '/users/login', false, false, null) . "</p>"; 
	 	} 
	 	?> 
 	 
	 	<div class="temas">Powered by:</div> 
	 	<div style="text-align:center;padding-top:15px"><a href="http://www.chipotle-software.com/index.php?id=9/"> 
	 	      <img src="/img/static/karamelo_logo.jpg" alt="Karamelo" title="Karamelo" />  
	 	</a> 
 	             
	 	            </div> <!-- /col-in --> 
	 	        </div> <!-- /col --> 
	 	 
	 	  </div> <!-- /page-in --> 
	 	  </div> <!-- /page --> 
	 	 
 	    <!-- Footer --> 
 	    <div id="footer"> 
 	        <div id="top" class="noprint"><p><span class="noscreen">Back on top</span> <a href="#header" title="Back on top ^">^<span></span></a></p></div> 
	 	        <hr class="noscreen" /> 
	 	         
	 	        <p id="createdby">created by <a href="http://www.nuvio.cz">Nuvio | Webdesign</a> <!-- DONT REMOVE, PLEASE! --></p> 
 	         
 	        <p id="copyright">Chipotle Software &copy; 2002-2009. Creative Commons. Some rights reserved.</p> 
	    </div> <!-- /footer --> 
 
 	</div> <!-- /main --> 
 
 	</body> 
</html> 
