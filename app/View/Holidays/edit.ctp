<div class="holidays form">
<?php echo $this->Form->create('Holiday'); ?>
	<fieldset>
		<legend><?php echo __('Edit Holiday'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
