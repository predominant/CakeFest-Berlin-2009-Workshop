<?php
/**
 * App Controller
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
class AppController extends Controller {
	//public $components = array('Acl', 'Auth', 'Security', 'Session', 'OpenId');
	public $components = array('Security', 'Session', 'OpenId');
	public $helpers = array('Form', 'Html', 'Javascript', 'Session');
//	public function beforeFilter() {
//		$this->Auth->authorized = 'crud';
//		$this->Auth->mapActions(array(
//			'read' => array('display')
//		));
//	}
	public function redirect($url) {
//		echo 'Redirect Attempted';
//		debug($url);
//		pr(Debugger::trace());
//		die();
	}
	protected function _authenticateOpenId($userOpenIdUrl) {
		$url = Router::url($this->params['url']['url'], true);
		
		if (!empty($userOpenIdUrl)) {
			try {
				$this->OpenId->authenticate($userOpenIdUrl, $url, array(), array('email'));
			} catch (Exception $e) {
				$this->User->invalidate('open_id_url', $e->getMessage());
			}
		}
	}
	protected function _handleOpenIdAuth() {
		$url = Router::url($this->params['url']['url'], true);
		$response = $this->OpenId->respone($url);
		
		switch($response->status) {
			case Auth_OpenId_CANCEL:
				$this->User->invalidate('open_id_url', __('OpenId verification cancelled', true));
				break;
			case Auth_OpenId_FAILURE:
				$this->User->invalidate('open_id_url', __('OpenId verification failed', true));
				break;
			case Auth_OpenId_SUCCESS:
				$data = $this->OpenId->contents($response);
				$user = $this->User->findByEmailAndOpenIdUrl(
					$data['email'],
					$response->endpoint->claimed_id
				);
				$this->Auth->login($user['User']['id']);
				$this->redirect($this->Auth->redirect());
				break;
		}
	}
}
?>