<?php 
echo $this->Html->para(Null, $this->Html->link($this->Html->image('admin/new.gif', array('alt'=>'Add new', 'title'=>'Add new')), '/admin/contacts/add', array('escape'=>False)));

echo '<div style="width:300px;font-size:9pt;border:1px dotted gray;padding:12px">';

        echo "<h1>" . $data['Contact']['title'] . "  ". $data['Contact']['firstname']  . $data['Contact']['lastname'] . "</h1>";
        echo "(" .$data['Contact']['nickname']  . ")<br /><br />";
        echo "<b>Email:</b> "             . $data['Contact']['email1']         . "<br /><br />";
        echo "<b>Additional email:</b> "  . $data['Contact']['email2']         . "<br /><br />";
        echo "<b>Work Phonw:</b> "        . $data['Contact']['workphone']      . "<br /><br />";
        echo "<b>Home Phome:</b> "        . $data['Contact']['homephone']      . "<br /><br />";
        echo "<b>Cell Phone:</b> "        . $data['Contact']['cellphone']      . "<br /><br />";
        echo "<b>Website:</b> "           . $data['Contact']['website']        . "<br /><br />";
        echo "<b>Skype:</b> "             . $data['Contact']['skype']          . "<br /><br />";
        echo "<b>MSN:</b> "               . $data['Contact']['msn']            . "<br /><br />";
        echo "<b>Organization:</b> "      . $data['Contact']['organization']        . "<br /><br />";
        echo "<b>Address:</b> "           . $data['Contact']['address']        . "<br /><br />";
        echo "<b>Birthday:</b> "          . $data['Contact']['birthday']       . "<br /><br />";
        
        echo $this->Gags->sendEdit($data['Contact']['id'], 'contacts');

echo '</div>';

# ? > EOF

