<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 */
class SettingsController extends AppController {

	public $components = array('RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
		$options = array(
			'conditions' => array(
				'Setting.user_id' => $this->request->data['user_id'],		
			),
		);
		$usersetting = $this->Setting->find('first', $options);
		if($usersetting) {
			// update current
			$this->Setting->id = $usersetting['Setting']['id'];
		} else {
			$this->Setting->create();

		}
		if($this->Setting->save($this->request->data)) {
			echo "Your settings have been saved.";
		} else {
			echo "There was an error. Please try again.";
		}
		$this->layout = 'ajax';
		$this->autoRender = false;
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
	}
}
