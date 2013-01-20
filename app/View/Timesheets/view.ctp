<?php
function isWeekend($date) {
	$date = str_replace("-","/",$date);
    return (date('N', strtotime($date)) >= 6);
}

$timesheet_data = json_decode($timesheet['Timesheet']['dates']);
$timesheet['Data']['ot_carryover'] = $timesheet_data->ot_carryover;
$timesheet['Data']['notes'] = $timesheet_data->notes;
$timesheet['Data']['TotalRegularHours'] = $timesheet_data->TotalRegularHours;
$timesheet['Data']['TotalPTO'] = $timesheet_data->TotalPTO;
$timesheet['Data']['TotalHoliday'] = $timesheet_data->TotalHoliday;
$timesheet['Data']['MaxRegularHours'] = $timesheet_data->MaxRegularHours;
$timesheet['Data']['TotalOT'] = $timesheet_data->TotalOT;
unset($timesheet_data->ot_carryover);
unset($timesheet_data->notes);
unset($timesheet_data->TotalRegularHours);
unset($timesheet_data->TotalPTO);
unset($timesheet_data->TotalHoliday);
unset($timesheet_data->MaxRegularHours);
unset($timesheet_data->TotalOT);
$num_days = count(get_object_vars($timesheet_data))-1;
$holiday_time = "";
?>
<div class="timesheets view">
<h2><?php  echo __('Timesheet'); ?></h2>
	<legend><?php echo __('View Timesheet for ').$timesheet['User']['first_name']." ".$timesheet['User']['last_name']; ?></legend>
	<table class="table table-striped table-condensed">
		<tr class="table-headers">
			<!-- <th>&nbsp;</th> -->
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
		<?php foreach($timesheet_data as $key => $date): ?>
			<?php if($key != "Data"): ?>
				<?php
				$mealperiod = "MT_".$key;
				$total_hours = "DT_".$key;
				$ot_hours = "OT_".$key;
				$date->datestamp = $key;
				(isWeekend($key)) ? $date->dayofweek = "weekend" : $date->dayofweek = "weekday";
				$rdate = explode("-",$key);
				$rdate = $rdate[2]."-".$rdate[0]."-".$rdate[1];
				(in_array($rdate, $holiday_dates)) ? $date->type = "holiday": $date->type = "regular";
				if($date->dayofweek == "weekend") {
					$class = "info";
					$holiday_time = "";
				}elseif($date->type == "holiday") {
					$class = "success";
					$holiday_time = "8.00";
				}else {
					$class = "";
					$holiday_time = "";
				}
				?>
				<tr class="<?php echo $class; ?> timesheet-row">
					<td><?php echo $key; ?></td>
					<td><?php echo $date->period1_in; ?></td>
					<td><?php echo $date->period1_out; ?></td>
					<td><?php echo $date->$mealperiod; ?></td>
					<td><?php echo $date->period2_in; ?></td>
					<td><?php echo $date->period2_out; ?></td>
					<td><?php echo (isset($date->makeup)) ? '<i class="icon-ok"></i>' : false; ?></td>
					<td><?php echo $date->$ot_hours; ?></td>
					<td><?php echo $date->pto_taken; ?></td>
					<td><?php echo $holiday_time; ?></td>
					<td><?php echo $date->$total_hours; ?></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>
	<div class="span4">
		<dl class="dl-horizontal">
			<dt>OT Carryover</dt>
			<dd><?php echo $timesheet['Data']['ot_carryover']; ?></dd>
			<dt><?php echo __('Total Regular Hours'); ?></dt>
			<dd id="TotalRegularHours"><?php echo $timesheet['Data']['TotalRegularHours']; ?></dd>
			<dt><?php echo __('Total OT Hours'); ?></dt>
			<dd id="TotalOTHours"><?php echo $timesheet['Data']['TotalOT']; ?></dd>
			<dt><?php echo __('Total Holiday Hours'); ?></dt>
			<dd id="TotalHolidayHours"><?php echo $timesheet['Data']['TotalHoliday']; ?></dd>
			<dt><?php echo __('Total PTO Taken'); ?></dt>
			<dd id="TotalPTO"><?php echo $timesheet['Data']['TotalPTO']; ?></dd>
		</dl>
	</div>
	<div class="span6">
		<div class="well user-notes">
			<?php echo $timesheet['Data']['notes']; ?>
		</div>
		<?php echo $this->Form->hidden('id', array('value' => $timesheet['Timesheet']['id'])); ?>
		<?php if(($current_user['role'] == "manager") || ($current_user['role'] == "admin")): ?>
		<?php
			switch($current_user['role']) {
				case "manager":
					$new_status = "6";
					break;
				case "admin":
					$new_status = "7";
					break;
				default:
					break;
			}
		?>
		<span class="btn btn-large"><?php echo $this->Html->link(__('Approve'), array('status_id' => $new_status,'controller' => 'timesheets', 'action' => 'update', $timesheet['Timesheet']['id'])); ?></span>
		<span class="btn btn-large"><?php echo $this->Html->link(__('Return for corrections'), array('status_id' => '4','controller' => 'timesheets', 'action' => 'update', $timesheet['Timesheet']['id'])); ?></span>
		<?php endif; ?>
	</div>
</div>

