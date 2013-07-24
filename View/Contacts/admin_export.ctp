<?php
$file = '';
#debug($data);
foreach ($data as $val)
{
  $file .= "dn: cn=" . $val['Contact']['firstname'] . " " . $val['Contact']['lastname'] .", mail=" . $val['Contact']['email1'] . "\n";
  $file .= "objectclass: top \n";
  $file .= "objectclass: person\n";
  $file .= "objectclass: organizationalPerson\n";
  $file .= "objectclass: inetOrgPerson\n";
  $file .= "objectclass: mozillaAbPersonAlpha\n";
  $file .= "givenName: " . $val['Contact']['firstname'] . "\n"; 
  $file .= "sn: " . $val['Contact']['lastname'] . "\n";
  $file .= "cn: " . $val['Contact']['firstname'] . " " . $val['Contact']['lastname'] . "\n";
  $file .= "mozillaNickname: " . $val['Contact']['nickname'] . "\n";
  $file .= "mail: " . $val['Contact']['email1'] . "\n";
  $file .= "mozillaSecondEmail: " . $val['Contact']['email2'] . "\n";
  $file .= "modifytimestamp: 0Z\n";
  $file .= "telephoneNumber: " . $val['Contact']['workphone'] . "\n";
  $file .= "homePhone: " . $val['Contact']['homephone'] . "\n";
  $file .= "fax: " . $val['Contact']['fax'] . "\n";
  $file .= "mobile: " . $val['Contact']['cellphone'] . "\n";
  $file .= "homeStreet: " . $val['Contact']['address'] . "\n"; 
  $file .= "mozillaHomePostalCode: " . $val['Contact']['cp'] . "\n";
  $file .= "title: " . $val['Contact']['title'] . "\n";
  $file .= "mozillaHomeUrl: " . $val['Contact']['website'] . "\n\n";
} 

header('Content-Type: text/xml;charset=UTF-8');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Disposition: attachment; filename="' . $username . '_contacts.ldif' . '"');
header('Expires: 0');
header('Pragma: no-cache');

echo $file;
?>

