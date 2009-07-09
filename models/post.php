<?php
class Post extends AppModel {
	public $validate = array(
		'text' => array(
			'required' => 'notEmpty',
			'length' => array(
				'rule' => array('between', 5, 140)
			)
		)
	);
	public function add($data) {
		if (!empty($data[$this->alias][$this->primaryKey])) {
			unset($data[$this->alias][$this->primaryKey]);
		}
		$this->create();
		return $this->save($data) !== false;
	}
}
?>