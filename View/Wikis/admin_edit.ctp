<script type="text/javascript">
/*<![CDATA[*/
var drWikiEditor='tx_drwiki_pi1[body]'; //Handler for Editor
// dr_Wiki JavaScript support functions
// if this is true, the toolbar will no longer overwrite the infobox when you move the mouse over individual items

var noOverwrite=false;
var alertText;
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var is_gecko = ((clientPC.indexOf('gecko')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('khtml') == -1) && (clientPC.indexOf('netscape/7.0')==-1));
var is_safari = ((clientPC.indexOf('AppleWebKit')!=-1) && (clientPC.indexOf('spoofer')==-1));
var is_khtml = (navigator.vendor == 'KDE' || ( document.childNodes && !document.all && !navigator.taintEnabled ));
if (clientPC.indexOf('opera')!=-1) {
    var is_opera = true;
    var is_opera_preseven = (window.opera && !document.childNodes);
    var is_opera_seven = (window.opera && document.childNodes);
}

// add any onload functions in this hook (please don't hard-code any events in the xhtml source)
function onloadhook () {
    // don't run anything below this for non-dom browsers
    if(!(document.getElementById && document.getElementsByTagName)) return;
    akeytt();
}
if (window.addEventListener) window.addEventListener("load",onloadhook,false);
else if (window.attachEvent) window.attachEvent("onload",onloadhook);

// this function generates the actual toolbar buttons with localized text
// we use it to avoid creating the toolbar where javascript is not enabled
function addButton(imageFile, speedTip, tagOpen, tagClose, sampleText, key) {

	speedTip=escapeQuotes(speedTip);
	tagOpen=escapeQuotes(tagOpen);
	tagClose=escapeQuotes(tagClose);
	sampleText=escapeQuotes(sampleText);
	key=escapeQuotes(key);
        
	var mouseOver="";

	// we can't change the selection, so we show example texts
	// when moving the mouse instead, until the first button is clicked
	if(!document.selection && !is_gecko) {
		// filter backslashes so it can be shown in the infobox
		var re=new RegExp("\\\\n","g");
		tagOpen=tagOpen.replace(re,"");
		tagClose=tagClose.replace(re,"");
		mouseOver = "onMouseover=\"if(!noOverwrite){document.infoform.infobox.value='"+tagOpen+sampleText+tagClose+"'};\"";
	}

	document.write("<a href=\"javascript:insertTags");
	document.write("('"+tagOpen+"','"+tagClose+"','"+sampleText+"');\" accesskey=\""+key+"\">");
   document.write("<img width=\"23\" height=\"22\" src=\""+imageFile+"\" border=\"0\" alt=\""+speedTip+"\" title=\""+speedTip+"\""+mouseOver+">");
	document.write("</a>");
	return;
}

function addInfobox(infoText,text_alert) {
	alertText=text_alert;
	var clientPC = navigator.userAgent.toLowerCase(); // Get client info

	var re=new RegExp("\\\\n","g");
	alertText=alertText.replace(re,"\n");

	// if no support for changing selection, add a small copy & paste field
	// document.selection is an IE-only property. The full toolbar works in IE and
	// Gecko-based browsers.
	if (!document.selection && !is_gecko) 
   {
 		infoText=escapeQuotesHTML(infoText);
	 	document.write("<form name='infoform' id='infoform'>"+
			"<input size=80 id='infobox' name='infobox' value=\""+
			infoText+"\" readonly='readonly'></form>");
 	}
}

function escapeQuotes(text) {
	var re=new RegExp("'","g");
	text=text.replace(re,"\\'");
	re=new RegExp('"',"g");
	text=text.replace(re,'&quot;');
	re=new RegExp("\\n","g");
	text=text.replace(re,"\\n");
	return text;
}

function escapeQuotesHTML(text) {
	var re=new RegExp('"',"g");
	text=text.replace(re,"&quot;");
	return text;
}

