<?php
class User extends AppModel {
	public $hasMany = 'Post';
	public $validate = array(
		'username' => array(
			'notEmpty',
			'shouldNotMatchController'
		)
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