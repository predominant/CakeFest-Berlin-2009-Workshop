<?php
/**
 * Users Controller
 *
 * Description.
 *
 * PHP Version 5.x
 *
 * CakePHP(tm) : Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2009, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class UsersController extends AppController {
	public function beforeFilter() {
//		$this->Auth->authorize = false;
		$this->Auth->allow('add');
		
//		if (isset($this->params['admin']) && $this->params['admin'] === true) {
//			$user = $this->Auth->user();
//			if ($user['User']['role'] != 'admin') {
//				$this->cakeError();
//			}
//		}

		parent::beforeFilter();
	}
	public function index() {
		$users = $this->User->find('all');
		$this->set(compact('users'));
	}
	public function admin_index() {
		$users = $this->User->find('all');
		$this->set(compact('users'));
	}
	public function add() {
		if (!empty($this->data)) {
			$this->data['User']['confirm_password'] = $this->Auth->password(
				$this->data['User']['confirm_password']
			);
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
	public function login() {
		if (!empty($this->data) && !empty($this->data['User']['open_id_url'])) {
			$this->_authenticateOpenId($this->data['User']['open_id_url']);
		} elseif ($this->OpenId->hasResponse()) {
			$this->_handleOpenIdAuth();
		}
	}
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	public function view() {
		$user = $this->User->findByUsername($this->params['username']);
		$this->set(compact('user'));
	}
}
?>