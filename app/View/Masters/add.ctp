<script>
var holidays = <?php echo $holidays; ?>;
</script><div class="masters form">
	<fieldset>
		<legend><?php echo __('Add Master Timesheet'); ?></legend>
	<label for="period_start_date">Start Date</label>
	<input type="text" id="from" name="period_start_date"/>
	<label for="period_end_date">End Date</label>
	<input type="text" id="to" name="period_end_date"/>
	</fieldset>
	<a href="#" id="MasterGenerate" class="btn">Generate</a>
	<div id="MasterTemplate">

	</div>


<p>&nbsp;</p>
<?php echo $this->Form->create('Master'); ?>
<?php echo $this->Form->hidden('dates', array('value' => '', 'id' => 'JsonDates')); ?>
<?php echo $this->Form->hidden('period_start_date', array('value' => '', 'id' => 'PeriodStartDate')); ?>
<?php echo $this->Form->hidden('period_end_date', array('value' => '', 'id' => 'PeriodEndDate')); ?>
<!-- <?php echo $this->Form->end(__('Submit')); ?> -->
</div>

<?php 
/**
*<div class="actions">
*	<h3><?php echo __('Actions'); ?></h3>
*	<ul>
*
*		<li><?php echo $this->Html->link(__('List Masters'), array('action' => 'index')); ?></li>
*		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
*	</ul>
*</div>
**/
?>