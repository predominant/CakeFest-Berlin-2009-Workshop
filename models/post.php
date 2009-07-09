<?php
class Post extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'counterCache' => true,
		)
	);
	public $hasOne = array('Tweet');
	public $validate = array(
		'text' => array(
			'required' => 'notEmpty',
			'length' => array(
				'rule' => array('between', 5, 140)
			)
		)
	);
	public function beforeSave() {
		if (!empty($this->data[$this->alias][$this->primaryKey])) {
			unset($this->data[$this->alias][$this->primaryKey]);
		}
		$this->data['Post']['user_id'] = '4a55e6f7-8b84-4974-8479-100fa77796a8';
		return true;
	}
	public function afterSave($data, $created = true) {
		$this->Tweet->save(array(
			'status' => $data[$this->alias]['text']
		));
	}
}
?>