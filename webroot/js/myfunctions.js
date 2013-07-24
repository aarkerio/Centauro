// Chipotle software GPLv3
window.onload = init;
var logged = false;

function timedMsg()
{
  if (document.getElementById('flashMessage'))
  {
      $('#flashMessage').slideDown('slow').delay(3000).fadeOut('slow');
  }
}

function init() 
{
    //Check log
    if (!logged) 
    {   
        createCookie("karamelo_first", "first", 999999)
        return;   
    }
}

//cookie setting junk
function createCookie(name,value,days)
{
  if (days) 
  { 
     var date = new Date();
     date.setTime(date.getTime()+(days*24*60*60*1000));
     
     var expires="; expires="+date.toGMTString();
  }
  else
  { 
     expires="";
  }
  document.cookie=name+"="+value+expires+"; path=/; domain=mononeurona.org";
} 

function ocultar() 
{
     var Cover = document.getElementById('cover');
     var Login = document.getElementById('loginpopup');
     
     Cover.style.display = "none";
     Login.style.display = "none";          
}

function hide () {for (i = 0; i < arguments.length; i++) {var e = $(arguments[i]); if (e) e.style.display = "none";}}
function show () {for (i = 0; i < arguments.length; i++) {var e = $(arguments[i]); if (e) e.style.display = "";}}

function mod() {
    if (!logged) {
        offset = window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop;
        
        $('cover').style.top = offset + 'px';
        $('loginpopup').style.top = 100 + offset + 'px';
        show("cover");
        show("loginpopup");

        return;
    }
}

function validateVote(vote) {
        
   valid = false;

   // Opera 5.05 Linux does not support for/in on this object
   for ( var i = 0; i <  vote.length; i++ ) {
      if ( vote[i].checked ) {
         valid = true;
         break;
      }
   }
   if ( ! valid ) {
      alert("You must choose one");
   }
   return valid;
}

function showhide(a)
{
	var Div = document.getElementById(a);
  
 	if (Div.style.display == "none") {
   	     Div.style.display = "block";
 	}	else { 
   	    Div.style.display = "none";
  }
}

function showHiden(d) // Webquest add form
{
	var Div = document.getElementById(d);
    
    var img = document.getElementById('img_' + d);
    //alert(img);
 	if (Div.style.display == "none") {
   	     Div.style.display = "inline";
         img.src = '/img/actions/hide.gif';
 	}	else {
   	    Div.style.display = "none";
        img.src = '/img/actions/show.gif';
  }
  return false;
}


function mostrar(a) {
  
  var List = document.getElementById(a);
  
  var Div = document.getElementById('invi_code');
  
  //alert(List.value);
  
 	if (List.value == 5) 
  {
   	     Div.style.display = "block";
 	}	else { 
   	    Div.style.display = "none";
  }
}

function validatecode() {
   
   var code = document.getElementById("VclassmemberCode").value; 
   
   var invi = document.getElementById("hinvi").value;
   
   //alert(code + invi);
   
   if (invi == 1) 
   {
      if ( !code || code == '' ) 
      {
         alert("You must type the code");
         return false;
       }
   }
   return true;
}

function voteUpNode(idnew, karma) {
                //alert('node_votes_' + idnew);
		$('nodes_votes_' + idnew).innerHTML = '<img src="/img/socialnet/vote_loader.gif" />';
                
		var url = '/news/addvote/'+ idnew + '/' + karma;
		var pars = '&id=9';
		wait(500)
		new Ajax.Request(url,
        {
        method:'get',
        parameters:  pars, 
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

function setWayding() 
{
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


function wait(msecs) {
    var start = new Date().getTime();
    var cur = start
    while(cur - start < msecs)  {
       cur = new Date().getTime();
    }
}


function validateUser() {
    
    var group     = document.getElementById('UserGroupId');
    var code      = document.getElementById('UserCode');
    var username  = document.getElementById('UserUsername');
    var name      = document.getElementById('UserName');
    var passwd    = document.getElementById('UserPasswd');
    var email     = document.getElementById('UserEmail');
    
    if (username.value.length < 6) 
    {
         alert("Login must have at least six characters");
         username.focus();
         return false;
    }    
    
    if (name.value.length < 6) 
    {
         alert("Type your name and last name");
         name.focus();
         return false;
    }    
 
    
    if (email.value.length < 3) 
    {
         alert("You must type an email");
         email.focus();
         return false;
    }
    
    var check = validate_email(email.value);
    
    if (check == false)
    {
         alert("Email is not valid");
         passwd.focus();
         return false;
    }
    
    if (passwd.value.length < 6) 
    {
         alert("Password must have at least six characters");
         passwd.focus();
         return false;
    }    
    
   //alert(code + invi);
   
   if (group.value == 5) 
   {
      if ( !code || code.value.length < 4 ) 
      {
         alert("You must type the code");
         code.focus();
         return false;
       }
   }
   return true;
}

function validate_email(email) {
    
 with (email)
 {
  var apos   = email.indexOf("@");
  var dotpos = email.lastIndexOf(".");

     if (apos < 1|| dotpos-apos < 2) 
     {
        return false;
     } else {
        return true;
     }
 }
}


