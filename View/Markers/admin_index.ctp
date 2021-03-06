<div class="actions">
	<h3><?php __('Actions'); ?></h3>
<?php 
 echo $this->Html->link(sprintf(__('New %s', true), __('Marker', true)), array('action' => 'edit')); 
echo '   '.$this->Html->link('View all markers', '/markers/view/');
?>
</div>
<div class="markers index">
	<h2><?php __('Markers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('lat');?></th>
			<th><?php echo $this->Paginator->sort('lng');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
<?php
$i = 0;
foreach ($markers as $marker):
	$class = null;
       if ($i++ % 2 == 0):
			$class = ' class="altrow"';
        endif;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $marker['Marker']['id']; ?>&nbsp;</td>
		<td><?php echo $marker['Marker']['name']; ?>&nbsp;</td>
		<td><?php echo $marker['Marker']['address']; ?>&nbsp;</td>
		<td><?php echo $marker['Marker']['lat']; ?>&nbsp;</td>
		<td><?php echo $marker['Marker']['lng']; ?>&nbsp;</td>
		<td><?php echo $marker['Marker']['type']; ?>&nbsp;</td>
		<td class="actions">
		<?php echo $this->Html->link(__('Edit', True), array('action' => 'edit', $marker['Marker']['id'])); ?>
		<?php echo $this->Html->link(__('Delete', True), array('action' => 'delete', $marker['Marker']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $marker['Marker']['id'])); ?>
		</td>
	</tr>
<?php 
endforeach; ?>
</table>
<p>
<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>