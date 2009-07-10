<?php
/**
 * User Model
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
class User extends AppModel {
	public $hasMany = 'Post';
	public $validate = array(
		'username' => array(
			'notEmpty',
			array('rule' => 'shouldNotMatchController')
		),
		'email' => array(
			array(
				'rule' => 'isUnique',
				'on' => 'create'
			),
		),
		'password' => array(
			'rule' => 'checkPassword',
			'on' => 'create'
		)
		// Example "terms and conditions" validation rule
//		'agree_to_terms' => array(
//			'rule' => 'notEmpty',
//			'on' => 'create'
//		)
	);
	
	public $actsAs = array('Acl' => 'requester');
	
	public function shouldNotMatchController($field) {
		$controllers = Configure::listObjects('controller');
		if (in_array(current($field), $controllers)) {
			return current($field) . ' is an illegal username';
		}
		return true;
	}
	public function checkPassword($field) {
		return current($field) == $this->data['User']['confirm_password'];
	}
	
	public function parentNode($object) {
		return null;
	}
	
	public function bindNode($object) {
		if (isset($object['User']['role'])) {
			return 'Roles/' . $object['User']['role'];
		}
	}
}
?>