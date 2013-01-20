<div class="holidays form">
<?php echo $this->Form->create('Holiday'); ?>
	<fieldset>
		<legend><?php echo __('Add Holiday'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('date', array('type' => 'text', 'id' => 'HolidayDate'));
		// echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php
/**
*<div class="actions">
*	<h3><?php echo __('Actions'); ?></h3>
*	<ul>
*
*		<li><?php echo $this->Html->link(__('List Holidays'), array('action' => 'index')); ?></li>
*	</ul>
*</div>
**/
?>