<?php
App::uses('AppModel', 'Model','AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property Department $Department
 * @property Timesheet $Timesheet
 */
class Setting extends AppModel {

    public $name = 'Setting';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


}
