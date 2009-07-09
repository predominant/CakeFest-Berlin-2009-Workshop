<?php
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
		// Example "terms and conditions" validation rule
//		'agree_to_terms' => array(
//			'rule' => 'notEmpty',
//			'on' => 'create'
//		)
	);
	
	public function shouldNotMatchController($field) {
		$controllers = Configure::listObjects('controller');
		if (in_array(current($field), $controllers)) {
			return current($field) . ' is an illegal username';
		}
		return true;
	}
}
?>