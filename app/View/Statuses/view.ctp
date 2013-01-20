<div class="statuses view">
<h2><?php  echo __('Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($status['Status']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($status['Status']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Status'), array('action' => 'edit', $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Status'), array('action' => 'delete', $status['Status']['id']), null, __('Are you sure you want to delete # %s?', $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Timesheets'); ?></h3>
	<?php if (!empty($status['Timesheet'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Master Id'); ?></th>
		<th><?php echo __('Period Start Date'); ?></th>
		<th><?php echo __('Period End Date'); ?></th>
		<th><?php echo __('Dates'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Approved'); ?></th>
		<th><?php echo __('Submit Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($status['Timesheet'] as $timesheet): ?>
		<tr>
			<td><?php echo $timesheet['id']; ?></td>
			<td><?php echo $timesheet['user_id']; ?></td>
			<td><?php echo $timesheet['master_id']; ?></td>
			<td><?php echo $timesheet['period_start_date']; ?></td>
			<td><?php echo $timesheet['period_end_date']; ?></td>
			<td><?php echo $timesheet['dates']; ?></td>
			<td><?php echo $timesheet['status_id']; ?></td>
			<td><?php echo $timesheet['approved']; ?></td>
			<td><?php echo $timesheet['submit_date']; ?></td>
			<td><?php echo $timesheet['created']; ?></td>
			<td><?php echo $timesheet['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timesheets', 'action' => 'view', $timesheet['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'timesheets', 'action' => 'edit', $timesheet['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'timesheets', 'action' => 'delete', $timesheet['id']), null, __('Are you sure you want to delete # %s?', $timesheet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
