<table class="main_tabula">

<tr> <td>username</td> <td>Email</td> <td>name</td> <td>last_visit</td></tr>

<?php 
foreach ($users as $key=>$val)
{
  echo '<tr> <td>'. $val['User']['username'] .'</td> <td>'. $val['User']['email'].'</td> <td>'.$val['User']['name'] .'</td> <td>'. $val['User']['last_visit'] .'</td></tr>';
}
?>
</table>
