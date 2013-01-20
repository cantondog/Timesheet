<?php
App::uses('AppController', 'Controller');
/**
 * Timesheets Controller
 *
 * @property Timesheet $Timesheet
 */
class TimesheetsController extends AppController {

	public $uses = array('Timesheet','Master', 'Holiday', 'Department', 'User', 'Setting');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$current_user = $this->Auth->user();
		$this->User->id = $current_user['id'];
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->Timesheet->recursive = 0;

		switch ($current_user['role']) {
			case 'admin':
				$this->set('departments', $this->Department->find('list'));
				break;
			case 'manager':
				$this->redirect(array('controller' => 'users' ,'action' => 'dashboard'));
				break;
			default:
				///// Find all timesheets by the user that need to be filled out (filtered by period_start_date >= than users hire date)
				$conditionsSubQuery['Timesheet2.user_id'] = $current_user['id'];

				$db = $this->Timesheet->getDataSource();
				$subQuery = $db->buildStatement(
				    array(
				        'fields'     => array('Timesheet2.master_id'),
				        'table'      => $db->fullTableName($this->Timesheet),
				        'alias'      => 'Timesheet2',
				        'limit'      => null,
				        'offset'     => null,
				        'joins'      => array(),
				        'conditions' => $conditionsSubQuery,
				        'order'      => null,
				        'group'      => null,
				    ),
				    $this->Timesheet
				);
				$nowDate = date("Y-m-d");
				$subQuery = ' Master.period_start_date >= "'.$current_user['hire_date'].'" AND Master.period_start_date <= "'.$nowDate.'" AND Master.id NOT IN (' . $subQuery . ') ';
				$subQueryExpression = $db->expression($subQuery);

				$conditions[] = $subQueryExpression;

				$current_user_masters = $this->Master->find('all', compact('conditions'));
				$this->set('current_user_masters', $current_user_masters);
				$options = array(
					'conditions' => array(
						'Timesheet.user_id' => $current_user['id'],
						'Timesheet.status_id' => array('1','2','4'),	
					),
				);
				$this->set('saved_timesheets', $this->Timesheet->find('all', $options));
				$options = array(
					'conditions' => array(
						'Timesheet.user_id' => $current_user['id'],
						'Timesheet.status_id' => '7',		
					),
				);
				$this->set('closed_sheets', $this->Timesheet->find('all', $options));
				break;
		}
	}

	public function check() {
		$current_user = $this->Auth->user();
		$options = array(
			'conditions' => array(
				'Timesheet.status_id' => '6',
			),
			'order' => array(
				'Timesheet.period_start_date',
				'User.department_id',
			),
		);
		$approved_sheets = $this->Timesheet->find('all', $options);
		$approved_grid = array();
		$i = 0;
		foreach($approved_sheets as $timesheet) {
			$dates = json_decode($timesheet['Timesheet']['dates']);
			$approved_grid[$i]['User']['id'] = $timesheet['User']['id'];
			$approved_grid[$i]['User']['first_name'] = $timesheet['User']['first_name'];
			$approved_grid[$i]['User']['last_name'] = $timesheet['User']['last_name'];
			$approved_grid[$i]['User']['department_id'] = $timesheet['User']['department_id'];
			$approved_grid[$i]['Timesheet']['id'] = $timesheet['Timesheet']['id'];
			$approved_grid[$i]['Timesheet']['period_start_date'] = $timesheet['Timesheet']['period_start_date'];
			$approved_grid[$i]['Timesheet']['period_end_date'] = $timesheet['Timesheet']['period_end_date'];
			$approved_grid[$i]['Timesheet']['submit_date'] = $timesheet['Timesheet']['submit_date'];
			$approved_grid[$i]['Dates'] = $dates;
			$i++;
		}
		$this->set('approved_grid', $approved_grid);
		
		$options = array(
			'conditions' => array(
				'Timesheet.status_id <' => '6',
			),
			'order' => array(
				'Timesheet.period_start_date',
				'User.department_id',
			),
		);
		$waiting_sheets = $this->Timesheet->find('all', $options);
		$waiting_grid = array();
		$i = 0;
		foreach($waiting_sheets as $timesheet) {
			$dates = json_decode($timesheet['Timesheet']['dates']);
			$waiting_grid[$i]['User']['id'] = $timesheet['User']['id'];
			$waiting_grid[$i]['User']['first_name'] = $timesheet['User']['first_name'];
			$waiting_grid[$i]['User']['last_name'] = $timesheet['User']['last_name'];
			$waiting_grid[$i]['User']['department_id'] = $timesheet['User']['department_id'];
			$waiting_grid[$i]['Timesheet']['id'] = $timesheet['Timesheet']['id'];
			$waiting_grid[$i]['Timesheet']['period_start_date'] = $timesheet['Timesheet']['period_start_date'];
			$waiting_grid[$i]['Timesheet']['period_end_date'] = $timesheet['Timesheet']['period_end_date'];
			$waiting_grid[$i]['Timesheet']['submit_date'] = $timesheet['Timesheet']['submit_date'];
			$waiting_grid[$i]['Dates'] = $dates;
			$i++;
		}
		$this->set('waiting_grid', $waiting_grid);
	}

