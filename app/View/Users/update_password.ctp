<div class="users index">
	<h2><?php echo __('Update Password'); ?></h2>
		<?php echo $this->Form->create('ChangePw'); ?>
		<div id="PwUserSelect" class="control-group" >
			<label for="UserSelect">Please choose which user you want to update</label>
			<select id="UserSelect" name="user_id">
				<option value="">Choose User</option>
				<?php foreach($users as $user): ?>
				<option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['first_name']." ".$user['User']['last_name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php echo $this->Form->input('password', array('class' => 'controls','div' => 'control-group', 'label' => array('class' => 'control-label'))); ?>
		<?php echo $this->Form->input('password_confirm', array('type' => 'password', 'class' => 'controls','div' => array('class' =>'control-group','id' => 'PwConfirm'), 'label' => array('class' => 'control-label'),'after' => '<span class="help-inline"></span>',)); ?>
		<?php
		$options = array(
    		'label' => 'Update Password',
    		'class' => 'btn btn-large',
    		'id' => 'btnUpdatePw',
		);
		echo $this->Form->end($options); ?>
</div>