<div class="masters index">
	<h2><?php echo __('Master Sheets'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('period_start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('period_end_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($masters as $master): ?>
	<tr>
		<td><?php echo h($this->Time->format("m-d-Y",$master['Master']['period_start_date'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format("m-d-Y",$master['Master']['period_end_date'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $master['Master']['id']), array('class' => 'btn btn-mini')); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $master['Master']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $master['Master']['id']), array('class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $master['Master']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging pagination">
		<ul>
			<li><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'current_page')); ?>
			<li><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?></li>
		</ul>
	</div>
</div>
<?php
/**
*<div class="actions">
*	<h3><?php echo __('Actions'); ?></h3>
*	<ul>
*		<li><?php echo $this->Html->link(__('New Master'), array('action' => 'add')); ?></li>
*		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
*	</ul>
*</div>
**/
?>