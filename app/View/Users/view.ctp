<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Department']['dept_name'], array('controller' => 'departments', 'action' => 'view', $user['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ext'); ?></dt>
		<dd>
			<?php echo h($user['User']['ext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailaddress'); ?></dt>
		<dd>
			<?php echo h($user['User']['emailaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pto Balance'); ?></dt>
		<dd>
			<?php echo h($user['User']['pto_balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hire Date'); ?></dt>
		<dd>
			<?php echo h($user['User']['hire_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>