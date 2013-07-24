<!--
/**
 * Application: Ajax for Centauro 
 * License:     Copyright GPL 2002-2007 
 * Author:   	Manuel Montoya <manuel@mononeurona.org>
 * Package:  	inc
 * Site:     	http://www.mononeurona.org
 */
  
//-->

function hideDiv(Div){ 
	
	var target1 = document.getElementById(Div);
	
	if (target1.style.display=="none") {
		
		target1.style.display="block";
		
	} else {
		
		target1.style.display="none";
		
	}
}

function showhide(divuno, divdos){
	
	var target1 = document.getElementById(divuno);
	
	var target2 = document.getElementById(divdos);
	
	if (target1.style.display=="none") {
		
		target1.style.display="block";
		target2.style.display="none";
		
	} else {
		
		target1.style.display="none";
		target2.style.display="block";
		
	}
}


function addComment(comment, id_entrada, id_user, nivel, id_coment, ip) {
  
  xmlhttp = getXmlhttp();
  
  var comentario = document.getElementById(comment).value;
  
  var URL = "/inc/coments_blogs.inc.php";
  
  if ( comentario != "" )  {
	 
     var variables =  'comentario=' + comentario + '&id_entrada=' + id_entrada + '&id_user=' + id_user + '&nivel=' + nivel + '&id_coment=' + id_coment + '&ip=' + ip;
     
	 // open takes in the HTTP method and url.  
     xmlhttp.open("POST", URL, true);
	  //Esto es necesario para enviar post en español
	 xmlhttp.setRequestHeader("Content-type", "text/xml;charset=utf-8");
	 xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.setRequestHeader("Content-length", variables.length);
     
	 //alert(variables);
     xmlhttp.send(variables);
	 
	 	/* The callback function */
	 xmlhttp.onreadystatechange = function() {
			
			// if xmlhttp shows "loaded"
			if (xmlhttp.readyState == 4) {
				   // if "OK"
				   if (xmlhttp.status == 200) {
				        // alert(variables);
						getComments(id_entrada);
				   }
		    }
	 }
	 	 
     } else {
			
        alert('Mmmm, parece que el comentario esta vacio!\n Debes escribir algo (preferentemente, algo inteligente) ;-)');
     }
}

 function getComments(id_entrada) {
	 	    
	        xmlhttp = getXmlhttp();
			
	        var URLtoXML  = "/inc/coments-xml.inc.php";
			var variables = "id_entrada=" + id_entrada;
			//alert(variables);
			
		    xmlhttp.open('POST', URLtoXML, true);	// request XML from PHP with AJAX call
			xmlhttp.setRequestHeader("Content-type", "text/xml;charset=utf-8");
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.setRequestHeader("Content-length", variables.length);
			
			xmlhttp.send(variables);
			
			xmlhttp.onreadystatechange = function () {
				
				if (xmlhttp.readyState == 4) {
					
					var divcoments = 'divcoments' + id_entrada;
					
					var xmlDoc = xmlhttp.responseXML;
					
					var renglon_nodos = xmlDoc.getElementsByTagName("renglon");
					
					var n_nodos = renglon_nodos.length;
					
					// alert("Los nodos son: " +  n_nodos)
					
					var insertData = '';
					
					if (renglon_nodos.length > 0 ) {
						
						for (var i = 0; i <  n_nodos; i++) { // cycle thru fechas
							     
								 var id    = renglon_nodos[i].getElementsByTagName("id");
								 
								 var coment = renglon_nodos[i].getElementsByTagName("coment");
								
								 var fecha = renglon_nodos[i].getElementsByTagName("fecha");
									 
								 id      = id[0].firstChild.nodeValue;
								 fecha   = fecha[0].firstChild.nodeValue;
								 coment  = coment[0].firstChild.nodeValue;
								 
								 insertData += '<div class="entrada_fecha">'+ fecha +'</div><div class="cuerpo_comentario">' + coment + '</div>';
								 
						}
						
						insertData += '<br />';
						insertData += '<p><img src="/images/up-arrow.gif" onclick="showhide(\'divcoments' + id_entrada + '\', \'see' + id_entrada+'\')" alt="Ocultar comentarios" title="Ocultar comentarios" /><br /></p>';
						
					} 
					 document.getElementById(divcoments).innerHTML = insertData;
				}
			}
			
	}

