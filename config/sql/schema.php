<?php 
/**
 * Default Schema
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
class CakeFestWorkingSchema extends CakeSchema {
	var $name = 'CakeFestWorking';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $posts = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'index'),
		'source_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'index'),
		'text' => array('type' => 'string', 'null' => false, 'length' => 140),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'profile_id' => array('column' => 'user_id', 'unique' => 0), 'source_id' => array('column' => 'source_id', 'unique' => 0))
	);
	var $users = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'group_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'index'),
		'email' => array('type' => 'string', 'null' => false),
		'username' => array('type' => 'string', 'null' => false, 'key' => 'unique'),
		'password' => array('type' => 'text', 'null' => false),
		'posts_count' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1), 'group_id' => array('column' => 'group_id', 'unique' => 0))
	);
}
?>