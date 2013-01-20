<?php // break out the dates JSON into a PHP array
$master_data = json_decode($master['Master']['dates']);
?>
<div class="masters view">
<h2><?php  echo __('Master'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Period Start Date'); ?></dt>
		<dd>
			<?php echo h($this->Time->format("m-d-Y",$master['Master']['period_start_date'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Period End Date'); ?></dt>
		<dd>
			<?php echo h($this->Time->format("m-d-Y",$master['Master']['period_end_date'])); ?>
			&nbsp;
		</dd>
	</dl>
	<table class="table table-condensed">
		<?php foreach($master_data->dates as $date): ?>
		<?php 
		if($date->dayofweek == "weekend") {
			$class = "info";
		}elseif($date->type == "holiday") {
			$class = "success";
		}else {
			$class = "";
		}
		$newdate = date_create_from_format('n-j-Y', $date->datestamp);

		?>
		<tr class="<?php echo $class; ?>">
			<td><?php echo date_format($newdate, 'm-d-Y');; ?></td>
			<td><?php echo $date->dayofweek; ?>
		</tr>
		<?php endforeach; ?>
	</table>
	<dl class="dl-horizontal">
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($this->Time->format("m-d-Y H:i:s",$master['Master']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($this->Time->format("m-d-Y H:i:s",$master['Master']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>