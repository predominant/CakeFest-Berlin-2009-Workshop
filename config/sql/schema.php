<?php 
/* SVN FILE: $Id$ */
/* CakeFestWorking2 schema generated on: 2009-07-10 18:07:07 : 1247215387*/
class CakeFestWorking2Schema extends CakeSchema {
	var $name = 'CakeFestWorking2';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $articles = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'text' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $posts = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'index'),
		'source_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'index'),
		'text' => array('type' => 'string', 'null' => false, 'length' => 140),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'profile_id' => array('column' => 'user_id', 'unique' => 0), 'source_id' => array('column' => 'source_id', 'unique' => 0))
	);
	var $robot_task_actions = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'action' => array('type' => 'string', 'null' => false, 'key' => 'unique'),
		'weight' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false),
		'modified' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'action' => array('column' => 'action', 'unique' => 1))
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