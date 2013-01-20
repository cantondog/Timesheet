<?php 
$timesheet_data = json_decode($current_timesheet['Master']['dates']);
$total_regular = 0;
$total_holiday = 0;
$total_ot = 0;
$total_pto = 0;
$num_days = count($timesheet_data->dates);
?>
<div class="timesheets form">
<?php echo $this->Form->create('Timesheet'); ?>
	<fieldset>
		<legend><?php echo __('Add Timesheet'); ?></legend>
		<table class="table table-striped table-condensed">
			<tr class="table-headers">
				<th>&nbsp;</th>
				<th><?php echo __('Work Day'); ?></th>
				<th><?php echo __('In'); ?></th>
				<th><?php echo __('Out'); ?></th>
				<th><?php echo __('Meal<br />Period'); ?></th>
				<th><?php echo __('In'); ?></th>
				<th><?php echo __('Out'); ?></th>
				<th><?php echo __('Makeup<br />Hours'); ?></th>
				<th><?php echo __('OT'); ?></th>
				<th><?php echo __('PTO Taken'); ?></th>
				<th><?php echo __('Holiday'); ?></th>
				<th><?php echo __('Total'); ?></th>
			</tr>
			<?php foreach($timesheet_data->dates as $date): ?>
			<?php 
			$period1_in = "";
			$period1_out = "";
			$period2_in = "";
			$period2_out = "";
			$meal_period = "0.00";
			$holiday_time = "";
			$daily_time = "0.00";

			if($date->dayofweek == "weekend") {
				$class = "info";
			}elseif($date->type == "holiday") {
				$class = "success";
				$holiday_time = "8.00";
				$total_holiday = $total_holiday + 8;
			}else {
				$class = "";
				if($settings) {
					$period1_in = $settings['Setting']['time_in1'];
					$period1_out = $settings['Setting']['time_out1'];
					$period2_in = $settings['Setting']['time_in2'];
					$period2_out = $settings['Setting']['time_out2'];
					$meal_period = $settings['Setting']['meal_period'];
				} else {
					$period1_in = "08:00 am";
					$period1_out = "12:00 pm";
					$period2_in = "01:00 pm";
					$period2_out = "05:00 pm";
					$meal_period = "1.00";
				}
				$total_regular = $total_regular + 8;
				$daily_time = "8";
			}
			$num_days = $num_days-1;
			?>
			<tr class="<?php echo $class; ?> timesheet-row">
				<td class="text-left">
					<i id="remove_<?php echo $date->datestamp; ?>" class="icon-remove" rel="tooltip" data-placement="right" data-original-title="Clear row"></i>
					&nbsp;<?php if($num_days != 0): ?><i id="copy_<?php echo $date->datestamp; ?>" class="icon-hand-down" rel="tooltip" data-placement="right" data-original-title="Copy to next day"></i><?php endif; ?>
					<?php echo $this->Form->hidden($date->datestamp.'][MT_'.$date->datestamp, array('value' => $meal_period, 'id' => 'TimesheetMT_'.$date->datestamp)); ?>
				</td>
				<td><?php echo $date->datestamp; ?></td>
				<td><?php echo $this->Form->input($date->datestamp.'][period1_in', array('id' => 'D_'.$date->datestamp.'_P1I','class' => 'input-mini timepick in1', 'label' => false, 'value' => $period1_in)); ?></td>
				<td><?php echo $this->Form->input($date->datestamp.'][period1_out', array('id' => 'D_'.$date->datestamp.'_P1O','class' => 'input-mini timepick out1', 'label' => false, 'value' => $period1_out)); ?></td>
				<td id="MP_<?php echo $date->datestamp; ?>"><?php echo $meal_period; ?></td>
				<td><?php echo $this->Form->input($date->datestamp.'][period2_in', array('id' => 'D_'.$date->datestamp.'_P2I','class' => 'input-mini timepick in2', 'label' => false, 'value' => $period2_in)); ?></td>
				<td><?php echo $this->Form->input($date->datestamp.'][period2_out', array('id' => 'D_'.$date->datestamp.'_P2O','class' => 'input-mini timepick out2', 'label' => false, 'value' => $period2_out)); ?></td>
				<!-- <td><?php echo $this->Form->checkbox($date->datestamp.'][timeoff', array('id' => 'D_'.$date->datestamp.'_tim_off', 'label' => false, 'hiddenField' => false)); ?></td> -->
				<td>
					<?php echo $this->Form->checkbox($date->datestamp.'][makeup', array('id' => 'D_'.$date->datestamp.'_Makeup','label' => false, 'hiddenField' => false, 'class' => 'btn_makeup')); ?>
				</td>
				<td>
					<?php echo $this->Form->hidden($date->datestamp.'][OT_'.$date->datestamp, array('value' => 0, 'id' => 'TimesheetOT_'.$date->datestamp, 'class' => 'daily_ot')); ?>
					<div id="OTlabel_<?php echo $date->datestamp; ?>"></div>
				</td>
				<td><?php echo $this->Form->input($date->datestamp.'][pto_taken', array('id' => 'D_'.$date->datestamp.'_PTO','class' => 'input-mini pto_taken', 'label' => false)); ?></td>
				<td class="daily_totals">
					<?php echo $holiday_time; ?>
					<?php echo $this->Form->hidden($date->datestamp.'][DT_'.$date->datestamp, array('value' => $daily_time, 'id' => 'TimesheetDT_'.$date->datestamp)); ?>
				</td>
				<td id="TD_<?php echo $date->datestamp; ?>">
					<?php echo number_format($daily_time,2); ?>
					<?php echo $this->Form->hidden($date->datestamp.'][MT_'.$date->datestamp, array('value' => $meal_period, 'id' => 'TimesheetMT_'.$date->datestamp)); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<div class="span4">
			<dl class="dl-horizontal">
				<dt>OT Carryover</dt>
				<dd><?php echo $this->Form->input('ot_carryover', array('class' => 'input-mini', 'label' => false, 'value' => '0', 'id' => 'OTCarryover')); ?></dd>
				<dt><?php echo __('Total Regular Hours'); ?></dt>
				<dd id="TotalRegularHours"><?php echo $total_regular; ?></dd>
				<dt><?php echo __('Total OT Hours'); ?></dt>
				<dd id="TotalOTHours"><?php echo $total_ot; ?></dd>
				<dt><?php echo __('Total Holiday Hours'); ?></dt>
				<dd id="TotalHolidayHours"><?php echo $total_holiday; ?></dd>
				<dt><?php echo __('Total PTO Taken'); ?></dt>
				<dd id="TotalPTO"><?php echo $total_pto; ?></dd>
			</dl>
		</div>
		<div class="span6">
			<?php echo $this->Form->input('notes', array('type' => 'textarea', 'id' => 'TimeSheetNotes')); ?>
			<?php echo $this->Form->hidden('TotalRegularHours', array('value' => $total_regular)); ?>
			<?php echo $this->Form->hidden('MaxRegularHours', array('value' => $total_regular)); ?>
			<?php echo $this->Form->hidden('TotalOT', array('value' => $total_ot)); ?>
			<?php echo $this->Form->hidden('TotalPTO', array('value' => $total_pto)); ?>
			<?php echo $this->Form->hidden('TotalHoliday', array('value' => $total_holiday)); ?>
			<?php echo $this->Form->hidden('Data][user_id', array('value' => $current_user['id'])); ?>
			<?php echo $this->Form->hidden('Data][master_id', array('value' => $current_timesheet['Master']['id'])); ?>
			<?php echo $this->Form->hidden('Data][period_start_date', array('value' => $current_timesheet['Master']['period_start_date'])); ?>
			<?php echo $this->Form->hidden('Data][period_end_date', array('value' => $current_timesheet['Master']['period_end_date'])); ?>
		</div>
	</fieldset>
<?php echo $this->Form->button(__('Save Timesheet'), array('name' => 'data[Action]','type' => 'submit', 'class' => 'btn btn-large', 'value' => '2', 'id' => 'btnTimesheetSave')); ?>
<?php echo $this->Form->button(__('Submit Timesheet'), array('name' => 'data[Action]','type' => 'submit', 'class' => 'btn btn-large', 'value' => '3', 'id' => 'btnTimesheetSubmit')); ?>
<?php echo $this->Form->end(); ?>
</div>