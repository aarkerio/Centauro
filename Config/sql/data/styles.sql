-- CSS blog style by default
INSERT INTO styles (user_id, style) VALUES (0, '
body {
	background: #e7e4e4;
	margin: 0px;
	padding: 0px;
	font-size: 10pt; 
       font-family: Verdana, Arial;
       min-width:900px;
}
a {
color: #3f5673;
font-size: 11pt;
text-decoration:none;
text-align:left;
}

#wrapper {
border:1px solid black;
margin:0 auto 0 auto;
max-width:900px;
background-color: white;
padding:0;
vertical-align:top;
}

img {border:0;text-align:center;}

#headerimg {
    width: 900px;
    height:220px;
    background:url(/img/static/blog-bg-default.jpg); /* You can upload a new header image using Images module */
    margin:0;
    padding:0;
    vertical-align:top;
}

#titulo a {
	font-size: 19pt;
	float: left;
	color: white;
	font-weight: bold;
	margin:30px 0 0 30px;
  padding:30px 0 15px 0;
	}
  
#frase {
  float: left;
	font-size: 11pt;
	text-align: left;
	color: white;
	font-weight: bold;
	margin-left:60px;
	}
#avatar {
	text-align: justify;
	margin-left:auto;
	margin-right:auto;
	width:auto;
	padding:3px;
	font-weight:bold;
	font-size:8pt;
	font-family:courier;
	}

.cuerpo_comentario{
	font-size:11pt;
}

.entrada_permalink {
	padding-top:10px;
	margin-left:0;
	margin-bottom:30px;
	}
  
.entrada_permalink a {font-size:7pt;}	

.entrada_fecha {
	font-size:9pt;
	font-variant: normal;
	text-transform: capitalize;
	font-family: Georgia, Times New Roman, Times, serif;
	font-weight:bold;
}

p {	font-size:10pt;padding:4px;}

.entrada_cuerpo { padding:4px;}

.temas {
margin-top:40px;
margin-bottom:0px;
border-bottom:1px solid black;
text-align:left;
font-weight:bold;
font-family: Palatino, serif;
}

ul {
	font-weight:bold;
	}

h1 {
	font-size:13pt;
	margin:5px;
	font-variant: normal;
}

h3 {
	color:#ea7901;
	margin-top:20px;
  font-size:15pt;
  font-weigth:bold;
  padding:5px 0 0 0;
  border-bottom:1px dotted #8ea442;
  background: #fff url(/img/static/ball-green.gif) no-repeat;
  background-position:bottom right;
	}
h4 {
  color:gray;
	margin:0;
	font-size:10pt;
	font-variant: normal;
	text-transform: capitalize;
	font-family: Georgia, Times New Roman, Times, serif;
}

	
img.imgborder { 
    border:1px solid black;
    margin:2px;
    margin-bottom:0;
}

p.imagen { 
   text-align: center;
   font-size: 11px;
   font-style: italic; 	
  }

p.justificado {
   font-size: 10pt;
   text-align: justify;
   line-height: 130%;
   }

#thin {               /* sidebar */
 vertical-align:top;
 border-right:dotted 1px #c0c0c0;
 width:230px;
 vertical-align:top;
 float:right;
}

#blogger{ /* blogger information */
background: #fff url(/img/static/boxbg.gif) repeat-x;
padding: 1.5em;
margin: 10px 0 1.0em 0;
}

#blog_cv {font-size:7pt;text-align:justify;color:#404040;margin:10px 0 10px 0}
#blog_cv a {font-size:7pt;}
#blog_img {text-align:center;}

#shadow {background: #fff url(/img/static/border1.gif) repeat-x;height:15px;}

#main{            /* main column */
 float:left;
 vertical-align:top;
 width:650px;
}

#main a:hover {border-bottom:1px dotted green}

#paginacion {
margin:15px 0 15px 0;
text-align:center;
color: gray;
font-size:7pt;
}   

#paginacion a {
color: orange;
font-size:7pt;
padding:3px;
}   

#footer{text-align:center;padding:10px;font-size:8pt;margin-top:20px;padding:8px;color:black;clear:both;}
#cc {
 text-align:center;
 padding:15px;
 font-size:6pt;font-weight:bold;
 margin:10px auto 10px auto;
}

.spaced{margin-top:35px;margin-bottom:25px;text-align:center}

#top {text-align:left;margin-left:20px;padding-left:20px}

#rss {
text-align:left;
background: #fff url(/img/static/3d-feed-icon.jpg) no-repeat;
color:red;
font-size:8pt;
height:43px;
padding:15px 0 0 44px;
font-weight:bolder;
}

#rss a{font-size:7pt;text-decoration:none;padding-left:3px;color:#8ea442}
#rss a:hover{border-bottom:1px dotted #8ea442;}

.links a{font-size:7pt;text-decoration:none;padding:3px;color:#cc6600;}
.links a:hover{font-size:7pt;text-decoration:none;padding:3px;background-image:url(/img/static/menu_a_hover.gif);}

/* Formularios*/
code {
	color: #B46233;
	font: 90% "Courier New", Courier, monospace;
}

form {
	margin: 0;
	padding: 0;
}
	
input, textarea {
	background-color: #F8F6F1;
	border: 1px solid #aaa;
	font-size:100%; 
}

input:hover, textarea:hover {
	background: #F0ECE1;
}
/* Holly Hack for IE */
* html .suckertreemenu ul li { float: left; height: 1%; }
* html .suckertreemenu ul li a { height: 1%; }
/* End */

/** PAGINATION ***/

div.pagination {
	padding: 3px;
	margin: 3px;
       font-size:8pt;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #fff;
	text-decoration: none; /* no underline */
        font-size:8pt;
	color: #fe640d;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #fe640d;
	font-weight: bold;
	background-color: #fe640d;
	color: #fff;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #EEE;
	color: #c0c0c0;
}');