function getXmlhttp() {
  
  try { 
	
	// Moz supports XMLHttpRequest. IE uses ActiveX
	// browser detction is bad. object detection works for any browser  
        xmlhttp = window.XMLHttpRequest?new XMLHttpRequest():
		
        new ActiveXObject("Microsoft.XMLHTTP"); 
    } 
	
    catch (e) {
		   
           alert('Sorry, your browser doesn\'t support ajax');  
		   exit;
    }
	
	return xmlhttp;
}

function mouse_event(obj, newClass) {
                obj.className = newClass;
 }

 function verForma(){
      
      var MyDiv = document.getElementById('recover');
      //alert(MyDiv.style.display);
      if ( MyDiv.style.display=="" )
                 MyDiv.style.display="block";
      else
	         MyDiv.style.display="";
 }

function checkSpam() {
   
   var suma   = document.getElementById("suma").value;
   var summa  = document.getElementById("summa").value;
   
   if ( suma != summa ) 
   { 
      alert('Tu suma es incorrecta') 
      summa.focus();
      return false;
   }

 return true; 
}

function voteUpNode(idnew, karma) {
        //alert('node_votes_' + idnew);
		$('nodes_votes_' + idnew).innerHTML = '<img src="/img/socialnet/vote_loader.gif" />';
        
		var url = '/inc/vote.inc.php';
		var pars = 'idnew=' + idnew + '&karma=' + karma;
		wait(500)
		new Ajax.Request(url,
        {
        method:'get',
        parameters:   pars, 
        asynchronous: true,
        onSuccess: function(transport){
        var response = transport.responseText || "no response text";
        //alert("Success! \n\n" + response);
        
        $('nodes_votes_' + idnew).innerHTML = response;
        
        $('bottoms_' + idnew).innerHTML = '<img src="/img/socialnet/boton_positivo_off.gif" /> <img src="/img/socialnet/boton_negativo_off.gif"  />';
        }, 
        onFailure: function() { 
        alert('Something went really wrong...') 
        }
       });
	}

function setWayding() {
        //alert('node_votes_' + idnew);
        
        var wayding = $F('fielwad').escapeHTML();
		
        if (wayding.length < 6 || wayding == 'Que estas haciendo?')
        {
            alert('Debes escribir algo, (preferentemente, algo inteligente) ;-)');
            return false;
        }
        //alert(wayding);
        $('wayding').innerHTML = '<img src="/images/6-1.gif" alt="wait" />';
        
		var url = '/inc/wayding.inc.php';
		var pars = 'task=' + wayding;
		wait(500)
		new Ajax.Request(url,
        {
        method:'post',
        parameters:   pars, 
        asynchronous: true,
        onSuccess: function(transport){
        var response = transport.responseText || "no response text";
        //alert("Success! \n\n" + response);
        
        $('divwayding').innerHTML = response;
        //$('wayding').innerHTML    = "hidden";
        $('wayding').innerHTML = '';
        }, 
        onFailure: function() { 
        alert('Something went really wrong...') 
        }
       });
	}

function espera()
{
var rt =9;
return rt;
}
function limpia(){
   
   var current = document.getElementById('fielwad');
   
   if (current.value == 'Que estas haciendo?') 
   {
      //current.value = '';
      current.reset();
   }
}
function wait(msecs)
{
var start = new Date().getTime();
var cur = start
while(cur - start < msecs)
{
cur = new Date().getTime();
}
}

function toggleVisibility(m) {
        
        var me = document.getElementById(m);
        
		if (me.style.visibility=="hidden")
        {
			me.style.visibility="visible";
		} else {
			me.style.visibility="hidden";
		}
  }

function swap(session_name, session_id) {
                 
           var img = document.getElementById('kcaptcha');
           
           img.src = '/inc/kcaptcha/index.php?'+ session_name +'=' + session_id +'2';
           
           document.getElementById('otherimg').disabled = true;
           document.getElementById('otherimg').style.backgroundColor = '#fff';
           document.getElementById('otherimg').style.fontColor = '#fff';
           document.getElementById('otherimg').style.borderColor = '#fff';
}

