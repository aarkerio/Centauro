<?php
/**
*  My Name < @ . >
*  License 2007
**/

function delButton($id, $table)
{
   $b  = '<form action="inc/delete.inc.php" method="post" onsubmit="return confirm(\'are you sure?\')">';
   $b .= '<input type="hidden" name="id" value="'.$id.'" />';
   $b .= '<input type="hidden" name="table" value="'.$table    .'" />';
   $b .= '<input type="submit" value="Delete" />';
   $b .= '</form>';
   
   return $b; 
}

function editButton($id, $tmpl)
{
   $b  = '<form action="index.php" method="get">';
   $b .= '<input type="hidden" name="post_id" value="'.$id.'" />';
   $b .= '<input type="hidden" name="tmpl" value="'.$tmpl    .'" />';
   $b .= '<input type="submit" value="Edit" />';
   $b .= '</form>';
   
   return $b; 
}
?>
