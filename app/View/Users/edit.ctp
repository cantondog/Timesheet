<div class="users form">
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		$roles = array('admin' => 'admin', 'manager' => 'manager', 'regular' => 'regular');
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('first_name', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('department_id', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('role', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label'), 'options' => $roles));
		echo $this->Form->input('ext', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('emailaddress', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('pto_balance', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('pto_rate', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
		echo $this->Form->input('hire_date', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label')));
	?>
	</fieldset>
<?php 
$options = array(
    'label' => 'Update User',
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
*		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
*		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
*		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
*		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
*		<li><?php echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
*		<li><?php echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li>
*	</ul>
*</div>
**/
?>