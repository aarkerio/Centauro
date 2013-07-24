<style type="text/css"> 
.searchbox {
 padding: 3px;
 margin: 23px 0;
 font-size:8pt;
}
</style>
<?php
 $st = __('Search', True) . '...';
?>
<!-- Search -->
<?php
 echo $this->Html->div('searchbox');
 echo $this->Form->create('Entry', array('action'=>'search', 'onsubmit'=>'return chkSearch()'));
 echo $this->Form->input('Entry.username', array('value'=>$username,'type' => 'hidden'));
 echo $this->Form->input('Entry.terms', array('label'=>False,'size' => 12, 'value'=>$st, 'maxlength' => 40, 'onblur' => 'obF()',  'onfocus'=> 'onF()'));
 echo $this->Form->end(__('Send', True));
 echo '</div> <!-- /search -->';
?>
<script type="text/javascript">
//<![CDATA[
function chkSearch()
{ 
   var terms  = document.getElementById('EntryTerms');
   if (terms.value.length < 3)
   {
     alert('<?php __('The search must have three letters at least'); ?>');
     terms.focus();
     return false;
   }
   if (terms.value == '<?php echo $st; ?>')
   {
      alert('Dou you feel tautologic today? ;-)');
      terms.focus();
      return false;
   } 
    return true;
 }

 function obF()
 {
   var terms  = document.getElementById("EntryTerms");
   if (terms.value.length < 1)
   {
      terms.value= '<?php echo $st; ?>';
      return false;
   }
}

 function onF()
 {
   var terms  = document.getElementById("EntryTerms"); 
   terms.value= '';
   return false;
 }

 //]]>
</script>
