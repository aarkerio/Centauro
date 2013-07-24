// Chipotle software GPLv3

function addTag(tag)
{
  var newTag = tag + ', ';
  
  var t       = document.getElementById('EntryTags');
  
  var current = t.value;
  
  var check = current.search(tag);
  
  if (check != -1) 
  {
         alert('Tag already exist');
         return false;
  } 
  
  var forma = document.getElementById('forma');
  
  t.parentNode.removeChild(t);
  
  var upc =document.createElement("input");
  upc.type       = "text";
  upc.readOnly   = true;
  upc.size       = 100;
  upc.maxlength  = 120;
  upc.value      = current + newTag;
  upc.name       = 'data[Entry][tags]';
  upc.id         = 'EntryTags'; 
      
  //forma.appendChild(upc);
  document.getElementById('nuevo').appendChild(upc);
      
  //alert(upc.value);
}

function validateEntry() 
{
   
   var EntryTitle = document.getElementById("EntryTitle"); 
   
   var EntryBody = document.getElementById("EntryBody");
   
   if (EntryTitle.value.length < 1) 
   {
         alert("You must type a title");
         return false;
   }
   
   if (EntryBody.value.length < 3) 
   {
         alert("You must type the entry's body");
         return false;
   }  
   return true;
}

function onok() {
		// Get the image tag field information
		var url		= this.fields.url.getValue();
		var alt		= this.fields.alt.getValue();
		var align	= this.fields.align.getValue();
		var title	= this.fields.title.getValue();
		var caption	= this.fields.caption.getValue();

		if (url != '') {
			// Set alt attribute
			if (alt != '') {
				var alt = "alt=\""+alt+"\" ";
			}
			// Set align attribute
			if (align != '') {
				align = "align=\""+align+"\" ";
			}
			// Set align attribute
			if (title != '') {
				title = "title=\""+title+"\" ";
			}
			// Set align attribute
			if (caption != '') {
				caption = 'class="caption"';
			}

			var tag = "<img src=\""+url+"\" "+alt+align+title+caption+" />";
		}

		window.parent.jInsertEditorText(tag);
		return false;
	}
    
function timedMsg()
{
  if (document.getElementById('flashMessage'))
    var t=setTimeout("document.getElementById('flashMessage').style.display = 'none'", 2000);
}
