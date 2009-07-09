<?php
class Post extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'counterCache' => true,
		)
	);
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
		$data['Post']['user_id'] = '4a55e6f7-8b84-4974-8479-100fa77796a8';
		return $this->save($data) !== false;
	}
}
?>