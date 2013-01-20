<div class="ptos form">
<?php echo $this->Form->create('Pto', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Request PTO'); ?></legend>
		<div class="control-group">
			<label class="control-label" for="period_start_date">Start Date</label>
			<input class="controls" type="text" id="from" name="start_date"/>
		</div>
		<div class="control-group">
			<label class="control-label" for="period_end_date">End Date</label>
			<input class="controls" type="text" id="to" name="end_date"/>
		</div>
		<?php echo $this->Form->input('hours_requested', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label'))); ?>
		<?php echo $this->Form->input('notes', array('type' => 'textarea', 'id' => 'PtoNotes', 'class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label'))); ?>
	</fieldset>
<?php
$options = array(
    'label' => 'Submit Request',
    'class' => 'btn btn-large',
);
echo $this->Form->end($options); ?>
</div>




