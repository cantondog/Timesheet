<div class="timesheets view">
	<h2><?php  echo __('Submitted Timesheets'); ?></h2>
	<?php echo $this->Form->create('Timesheet', array('action' => 'resolve')); ?>
	<table class="table table-striped table-condensed">
		<tr class="table-headers">
			<th><i class="icon-ok" id="approve-all"></i></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Dates'); ?></th>
			<th><?php echo __('Total Regular'); ?></th>
			<th><?php echo __('Total OT'); ?></th>
			<th><?php echo __('Total PTO'); ?></th>
			<th><?php echo __('Total Holiday'); ?></th>
			<th><?php echo __('Carry Over'); ?></th>
			<th><?php echo __('Action'); ?></th>
		</tr>
		<?php foreach($approved_grid as $sheet): ?>
		<tr class="timesheet-row">
			<td><?php echo $this->Form->checkbox('approve', array('hiddenField' => false, 'class' => 'check-approve', 'value' => $sheet['Timesheet']['id'], 'name' => 'data[Timesheet][approve][]')); ?></td>
			<td><?php echo $sheet['User']['first_name']; ?> <?php echo $sheet['User']['last_name']; ?></td>
			<td><?php echo h($this->Time->format("m-d-Y",$sheet['Timesheet']['period_start_date'])); ?> to <?php echo h($this->Time->format("m-d-Y",$sheet['Timesheet']['period_end_date'])); ?></td>
			<td><?php echo $sheet['Dates']->TotalRegularHours; ?></td>
			<td><?php echo $sheet['Dates']->TotalOT; ?></td>
			<td><?php echo $sheet['Dates']->TotalPTO; ?></td>
			<td><?php echo $sheet['Dates']->TotalHoliday; ?></td>
			<td><?php echo $sheet['Dates']->ot_carryover; ?></td>
			<td>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $sheet['Timesheet']['id']), array('class' => 'btn btn-mini')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php if(($current_user['role'] == "manager") || ($current_user['role'] == "admin")): ?>
	<i id="IconForChecked" class="icon-arrow-up"></i><span class="btn btn-large"><?php echo $this->Html->link(__('Approve Checked'), "#", array('id' => 'ApproveChecked')); ?></span>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>

	<div id="accordion">
		<h4 id="SavedSheets"><?php  echo __('Saved Timesheets'); ?> <span class="badge badge-inverse"><?php echo count($waiting_grid); ?></span></h4>
		<div id="SavedSheetsTable">
			<table class="table table-striped table-condensed">
				<tr class="table-headers">
					<th>&nbsp;</th>
					<th><?php echo __('Name'); ?></th>
					<th><?php echo __('Dates'); ?></th>
					<th><?php echo __('Total Regular'); ?></th>
					<th><?php echo __('Total OT'); ?></th>
					<th><?php echo __('Total PTO'); ?></th>
					<th><?php echo __('Total Holiday'); ?></th>
					<th><?php echo __('Carry Over'); ?></th>
					<th><?php echo __('Action'); ?></th>
				</tr>
				<?php foreach($waiting_grid as $sheet): ?>
				<tr class="timesheet-row">
					<td>&nbsp;</td>
					<td><?php echo $sheet['User']['first_name']; ?> <?php echo $sheet['User']['last_name']; ?></td>
					<td><?php echo h($this->Time->format("m-d-Y",$sheet['Timesheet']['period_start_date'])); ?> to <?php echo h($this->Time->format("m-d-Y",$sheet['Timesheet']['period_end_date'])); ?></td>
					<td><?php echo $sheet['Dates']->TotalRegularHours; ?></td>
					<td><?php //echo $sheet['Dates']->OTHours; ?></td>
					<td><?php echo $sheet['Dates']->TotalPTO; ?></td>
					<td><?php echo $sheet['Dates']->TotalHoliday; ?></td>
					<td><?php echo $sheet['Dates']->ot_carryover; ?></td>
					<td>
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $sheet['Timesheet']['id']), array('class' => 'btn btn-mini')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>