<div class="markers form">
<?php echo $this->Form->create('Marker');?>
	<fieldset>
 		<legend><?php printf(__('Admin Add %s', true), __('Marker', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('lat');
		echo $this->Form->input('lng');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Markers', true)), array('action' => 'index'));?></li>
	</ul>
</div>