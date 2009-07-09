<?php
class UsersController extends AppController {
	public function index() {
		$users = $this->User->find('all');
		$this->set(compact('users'));
	}
	public function add() {
		if (!empty($this->data)) {
			$this->User->save($this->data);
		}
	}
	// Example Admin Add function
//	public function admin_add() {
//		if (!empty($this->data)) {
//			// Suppress validation
//			$this->User->save($this->data, false);
//		}
//	}
	public function view() {
		$user = $this->User->findByUsername($this->params['username']);
		$this->set(compact('user'));
	}
}
?>