<div class="users form">
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('password', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('first_name', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('department_id', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('ext', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('emailaddress', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('pto_balance', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('pto_rate', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('hire_date', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
	?>
	</fieldset>
<?php
$options = array(
    'label' => 'Add User',
    'class' => 'btn btn-large',
);
echo $this->Form->end($options); ?>
</div>
<?php
/**
*<div class="actions">
*	<h3><?php echo __('Actions'); ?></h3>
*	<ul>
*
*		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
*		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
*		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
*	</ul>
*</div>
**/
?>