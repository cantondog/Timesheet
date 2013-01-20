<?php
App::uses('AppController', 'Controller');
/**
 * Masters Controller
 *
 * @property Master $Master
 */
class MastersController extends AppController {

	public $uses = array('Master', 'Holiday');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Master.period_end_date' => 'DESC'
        )
    );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Master->recursive = 0;
		$this->set('masters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Master->id = $id;
		if (!$this->Master->exists()) {
			throw new NotFoundException(__('Invalid master'));
		}
		$this->set('master', $this->Master->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		App::uses('CakeTime', 'Utility');
		$options = array(
			'conditions' => array(
				'Holiday.date >=' => date("Y").'-01-01',
				'Holiday.date <=' => date("Y").'-12-31',
			),
			'fields' => array('Holiday.name','Holiday.date'),
		);
		$holidays = $this->Holiday->find('all', $options);
		foreach($holidays as $holiday) {
			$holidays_formatted[CakeTime::format('m-d-Y', $holiday['Holiday']['date'])] = array('name' => $holiday['Holiday']['name']);
		}
		$this->set('holidays', json_encode($holidays_formatted, JSON_FORCE_OBJECT));
		if ($this->request->is('post')) {
			$startdatearray = explode("/", $this->request->data['Master']['period_start_date']);
			$this->request->data['Master']['period_start_date'] = array(
				'month' => $startdatearray[0],
				'day' => $startdatearray[1],
				'year' => $startdatearray[2],
			);
			$enddatearray = explode("/", $this->request->data['Master']['period_end_date']);
			$this->request->data['Master']['period_end_date'] = array(
				'month' => $enddatearray[0],
				'day' => $enddatearray[1],
				'year' => $enddatearray[2],
			);
			$this->Master->create();
			if ($this->Master->save($this->request->data)) {
				$this->Session->setFlash(__('The master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master could not be saved. Please, try again.'));
			}
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
		$this->Master->id = $id;
		if (!$this->Master->exists()) {
			throw new NotFoundException(__('Invalid master'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Master->save($this->request->data)) {
				$this->Session->setFlash(__('The master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Master->read(null, $id);
		}
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
		$this->Master->id = $id;
		if (!$this->Master->exists()) {
			throw new NotFoundException(__('Invalid master'));
		}
		if ($this->Master->delete()) {
			$this->Session->setFlash(__('Master deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Master was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
