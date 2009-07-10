<?php
/**
 * Post Model
 *
 * Description
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
	public function afterSave($created = true) {
		$this->Tweet->save(array(
			'status' => $this->data[$this->alias]['text']
		));
	}
}
?>