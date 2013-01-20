<div class="timesheets export">
	<h2><?php  echo __('Export Timesheets'); ?></h2>
		<?php echo $this->Form->create('Export'); ?>
		<label for="MasterSelect">Please choose which date you want to export</label>
		<select id="MasterSelect" name="master_select">
			<option value="">Choose Date</option>
			<?php foreach($current_year_masters_list as $key => $master): ?>
			<option value="<?php echo $key; ?>"><?php echo h($this->Time->format("m-d-Y",$master)); ?></option>
			<?php endforeach; ?>
		</select>
		<?php echo $this->Form->end(); ?>
		<?php if($export_sheets): ?>
		<p class="pull-right">
			<button id="btnDownload" class="btn" type="button" rel="<?php echo $this->params['pass'][0]; ?>"><i class="icon-circle-arrow-down"></i> Download This Report</button>
		</p>
		<div class="clearfix"></div>
		<table class="table table-striped table-condensed">
			<tr class="table-headers">
				<!-- <th>&nbsp;</th> -->
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Pay Period'); ?></th>
				<th><?php echo __('Total Hours'); ?></th>
				<th><?php echo __('PTO Taken'); ?></th>
				<th><?php echo __('OT'); ?></th>
				<th><?php echo __('Holiday Hours'); ?></th>
			</tr>
			<?php foreach($export_sheets as $sheet): ?>
				<?php $json_data = json_decode($sheet['Timesheet']['dates']); ?>
				<?php if($sheet['Timesheet']['status_id'] == 7): ?>
					<tr class="timesheet-row">
						<td class="text-left"><?php echo $sheet['User']['first_name']." ".$sheet['User']['last_name']; ?></td>
						<td><?php echo h($this->Time->format("m-d-Y",$sheet['Timesheet']['period_end_date'])); ?></td>
						<td><?php echo $json_data->TotalRegularHours; ?></td>
						<td><?php echo $json_data->TotalPTO; ?></td>
						<td><?php echo $json_data->TotalOT; ?></td>
						<td><?php echo $json_data->TotalHoliday; ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>
</div>