<div class="masters form">
<?php echo $this->Form->create('Master'); ?>
	<fieldset>
		<legend><?php echo __('Edit Master'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('period_start_date');
		echo $this->Form->input('period_end_date');
		echo $this->Form->input('dates');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Master.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Master.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Masters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
	</ul>
</div>
