
<div style="width:800px;margin:10px auto 0 auto;text-align:center">
<?php echo $this->Html->link($this->Html->image('admin/new_user.jpg', array('alt'=>"MonoNeurona.org", 'title'=>"MonoNeurona.org")), '/',null, null, false); ?>
Para cambiar de nickname: /messages/chat/<span style="color:red">nickname</span><br />

<applet code="IRCApplet.class" archive="irc.jar,pixx.jar" codebase="http://www.mononeurona.org/files/pjirc/" width="700" height="500">
<param name="CABINETS" value="irc.cab,securedirc.cab,pixx.cab">

<param name="nick" value="<?php echo $nick; ?>">
<param name="alternatenick" value="Fulano anonimo">
<param name="name" value="<?php echo $nick; ?>">
<param name="host" value="kubrick.freenode.net">
<param name="gui" value="pixx">
<param name="quitmessage" value="Ahi se ven!">
<param name="command1" value="join #mononeurona.org">

<param name="style:bitmapsmileys" value="true">
<param name="style:smiley1" value=":) img/sourire.gif">
<param name="style:smiley2" value=":-) img/sourire.gif">
<param name="style:smiley3" value=":-D img/content.gif">
<param name="style:smiley4" value=":d img/content.gif">
<param name="style:smiley5" value=":-O img/OH-2.gif">
<param name="style:smiley6" value=":o img/OH-1.gif">
<param name="style:smiley7" value=":-P img/langue.gif">
<param name="style:smiley8" value=":p img/langue.gif">
<param name="style:smiley9" value=";-) img/clin-oeuil.gif">
<param name="style:smiley10" value=";) img/clin-oeuil.gif">
<param name="style:smiley11" value=":-( img/triste.gif">
<param name="style:smiley12" value=":( img/triste.gif">
<param name="style:smiley13" value=":-| img/OH-3.gif">
<param name="style:smiley14" value=":| img/OH-3.gif">
<param name="style:smiley15" value=":'( img/pleure.gif">
<param name="style:smiley16" value=":$ img/rouge.gif">
<param name="style:smiley17" value=":-$ img/rouge.gif">
<param name="style:smiley18" value="(H) img/cool.gif">
<param name="style:smiley19" value="(h) img/cool.gif">
<param name="style:smiley20" value=":-@ img/enerve1.gif">
<param name="style:smiley21" value=":@ img/enerve2.gif">
<param name="style:smiley22" value=":-S img/roll-eyes.gif">
<param name="style:smiley23" value=":s img/roll-eyes.gif">
<param name="style:floatingasl" value="true">

<param name="pixx:highlight" value="true">
<param name="pixx:highlightnick" value="true">

</applet>

</div>
