<rss version="2.0">
<channel>
<title>::<?php echo $data[0]["User"]['username']; ?> ToDos::</title>
   <link><?php echo $_SERVER['SERVER_NAME'] ?></link>
   <description><?php echo $data[0]["User"]['username']; ?>'s ToDos::</description>
   <language>es-MX</language>
      <image> 
      <title><?php echo $data[0]["User"]['username']; ?>- Tasks</title>
      <url>http://www.mononeurona.org/img/static/mn-small.png</url>
      <link>http://www.monneurona.org</link>
          <width>100</width>
          <height>71</height>
   </image>

<?php
//entries
//die(var_dump($data)); 

foreach ($data as $v) {  // entries 
    
    $tmp    = substr($v["Todo"]['task'],0,200) . "...";
    $body   = strip_tags($tmp);
?>
 <item>
        <title><?php echo  $v["Todo"]['name']; ?></title>
        <link>http://<?php echo $_SERVER['SERVER_NAME'] ?>/admin/todos/listing</link>
        <comments><?php echo $_SERVER['SERVER_NAME'] ?>/admin/todos/listing</comments>
        <description><![CDATA[<?php echo $body; ?>]]></description>
        <pubDate><?php  echo $v["Todo"]['created'] ?></pubDate>
	      <creator><?php  echo $v["Todo"]['created'] ?></creator>
        <category>ToDo</category>
        <guid><?php echo $_SERVER['SERVER_NAME'] ?>/admin/todos/listing</guid>
    </item>
<?php }   ?> 

</channel>
</rss>
