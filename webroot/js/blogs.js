
function sendLiveChat() {
        
        if ($F('message') == '' || $F('sender_name') == '')
        {
            alert('Debes escribir algo...');
            return false;
        }
        
        $('waiting').innerHTML = '<img src="/images/6-1.gif" alt="wait" />';
        
        var message     = $F('message').escapeHTML();
        var sender_name = $F('sender_name').escapeHTML();
        
		    var url  = '/inc/actions_livechat.inc.php';
        var h     =  $H({ user_id:$F('user_id'), action:'add', message:message, sender_name:sender_name});
        //alert(pars);
		wait(500);
		new Ajax.Request(url,
        {
        method:'post',
        encoding:'UTF-8',
        parameters: h, 
        asynchronous: true,
        onSuccess: function(transport) {
        
        var response = transport.responseText || "no response text";
        //alert("Success! \n\n" + response);
        
        $('messages').innerHTML = response;
        $('waiting').innerHTML = '';
        }, 
        onFailure: function() { 
        alert('Something went really wrong...') 
        }
       });
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