/**
 * calculate pto methis
 *
 * @param string $id is id of that timesheet
 * @return newly calculated pto
 */
	private function __calculate_pto($id) {
		$options = array(
			'conditions' => array(
				'Timesheet.id' => $id,		
			),
		);
		$sheet = $this->Timesheet->find('first', $options);
		$sheet_info = json_decode($sheet['Timesheet']['dates']);
		$pto_used = $sheet_info->TotalPTO;
		$new_pto['user_id'] = $sheet['User']['id'];
		$new_pto['hours'] = ($sheet['User']['pto_balance'] + $sheet['User']['pto_rate']) - $pto_used;
		return $new_pto;
	}

	public function resolve() {
		$current_user = $this->Auth->user();
		foreach($this->request->data['Timesheet']['approve'] as $sheet) {
			$this->Timesheet->id = $sheet;
			$this->Timesheet->set('status_id', '7');
			if ($this->Timesheet->save()) {
				$this->Timesheet->id = null;
			} else {
				$this->Session->setFlash(__('Not all timesheets could be saved.'), 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('controller' => 'timesheets' ,'action' => 'check'));
			}
			// Update pto balance
			$updated_pto = $this->__calculate_pto($sheet);
			if($updated_pto) {
				$this->User->id = $updated_pto['user_id'];
				$this->User->saveField('pto_balance', $updated_pto['hours']);
				$this->User->id = null;
			}
		}
		$this->Session->setFlash(__('Selected timesheets have been updated.'), 'default', array('class' => 'alert alert-success'));
		$this->redirect(array('controller' => 'timesheets' ,'action' => 'check'));
	}

	public function update($id = null) {
		$current_user = $this->Auth->user();
		$this->Timesheet->id = $id;
		if (!$this->Timesheet->exists()) {
			throw new NotFoundException(__('Invalid timesheet'), 'default', array('class' => 'alert alert-error'));
		}
		$timesheet = $this->Timesheet->read(null, $id);
		$timesheet_state = $this->Timesheet->find('first', array('conditions' => array('Timesheet.id' =>$this->Timesheet->id)));
		if($current_user['role'] == 'manager') {
			if($timesheet_state['Timesheet']['status_id'] != 3) {
				$this->Session->setFlash(__('Timesheet can\'t be approved by you at this time.'), 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'index'));				
			}
		}
		if($current_user['role'] == 'manager' || $current_user['role'] == 'admin') {
			if(isset($this->params['named']['status_id'])) {
				$this->Timesheet->set('status_id', $this->params['named']['status_id']);
				if ($this->Timesheet->save()) {
					$this->Session->setFlash(__('The timesheet has been saved'), 'default', array('class' => 'alert alert-success'));
					if($current_user['role'] == 'manager') {
						$this->redirect(array('controller' => 'users' ,'action' => 'dashboard'));
					} else {
						// Update pto balance
						$updated_pto = $this->__calculate_pto($id);
						if($updated_pto) {
							$this->User->id = $updated_pto['user_id'];
							$this->User->saveField('pto_balance', $updated_pto['hours']);
							$this->User->id = null;
						}
						$this->redirect(array('controller' => 'timesheets' ,'action' => 'check'));
					}
				} else {
					$this->Session->setFlash(__('The timesheet could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
				}
			} else {
				throw new CakeException(__('Yikes! You broke it.'));
			}
		} else {
			throw new ForbiddenException(__('Not authorized'));
		}

	}

/**
 * export method
 *
 * @return void
 */
	public function export($id = null) {
		$current_user = $this->Auth->user();
		if($current_user['role'] == 'admin') {
			$options = array(
				'conditions' => array(
					'Master.period_start_date >=' => date("Y").'-01-01',
					'Master.period_end_date <=' => date("Y").'-12-31',		
				),
				'fields' => array('Master.id', 'Master.period_end_date'),
			);
			$current_year_masters_list = $this->Master->find('list', $options);
			arsort($current_year_masters_list);
			$this->set('current_year_masters_list', $current_year_masters_list);
			if($id) {
				$options = array(
					'conditions' => array(
						'Timesheet.master_id' => $id,		
					),
					'order' => array(
						'User.department_id',
						'User.last_name',
					),
					'recursive' => 1,
				);
				$export_sheets = $this->Timesheet->find('all', $options);
				$this->set('export_sheets', $export_sheets);
			}
		} else {
			// non-admin: redirect to dashboard
			$this->Session->setFlash(__('Only admins can access that page.'), 'default', array('class' => 'alert alert-error'));
			$this->redirect(array('controller' => 'users' ,'action' => 'dashboard'));
		}
	}

	public function export_save($id = null) {
		Configure::write('debug', 0);
		if($id) {
			$options = array(
				'conditions' => array(
					'Timesheet.master_id' => $id,
					'Timesheet.status_id' => 7,
				),
				'order' => array(
					'User.department_id',
					'User.last_name',
				),
			);
			$export_sheets = $this->Timesheet->find('all', $options);
			$csv = array();
			$i=0;
			foreach($export_sheets as $sheet) {
				$json_data = json_decode($sheet['Timesheet']['dates']);
				$csv[$i] = array(
                    'date' => date('m-d-Y'), 
                    'pay_period' => $sheet['Timesheet']['period_end_date'], 
                    'department' => '', 
                    'status' => '', 
                    'emp_num' => '',
                    'first_name' => $sheet['User']['first_name'],
                    'last_name' => $sheet['User']['last_name'],
                    'address' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'gender' => '',
                    'title' => '',
                    'dob' => '',
                    'hire_date' => $sheet['User']['hire_date'],
                    'terminated' => '',
                    'pto_accured_ppp' => '',
                    'pto_carry_over' => '',
                    'pto_balance' => $sheet['User']['pto_balance'],
                    'hourly' => '',
                    'salary_24' => '',
                    'salary_yearly' => '',
                    'blank1' => '',
                    'blank2' => '',
                    'comm' => '',
                    'reimb' => '',
                    'bonus' => '',
                    'reg' => $json_data->TotalRegularHours,
                    'holiday' => $json_data->TotalHoliday,
                    'ot' => $json_data->TotalOT,
                    'pto' => $json_data->TotalPTO,
				);
				$i++;
			}
			// Define column headers for CSV file, in same array format as the data itself 
            $headers = array( 
                    'date' => 'Date', 
                    'pay_period' => 'Pay Period', 
                    'department' => 'Department', 
                    'status' => 'Status', 
                    'emp_num' => 'EMP#',
                    'first_name' => 'FIRST',
                    'last_name' => 'LAST',
                    'address' => 'Address',
                    'city' => 'City',
                    'state' => 'State',
                    'zip' => 'Zip',
                    'gender' => 'Gender',
                    'title' => 'Title',
                    'dob' => 'DOB',
                    'hire_date' => 'HIRE DATE',
                    'terminated' => 'Terminated',
                    'pto_accured_ppp' => 'PTO Accured PPP',
                    'pto_carry_over' => 'PTO Carry Over',
                    'pto_balance' => 'PTO Balance',
                    'hourly' => 'HOURLY',
                    'salary_24' => 'SALARY (24 pay periods)',
                    'salary_yearly' => 'SALARY (yearly)',
                    'blank1' => 'blank',
                    'blank2' => 'blank',
                    'comm' => 'Comm',
                    'reimb' => 'Reimb',
                    'bonus' => 'Bonus',
                    'reg' => 'Reg',
                    'holiday' => 'Holiday',
                    'ot' => 'OT',
                    'pto' => 'PTO',
            );
			// Add headers to start of data array 
            array_unshift($csv,$headers);
            // Make the data available to the view (and the resulting CSV file) 
            $this->set('export_date', $export_sheets[1]['Timesheet']['period_end_date']);
            $this->set(compact('csv')); 
		}
		$this->layout = 'ajax';
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$current_user = $this->Auth->user();
		$this->Timesheet->id = $id;
		if (!$this->Timesheet->exists()) {
			throw new NotFoundException(__('Invalid timesheet'), 'default', array('class' => 'alert alert-error'));
		}
		$timesheet = $this->Timesheet->read(null, $id);
		if($current_user['role'] == 'regular' && $current_user['id'] != $timesheet['Timesheet']['user_id']) {
			$this->Session->setFlash(__('You don\'t have access to that timesheet'), 'default', array('class' => 'alert alert-error'));
			$this->redirect(array('controller' => 'users' ,'action' => 'dashboard'));
		}
		$options = array(
			'conditions' => array(
				'Holiday.date >=' => $timesheet['Timesheet']['period_start_date'],		
			),
		);
		$holidays = $this->Holiday->find('all', $options);
		$holiday_dates = array();
		foreach ($holidays as $holiday) {
			$holiday_dates[] = $holiday['Holiday']['date'];
		}
		$this->set('holiday_dates', $holiday_dates);
		$this->set('holidays', $holidays);
		$this->set('timesheet', $timesheet);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
		$current_user = $this->Auth->user();
		if ($this->request->is('post')) {
			$this->Timesheet->create();
			$this->Timesheet->user_id = $current_user['id'];
			$this->Timesheet->master_id = $this->request->data['Timesheet']['Data']['master_id'];
			$this->Timesheet->period_start_date = $this->request->data['Timesheet']['Data']['period_start_date'];
			$this->Timesheet->period_end_date = $this->request->data['Timesheet']['Data']['period_end_date'];
			$this->Timesheet->dates = json_encode($this->request->data['Timesheet']);
			$this->Timesheet->status_id = $this->request->data['Action'];
			$this->Timesheet->approved = 0;
			$this->Timesheet->submit_date = date("Y-m-d");
			if ($this->Timesheet->save($this->Timesheet)) {
				$this->Session->setFlash(__('The timesheet has been saved'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timesheet could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
		} else {
			$this->set('current_timesheet', $this->Master->find('first', array('conditions' => array('Master.id' => $id))));
			$options = array(
				'conditions' => array(
					'Setting.user_id' => $current_user['id'],		
				),
			);
			$this->set('settings', $this->Setting->find('first', $options));
		}

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$current_user = $this->Auth->user();
		$this->Timesheet->id = $id;
		if (!$this->Timesheet->exists()) {
			throw new NotFoundException(__('Invalid timesheet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//*** make sure that timesheet hasn't already been submitted (browser back button fix)
			$this->Timesheet->id = $this->request->data['Timesheet']['Data']['id'];
			$timesheet_state = $this->Timesheet->find('first', array('conditions' => array('Timesheet.id' =>$this->Timesheet->id)));
			if(in_array($timesheet_state['Timesheet']['status_id'], array('3','6','7'))) {
				$this->Session->setFlash(__('Timesheet has already been submitted'), 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'index'));				
			}
			$saveData['Timesheet']['user_id'] = $current_user['id'];
			$saveData['Timesheet']['master_id'] = $this->request->data['Timesheet']['Data']['master_id'];
			$saveData['Timesheet']['period_start_date'] = $this->request->data['Timesheet']['Data']['period_start_date'];
			$saveData['Timesheet']['period_end_date'] = $this->request->data['Timesheet']['Data']['period_end_date'];
			$saveData['Timesheet']['dates'] = json_encode($this->request->data['Timesheet']);
			$saveData['Timesheet']['status_id'] = $this->request->data['Action'];
			$saveData['Timesheet']['approved'] = 0;
			$saveData['Timesheet']['submit_date'] = date("Y-m-d");
			if ($this->Timesheet->save($saveData['Timesheet'])) {
				$this->Session->setFlash(__('The timesheet has been saved'), 'default', array('class' => 'alert alert-success'));

				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timesheet could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
		} else {
			$timesheet = $this->Timesheet->read(null, $id);
			$options = array(
				'conditions' => array(
					'Holiday.date >=' => $timesheet['Timesheet']['period_start_date'],		
				),
			);
			$holidays = $this->Holiday->find('all', $options);
			foreach ($holidays as $holiday) {
				// because we're editing we need to change the dates around
				$h_pieces = explode("-", $holiday['Holiday']['date']);
				$h_fixed = $h_pieces[1]."-".$h_pieces[2]."-".$h_pieces[0];
				$holiday_dates[] = $h_fixed;
				unset($h_fixed);
			}
			$this->set('holiday_dates', $holiday_dates);
			$this->set('holidays', $holidays);
			$this->set('timesheet', $timesheet);
		}
		$users = $this->Timesheet->User->find('list');
		$masters = $this->Timesheet->Master->find('list');
		$statuses = $this->Timesheet->Status->find('list');
		$this->set(compact('users', 'masters', 'statuses'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Timesheet->id = $id;
		if (!$this->Timesheet->exists()) {
			throw new NotFoundException(__('Invalid timesheet'), 'default', array('class' => 'alert alert-error'));
		}
		if ($this->Timesheet->delete()) {
			$this->Session->setFlash(__('Timesheet deleted'), 'default', array('class' => 'alert alert-info'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Timesheet was not deleted'), 'default', array('class' => 'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}
