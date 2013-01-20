<div class="holidays index">
	<h2 class="pull-left"><?php echo $display_year.__(' Holidays'); ?></h2>
	<div class="pull-right" id="YearSelect">
		<div class="btn-group">
		  <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
		    Select Year
		    <span class="caret"></span>
		  </a>
		  <ul class="dropdown-menu">
		  	<?php foreach($holiday_years as $year): ?>
		    <li><a href="<?php echo BASE_URL; ?>/holidays/index/year/<?php echo $year; ?>"><?php echo $year; ?></a></li>
			<?php endforeach; ?>
		  </ul>
		</div>		
	</div>
	<div class="clearfix"></div>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<?php if($current_user['role'] == 'admin'): ?>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<?php endif; ?>
	</tr>
	<?php
	foreach ($holidays as $holiday): ?>
	<tr>
		<td><?php echo h($holiday['Holiday']['name']); ?>&nbsp;</td>
		<td><?php echo h($holiday['Holiday']['date']); ?>&nbsp;</td>
		<?php if($current_user['role'] == 'admin'): ?>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $holiday['Holiday']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $holiday['Holiday']['id']), array('class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $holiday['Holiday']['id'])); ?>
		</td>
		<?php endif; ?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging pagination">
		<ul>
			<li><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'current_page')); ?>
			<li><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?></li>
		</ul>
	</div>
</div>
<?php if($current_user['role'] == 'admin'): ?>
<div class="actions">
	<?php echo $this->Html->link(__('New Holiday'), array('action' => 'add'), array('class' => 'btn btn-large')); ?>
</div>
<?php endif; ?>