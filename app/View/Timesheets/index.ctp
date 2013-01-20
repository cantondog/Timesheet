<div class="timesheets index">
	<?php if((!isset($current_dept)) && ($current_user['role'] != 'regular')): ?>
		<?php
		echo $this->Form->create('Department');
		echo $this->Form->input('department_id', array('label' => 'Choose Department', 'id' => 'DeptSelect'));
		echo $this->Form->end();
	?>
	<?php endif; ?>
	<?php if($current_user['role'] == 'regular'): ?>
		<h2><?php echo __('Timesheets Not Started'); ?></h2>
		<table cellpadding="0" cellspacing="0" class="table table-condensed table-striped">
		<tr>
				<th>Period Start Date</th>
				<th>Period End Date</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($current_user_masters as $timesheet): ?>
		<tr>
			<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Master']['period_start_date'])); ?>&nbsp;</td>
			<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Master']['period_end_date'])); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Start'), array('action' => 'add', $timesheet['Master']['id']), array('class' => 'btn btn-mini')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
		<h2><?php echo __('Saved Timesheets'); ?></h2>
		<table cellpadding="0" cellspacing="0" class="table table-condensed table-striped">
		<tr>
				<th>Period Start Date</th>
				<th>Period End Date</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($saved_timesheets as $timesheet): ?>
		<tr>
			<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Timesheet']['period_start_date'])); ?>&nbsp;</td>
			<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Timesheet']['period_end_date'])); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Continue'), array('action' => 'edit', $timesheet['Timesheet']['id']), array('class' => 'btn btn-mini')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
		<div id="approvedSheetsDiv">
			<h4><?php echo __('Approved Timesheets'); ?></h4>
			<table cellpadding="0" cellspacing="0" class="table table-condensed table-striped">
			<tr>
					<th>Period Start Date</th>
					<th>Period End Date</th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
			foreach ($closed_sheets as $timesheet): ?>
			<tr>
				<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Timesheet']['period_start_date'])); ?>&nbsp;</td>
				<td><?php echo h($this->Time->format("m-d-Y",$timesheet['Timesheet']['period_end_date'])); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $timesheet['Timesheet']['id']), array('class' => 'btn btn-mini')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</table>
		</div>
	<?php endif; ?>

	<div class="paging">
	</div>
</div>