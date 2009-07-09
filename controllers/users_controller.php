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
	public function view() {
		$user = $this->User->findByUsername($this->params['username']);
		$this->set(compact('user'));
	}
}
?>