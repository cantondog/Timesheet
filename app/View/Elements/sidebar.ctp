<?php if($current_user['role'] == 'admin'): ?>
<ul class="nav nav-list">
  <li class="nav-header">Actions</li>
  <li><?php echo $this->Html->link(__('Holidays'), array('controller' => 'holidays', 'action' => 'index')); ?> </li>
  <li><?php echo $this->Html->link(__('Review Timesheets'), array('controller' => 'timesheets', 'action' => 'check')); ?> </li>
  <li><?php echo $this->Html->link(__('Export Timesheets'), array('controller' => 'timesheets', 'action' => 'export')); ?> </li>
  <li class="nav-header">Users</li>
  <!-- <li><?php //echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li> -->
  <!-- <li><?php //echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li> -->
  <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
  <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
  <li><?php echo $this->Html->link(__('Update Password'), array('controller' => 'users', 'action' => 'update_password')); ?> </li>
  <li class="nav-header">Masters</li>
  <li><?php echo $this->Html->link(__('New Master'), array('controller' => 'masters', 'action' => 'add')); ?> </li>
  <li><?php echo $this->Html->link(__('List Masters'), array('controller' => 'masters', 'action' => 'index')); ?> </li>
  <!-- <li><?php //echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li> -->
  <!-- <li><?php //echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li> -->
  <!-- <li><?php //echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li> -->
  <!-- <li><?php //echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li> -->
  <!-- <li><?php //echo $this->Html->link(__('List Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li> -->
  <!-- <li><?php //echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li> -->
  <!-- <li class="nav-header">Related</li> -->
  <!-- <li><?php //echo $this->Html->link(__('New Timesheet'), array('controller' => 'timesheets', 'action' => 'add')); ?> </li> -->
</ul>
<?php elseif($current_user['role'] == 'manager'): ?>
<ul class="nav nav-list">
  <li class="nav-header">Managers</li>
  <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard')); ?> </li>
  <li><?php echo $this->Html->link(__('List Users in Dept'), array('controller' => 'departments', 'action' => 'view', $current_user['Department']['id'])); ?></li>
  <li><?php echo $this->Html->link(__('Holidays'), array('controller' => 'holidays', 'action' => 'index')); ?></li>
</ul>
<?php elseif($current_user['role'] == 'regular'): ?>
<ul class="nav nav-list">
  <li class="nav-header">Users</li>
  <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard')); ?> </li>
  <li><?php echo $this->Html->link(__('Timesheets'), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
</ul>

<?php endif; ?>