// apply tagOpen/tagClose to selection in textarea,
// use sampleText instead of selection if there is none
// copied and adapted from phpBB
function insertTags(tagOpen, tagClose, sampleText) {

	var txtarea = document.getElementById(drWikiEditor);//('tx_drwiki_pi1[body]');
	// IE
	if(document.selection  && !is_gecko) {
		var theSelection = document.selection.createRange().text;
		if(!theSelection) { theSelection=sampleText;}
		txtarea.focus();
		if(theSelection.charAt(theSelection.length - 1) == " "){// exclude ending space char, if any
			theSelection = theSelection.substring(0, theSelection.length - 1);
			document.selection.createRange().text = tagOpen + theSelection + tagClose + " ";
		} else {
			document.selection.createRange().text = tagOpen + theSelection + tagClose;
		}

	// Mozilla
	} else if(txtarea.selectionStart || txtarea.selectionStart == '0') {
 		var startPos = txtarea.selectionStart;
		var endPos = txtarea.selectionEnd;
		var scrollTop=txtarea.scrollTop;
		var myText = (txtarea.value).substring(startPos, endPos);
		if(!myText) { myText=sampleText;}
		if(myText.charAt(myText.length - 1) == " "){ // exclude ending space char, if any
			subst = tagOpen + myText.substring(0, (myText.length - 1)) + tagClose + " ";
		} else {
			subst = tagOpen + myText + tagClose;
		}
		txtarea.value = txtarea.value.substring(0, startPos) + subst +
		  txtarea.value.substring(endPos, txtarea.value.length);
		txtarea.focus();

		var cPos=startPos+(tagOpen.length+myText.length+tagClose.length);
		txtarea.selectionStart=cPos;
		txtarea.selectionEnd=cPos;
		txtarea.scrollTop=scrollTop;

	// All others
	} else {
		var copy_alertText=alertText;
		var re1=new RegExp("\\$1","g");
		var re2=new RegExp("\\$2","g");
		copy_alertText=copy_alertText.replace(re1,sampleText);
		copy_alertText=copy_alertText.replace(re2,tagOpen+sampleText+tagClose);
		var text;
		if (sampleText) {
			text=prompt(copy_alertText);
		} else {
			text="";
		}
		if(!text) { text=sampleText;}
		text=tagOpen+text+tagClose;
		document.infoform.infobox.value=text;
		// in Safari this causes scrolling
		if(!is_safari) {
			txtarea.focus();
		}
		noOverwrite=true;
	}
	// reposition cursor if possible
	if (txtarea.createTextRange) txtarea.caretPos = document.selection.createRange().duplicate();
}

function akeytt() {
    if(typeof ta == "undefined" || !ta) return;
    pref = 'alt-';
    if(is_safari || navigator.userAgent.toLowerCase().indexOf( 'mac' ) + 1 ) pref = 'control-';
    if(is_opera) pref = 'shift-esc-';
    for(id in ta) {
        n = document.getElementById(id);
        if(n){
            a = n.childNodes[0];
            if(a){
                if(ta[id][0].length > 0) {
                    a.accessKey = ta[id][0];
                    ak = ' ['+pref+ta[id][0]+']';
                } else {
                    ak = '';
                }
                a.title = ta[id][1]+ak;
            } else {
                if(ta[id][0].length > 0) {
                    n.accessKey = ta[id][0];
                    ak = ' ['+pref+ta[id][0]+']';
                } else {
                    ak = '';
                }
                n.title = ta[id][1]+ak;
            }
        }
    }
}

function setupRightClickEdit() {
	if( document.getElementsByTagName ) {
		var divs = document.getElementsByTagName( 'div' );
		for( var i = 0; i < divs.length; i++ ) {
			var el = divs[i];
			if( el.className == 'editsection' ) {
				addRightClickEditHandler( el );
			}
		}
	}
}

function addRightClickEditHandler( el ) {
	for( var i = 0; i < el.childNodes.length; i++ ) {
		var link = el.childNodes[i];
		if( link.nodeType == 1 && link.nodeName.toLowerCase() == 'a' ) {
			var editHref = link.getAttribute( 'href' );
			
			// find the following a
			var next = el.nextSibling;
			while( next.nodeType != 1 )
				next = next.nextSibling;
			
			// find the following header
			next = next.nextSibling;
			while( next.nodeType != 1 )
				next = next.nextSibling;
			
			if( next && next.nodeType == 1 &&
				next.nodeName.match( /^[Hh][1-6]$/ ) ) {
				next.oncontextmenu = function() {
					document.location = editHref;
					return false;
				}
			}
		}
	}
}

