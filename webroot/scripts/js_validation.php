<?php
/**    Manuel Montoya 2007 GPL License 3 **/
?>
<html>
<head>
  <title>JS Validation</title>
</head>
<body>

<script type="text/javascript">
function validateData()
{ 
  var name  = document.getElementById("name");
  var email = document.getElementById("email");
  var age   = document.getElementById("age");
  var agree = document.getElementById("agree");
  
  // alert('I am here');
  
  if (name.value.length < 3)
  {
    alert('The name must have three letters at least');
    name.focus();
    return false;
  }
  
  //check email
  var atpos  = email.value.indexOf("@");    //indexOf find something in your JavaScript string
  var dotpos = email.value.indexOf(".");
  
  //alert('at: ' + atpos);
  
  if ( atpos < 1 || dotpos < 1 || email.value.length < 5) 
  {
    alert('Mmmm, this email ' + email.value + ' does not look as a valid email');
    email.focus();
    return false;
  }
  
  if ( age.selectedIndex == 0 )
  {
	     alert ("Sorry kid: you are too young.");
        return false;
  }
  
  if (agree.checked == false)
  {
    alert('You must sign the contract ;-) ');
    return false;
  }

return true;
}
</script>
<div style="width:50%;padding:10px;margin:0 auto;border:1px solid green;font-size:10pt;font-family:verdana, 'Courier New', monospace">
<form action="#" method="post" onsubmit="return validateData()">
<fieldset>
<legend>New user</legend>
Name : <br />
<input type="text" id="name" name="name" value="" size="30" maxlength="30" /><br />

Email : <br />
<input type="text" id="email" name="email" value="" size="20" maxlength="30" /></br><br />

<select name="age" id="age">
  <option value="0">I am a little child</option>
  <option value="1">I am over 18</option>
</select>
<br /><br />

I do agree with the rules:<input type="checkbox" name="agree" id="agree" value="1" /> <br /><br />

<input type="submit" name="boton" value="Send" />
</fieldset>
</form>

</div>

</body>
</html>
