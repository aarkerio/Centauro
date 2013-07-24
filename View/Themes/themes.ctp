<?php
foreach ($data as $val) {
         $div = 'div' . $val['Themeblog']['id'];
         echo$this->Gags->ajaxDiv($div);
             
             echo$this->Js->link("Delete", "/admin/themeblogs/delete/{$val['Themeblog']['id']}",
                     array("update" => "container", "loading"=>"Element.show('loading');", 
                             "complete"=>"Element.hide('loading');"), "Are you sure you want to delete this theme and entries associated?")."\n";
             
             echo $val['Themeblog']['title'] ." \n";
             
             echo$this->Js->link("Edit", "/admin/themeblogs/edit/{$val['Themeblog']['id']}",
                     array("update" => $div, "loading"=>"Element.show('loading');", "complete"=>"Element.hide('loading');")) ."<br />\n";
                  
        echo $this->Gags->divEnd($div);
}
?>
