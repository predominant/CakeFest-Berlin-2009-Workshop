<?php
/**
 * Robot Task Model
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
class RobotTask extends AppModel {
	/**
	 * belongsTo bindings
	 *
	 * @var array
	 * @access public
	 */
	public $belongsTo = array('RobotTaskAction');

	/**
	 * Schedule an action for execution.
	 *
	 * @param mixed $action Either a TaskAction ID, or the action (such as /emails/send)
	 * @param array $parameters Extra parameters for the action (received in Controller::$params['robot'])
	 * @param mixed $scheduled A string to pass to strtotime(), or the time value
	 * @return mixed Result of save() call
	 * @access public
	 */
	public function schedule($action, $parameters = array(), $scheduled = null) {
		if (empty($scheduled)) {
			$scheduled = 'now';
		}

		if (is_string($scheduled)) {
			$scheduled = strtotime($scheduled);
		}

		$taskAction = $this->RobotTaskAction->action($action);
		if (empty($taskAction)) {
			return false;
		}

		$task = array($this->alias => array(
			'robot_task_action_id' => $taskAction['RobotTaskAction']['id'],
			'status' => 'pending',
			'scheduled' => date('Y-m-d H:i:s', $scheduled),
			'parameters' => (!empty($parameters) ? serialize($parameters) : null)
		));

		$this->create();
		$result = $this->save($task);

		if (!empty($result) && !empty($result[$this->alias])) {
			$result[$this->alias][$this->primaryKey] = $this->id;
		}

		return $result;
	}

	/**
	 * Set a task as started
	 *
	 * @param string $id Task ID
	 * @return mixed Result of save() call
	 * @access public
	 */
	public function started($id = null) {
		if (empty($id)) {
			$id = $this->id;
		}

		$task = array($this->alias => array(
			'id' => $id,
			'status' => 'running',
			'started' => date('Y-m-d H:i:s')
		));

		return $this->save($task, true, array_keys($task[$this->alias]));
	}

	/**
	 * Set a task as finished
	 *
	 * @param string $id Task ID
	 * @return mixed Result of save() call
	 * @access public
	 */
	public function finished($id = null, $success = true) {
		if (empty($id)) {
			$id = $this->id;
		}

		$task = array($this->alias => array(
			'id' => $id,
			'status' => ($success ? 'completed' : 'failed'),
			'finished' => date('Y-m-d H:i:s')
		));

		return $this->save($task, true, array_keys($task[$this->alias]));
	}

	/**
	 * Returns a result set array.
	 *
	 * @param array $conditions SQL conditions array, or type of find operation (all / first / count / neighbors / list / threaded)
	 * @param mixed $fields Either a single string of a field name, or an array of field names, or options for matching
	 * @param string $order SQL ORDER BY conditions (e.g. "price DESC" or "name ASC")
	 * @param integer $recursive The number of levels deep to fetch associated records
	 * @return array Array of records
	 * @access public
	 */
	public function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if (is_string($conditions) && $conditions == 'pending') {
			$cacheQueries = $this->cacheQueries;
			$this->cacheQueries = false;

			$limit = 1;
			if(!empty($fields['limit'])) {
				$limit = $fields['limit'];
				unset($fields['limit']);
			}

			$type = $conditions;
			$options = Set::merge(array(
				'recursive' => 0
				, 'conditions' => array(
					$this->alias . '.status' => 'pending',
					$this->alias . '.scheduled <=' => date('Y-m-d H:i:s')
				),
				'order' => array(
					'RobotTaskAction.weight' => 'asc',
					$this->alias . '.scheduled' => 'asc'
				),
				'limit' => $limit . ' FOR UPDATE'
			), (array) $fields);

			$this->begin();
			$tasks = parent::find('all', $options);
			if ($tasks === false) {
				$this->rollback();
			} else {
				foreach($tasks as $i => $task) {
					$task[$this->alias]['status'] = 'processing';

					$this->id = $task[$this->alias][$this->primaryKey];
					if ($this->saveField('status', 'processing')) {
						if (!empty($task[$this->alias]['parameters'])) {
							$task[$this->alias]['parameters'] = unserialize($task[$this->alias]['parameters']);
						}
						$tasks[$i] = $task;
					} else {
						unset($tasks[$i]);
					}
				}
				$this->commit();
			}

			$this->cacheQueries = $cacheQueries;

			if ($limit == 1 && !empty($tasks)) {
				reset($tasks);
				$tasks = current($tasks);
			}

			return $tasks;
		}
		return parent::find($conditions, $fields, $order, $recursive);
	}
}
?>