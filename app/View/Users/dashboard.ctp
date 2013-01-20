<div class="users view">
<h2><?php  echo __('Dashboard'); ?></h2>
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
			<?php if($user['User']['pto_balance'] >= 104): ?>
				<span class="label label-important">Your PTO is close to the max! You stop earling at 120.</span>
			<?php elseif ($user['User']['pto_balance'] >= 88): ?>
				<span class="label label-info">Notice: Employees stop earning PTO at 120 hours.</span>
			<?php endif; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hire Date'); ?></dt>
		<dd>
			<?php echo h($user['User']['hire_date']); ?>
			&nbsp;
		</dd>
		<p><a id="btnSettings" class="btn btn-small" href="#"><i class="icon-cog"></i></a></p>
	</dl>
	<?php if($current_user['role'] == 'manager'): ?>
	<h4>Timesheets Needing Approval</h4>
	<table class="table table-striped table-condensed">
		<tr class="table-headers">
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Period Start Date'); ?></th>
			<th><?php echo __('Period End Date'); ?></th>
			<th><?php echo __('Submit Date'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($department_timesheets as $timesheet): ?>
		<tr>
			<td><?php echo $timesheet['User']['first_name']." ".$timesheet['User']['last_name']; ?></td>
			<td class="center"><?php echo $timesheet['Timesheet']['period_start_date']; ?></td>
			<td class="center"><?php echo $timesheet['Timesheet']['period_end_date']; ?></td>
			<td class="center"><?php echo $timesheet['Timesheet']['submit_date']; ?></td>
			<td class="center">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timesheets','action' => 'view', $timesheet['Timesheet']['id']), array('class' => 'btn btn-mini')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	<div id="dialog-form" title="Your Settings">
		<div id="SettingsAlert"></div>
	    <?php echo $this->Form->create('Setting', array('class' => 'form-inline')); ?>
	    <div class="pull-left">
		    <fieldset>
		        <?php
		        echo $this->Form->input('time_in1', array('class' => 'controls settings_timepick input-small','div' => 'control-group', 'label' => array('text' => 'Time In 1','class' => 'control-label'), 'value' => $Setting['Setting']['time_in1']));
		        echo $this->Form->input('time_out1', array('class' => 'controls settings_timepick input-small','div' => 'control-group', 'label' => array('text' => 'Time Out 1','class' => 'control-label'), 'value' => $Setting['Setting']['time_out1']));
		    ?>
		    </fieldset>
		</div>
	    <div class="pull-right">
	    <fieldset>
	        <?php
	        echo $this->Form->input('time_in2', array('class' => 'controls settings_timepick input-small','div' => 'control-group', 'label' => array('text' => 'Time In 2','class' => 'control-label'), 'value' => $Setting['Setting']['time_in2']));
	        echo $this->Form->input('time_out2', array('class' => 'controls settings_timepick input-small','div' => 'control-group', 'label' => array('text' => 'Time Out 2','class' => 'control-label'), 'value' => $Setting['Setting']['time_out2']));
	    ?>
	    </fieldset>
		</div>
		<div class="clearfix">&nbsp;</div>
	    <div class="clearfix">
	    <fieldset>
	    <?php
	        echo $this->Form->input('nickname', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label'), 'value' => $Setting['Setting']['nickname']));
	        echo $this->Form->hidden('user_id', array('value' => $current_user['id']));
	        ?>
	    </fieldset>
		</div>
	    <?php
		$options = array(
		    'label' => 'Update Settings',
		    'class' => 'btn',
		); ?>
	</div>
	<div id="dialog-message" title="Your Settings">
	    <p>
	        <span id="dialog-message-text"></span>
	    </p>
	</div>
</div>