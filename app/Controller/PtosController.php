<?php
App::uses('AppController', 'Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 */
class PtosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pto->recursive = 0;
		$this->set('ptos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Pto->id = $id;
		if (!$this->Pto->exists()) {
			throw new NotFoundException(__('Invalid Pto'));
		}
		$this->set('pto', $this->Pto->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pto->create();
			if ($this->Pto->save($this->request->data)) {
				$this->Session->setFlash(__('The Pto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Pto could not be saved. Please, try again.'));
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
		$this->Pto->id = $id;
		if (!$this->Pto->exists()) {
			throw new NotFoundException(__('Invalid Pto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pto->save($this->request->data)) {
				$this->Session->setFlash(__('The Pto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Pto could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Pto->read(null, $id);
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
		$this->Pto->id = $id;
		if (!$this->Pto->exists()) {
			throw new NotFoundException(__('Invalid Pto'));
		}
		if ($this->Pto->delete()) {
			$this->Session->setFlash(__('Pto deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pto was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