function addTemplate ( what, where ) {
    Check = confirm("Insert: \"" + what + "\" ?");
    if (Check == true) document.getElementById(where).value = what;
    return false;
}
/*]]>*/
</script>

<b>Edit: Discussion:dr_wiki</b> (User: Manuel Montoya)<br /><br />

<script type='text/javascript'>
/*<![CDATA[*/
document.writeln("<div id='toolbar'>");
addButton('img/static/button_bold.png','[Alt+Shift+B] Bold text','\'\'\'','\'\'\'','Bold text','B');
addButton('img/static/button_italic.png','[Alt+Shift+I] Italic text','\'\'','\'\'','Italic text','I');
addButton('img/static/button_link.png','[Alt+Shift+L] Internal link','[[',']]','Link title','L');
addButton('img/static/button_extlink.png','[Alt+Shift+X] External link (remember http:// prefix)','[',']','http://www.example.com link title','X');
addButton('img/static/button_headline.png','[Alt+Shift+H] Level 2 headline','\n== ',' ==\n','Headline text','H');
addButton('img/static/button_hr.png','[Alt+Shift+R] Horizontal line (use sparingly)','\n----\n','','','R');
addButton('img/static/button_sig.png','Add signature + date (discussions only)','\n--~~~~\n','','','S');
addButton('img/static/button_nowiki.png','[Alt+Shift+N] NoWiki','<nowiki>','</nowiki>','This will not be parsed','N');
addButton('img/static/button_sub.png','Sub','<sub>','</sub>','','D');
addButton('img/static/button_sup.png','Sup','<sup>','</sup>','','U');
addButton('img/static/button_strike.png','Strike Through','<s>','</s>','This text is strike through','');
addInfobox('Click a button to get an example text','Please enter the text you want to be formatted.\n It will be shown in the infobox for copy and pasting.\nExample:\n$1\nwill become:\n$2');
document.writeln("</div>");
/*]]>*/
</script>
<form id="tx_drwiki_pi1_EditForm" name="tx_drwiki_pi1_EditForm" method="post" action="wiki/Discussion%3Adr_wiki/33/edit/">
<input type="Submit" name="tx_drwiki_pi1[submitEdit]" value="Save" accesskey="s" title="[Alt+s] Save" tabindex="2" />
<input type="Submit" name="tx_drwiki_pi1[previewEdit]" value="Preview" accesskey="p" title="[Alt+p] Preview" tabindex="3" />&nbsp;
<input type="reset" value="Reset"> <a href="wiki/Discussion%3Adr_wiki/" >Cancel / Exit</a><br />
<textarea id="tx_drwiki_pi1[body]" name="tx_drwiki_pi1[body]" cols="50" rows="30" wrap="off" accesskey="t" title="[Alt+t]">Aloha</textarea><br />
Summary: 
<input name="tx_drwiki_pi1[summary]" size="50" accesskey="u" title="[Alt+u]" tabindex="1" /><br />
<input type="hidden" name="tx_drwiki_pi1[date]" value="2007-07-04 03:40:30" /><input type="hidden" name="tx_drwiki_pi1[author]" value="Manuel Montoya" />
<input type="hidden" name="tx_drwiki_pi1[cmd]" value="edit" />
<input type="hidden" name="tx_drwiki_pi1[wiki]" value="Discussion:dr_wiki" />
<input type="hidden" name="tx_drwiki_pi1[latest]" value="33" />
<input type="Submit" name="tx_drwiki_pi1[submitEdit]" value="Save" accesskey="s" title="[Alt+s] Save" tabindex="2" />&nbsp;
<input type="Submit" name="tx_drwiki_pi1[previewEdit]" value="Preview" accesskey="p" title="[Alt+p] Preview" tabindex="3" />&nbsp;
<input type="reset" value="Reset"> <a href="wiki/Discussion%3Adr_wiki/" >Cancel / Exit</a></form>
	</div>
