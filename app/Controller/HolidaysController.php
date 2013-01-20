<?php
App::uses('AppController', 'Controller');
/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 */
class HolidaysController extends AppController {

	public $uses = array('Holiday', 'Master');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Holiday->recursive = 0;
		if(isset($this->request->params['pass'][0])) {
			if($this->request->params['pass'][0] == "year") {
				$options = array(
						'Holiday.date >=' => $this->request->params['pass'][1].'-01-01',
						'Holiday.date <=' => $this->request->params['pass'][1].'-12-31',
				);
				$display_year = $this->request->params['pass'][1];
			}
		} else {
			$options = array(
					'Holiday.date >=' => date("Y").'-01-01',
					'Holiday.date <=' => date("Y").'-12-31',
			);
			$display_year = date("Y");
		}
		// get all years for the dropdown
		$year_options = array(
			'fields' => array(
				'DISTINCT Left(Holiday.date,4) AS year'
			),
		);
		$years = $this->Holiday->find('all', $year_options);
		$holiday_years = array();
		foreach ($years as $year) {
			$holiday_years[] = $year[0]['year'];
		}
		sort($holiday_years);
		$this->set('holiday_years', $holiday_years);
		$this->set('holidays', $this->paginate($options));
		$this->set('display_year', $display_year);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$this->set('holiday', $this->Holiday->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$datearray = explode("/", $this->request->data['Holiday']['date']);
			$this->request->data['Holiday']['date'] = array(
				'month' => $datearray[0],
				'day' => $datearray[1],
				'year' => $datearray[2],
			);
			$this->Holiday->create();
				// check to see if this holiday falls inside an already created master
				$new_holiday = $this->request->data['Holiday']['date']['year'].'-'.$this->request->data['Holiday']['date']['month'].'-'.$this->request->data['Holiday']['date']['day'];
				$options = array(
					'conditions' => array(
						'Master.period_start_date <= ' => $new_holiday,
						'Master.period_end_date >= ' => $new_holiday,
					),
				);
				$master_check = $this->Master->find('first', $options);
				if($master_check) {
					//TODO
				}
				debug($master_check);
				$log = $this->Master->getDataSource()->getLog(false, false);
				debug($log);
			debug($this->request->data);die();
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'));
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
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Holiday->read(null, $id);
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
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		if ($this->Holiday->delete()) {
			$this->Session->setFlash(__('Holiday deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Holiday was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
