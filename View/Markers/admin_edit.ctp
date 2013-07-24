<?php
$this->Html->addCrumb('Control Tools', '/admin/entries/start');  
$this->Html->addCrumb('Markers', '/admin/markers/index'); 
echo $this->Html->getCrumbs(' > ');

if (!empty($this->data) && isset($this->data['Marker']['id'])): 
    echo $this->Form->hidden('Entry.id');
    $legend = __('Edit Marker', True);
else:
    $legend = __('New Marker', True);
endif;
?>
<div class="markers form">
<?php echo $this->Form->create('Marker');?>
	<fieldset>
 		<legend><?php printf(__('Admin Edit %s', true), __('Marker', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('lat');
		echo $this->Form->input('lng');
        $types = array('Bar'=>'Bar', 'Restaurante'=>'Restaurante', 'Antro'=>'Antro', 'Congal'=>'Congal');
        echo $this->Form->input('type', array('options'=>$types));
    	echo $this->Form->input('end', array('type'=>'checkbox', 'value'=>'1'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
