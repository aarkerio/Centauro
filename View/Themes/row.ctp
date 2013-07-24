<?php
//exit(print_r( $data ));
  
echo $this->Form->create('/admin/themeblogs/edit/','#', array("onsubmit"=>"return false"));

echo $this->Form->hidden('Themeblog/id', $data["Themeblog"]["id"]);
?>
<fieldset>
<legend>Edit Theme</legend>
<?php  
       $div = 'div' . $data["Themeblog"]["id"];
        echo$this->Js->link("Cancel", "/admin/themeblogs/cancel/{$data['Themeblog']['id']}",
                     array("update" => $div, "loading"=>"Element.show('loading');", "complete"=>"Element.hide('loading');")) ."<br />\n";
       echo $this->Form->input('Themeblog/title', array('size' => 40, 'maxlength' => 100, "value"=>$data["Themeblog"]['title'])); 
       echo $this->Form->error('Themeblog/title', 'Title is required.'); 
       
       echo $this->Js->submit('Update', array("url" => "/admin/themeblogs/edit", 
                                     "update"=>$div,
                                     "loading" => "Element.hide($div);Element.show('loading')",
                                     "complete" => "Element.hide('loading');Effect.Appear($div)"
        ));
?> 
</form>
