<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $name = 'Users';
	public $uses = array('User','Timesheet','Master', 'Holiday', 'Department', 'Setting');
    public $paginate = array(
        'limit' => 25,
    );
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add','edit');
	}

	public function isAuthorized($user) {
		if($user['role'] == 'admin') {
			return true;
		}
		if(in_array($this->action, array('edit', 'delete'))) {
			if($user['id'] != $this->request->params['pass'][0]) {
				return false;
			}
		}
		return true;
	}

	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Your username/password combination was incorrect');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function dashboard() {
		$current_user = $this->Auth->user();
		$this->User->id = $current_user['id'];
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($current_user['role'] == 'manager') {
			$options = array(
				'conditions' => array(
					'User.department_id' => $current_user['department_id'],		
				),
				'recursive' => 0,
			);
			$users_in_department = $this->User->find('all', $options);
			$department_timesheets = array();
			foreach ($users_in_department as $user) {
				if($user['User']['id'] != $current_user['id']) {
					$user_ts_options = array(
						'conditions' => array(
							'Timesheet.user_id' => $user['User']['id'],
							'Timesheet.approved !=' => 1,
							'Timesheet.status_id' => 3,		
						),
						'recursive' => 0,
					);
					$user_timesheets = $this->Timesheet->find('all', $user_ts_options);
					foreach ($user_timesheets as $usersheet) {
						$department_timesheets[] = $usersheet;
					}
				}
			}
			$this->set('department_timesheets', $department_timesheets);
		}
		$this->set('user', $this->User->read());
		$options = array(
			'conditions' => array(
				'Setting.user_id' => $current_user['id'],		
			),
		);
		$this->set('Setting', $this->Setting->find('first', $options));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
		}
		$departments = $this->User->Department->find('list');
		$this->set(compact('groups', 'departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$departments = $this->User->Department->find('list');
		$this->set(compact('groups', 'departments'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'), 'default', array('class' => 'alert alert-error'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'), 'default', array('class' => 'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'), 'default', array('class' => 'alert alert-error'));
		$this->redirect(array('action' => 'index'), 'default', array('class' => 'alert alert-error'));
	}


	public function update_password($id = null) {
		$current_user = $this->Auth->user();
		if($current_user['role'] != 'admin') {
			$this->Session->setFlash(__('Access denied.'), 'default', array('class' => 'alert alert-error'));
			$this->redirect(array('action' => 'dashboard'), 'default', array('class' => 'alert alert-error'));
		}
		if ($this->request->is('post')) {
			$this->User->id = $this->request->data['user_id'];
			if($this->User->saveField('password', $this->request->data['ChangePw']['password'])) {
				$this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
			unset($this->request->data);
		}
		$this->User->recursive = 0;
		$options = array(
			'order' => array(
				'User.first_name', 'User.last_name',		
			),
		);
		$this->set('users', $this->User->find('all', $options));		
	}


}
