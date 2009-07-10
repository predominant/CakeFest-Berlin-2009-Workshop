<?php
class RobotTaskAction extends AppModel {
	/**
	 * hasMany bindings
	 *
	 * @var array
	 * @access public
	 */
	public $hasMany = array('RobotTask');

	/**
	 * Get the TaskAction, creating it if it doesn't exist
	 *
	 * @param midex $action Either an ID, or an action (such as /emails/send)
	 * @return mixed Array of action data, or false
	 * @access public
	 */
	public function action($action) {
		$conditions = array();
		if (is_numeric($action)) {
			$conditions[$this->alias . '.' . $this->primaryKey] = $action;
		} else {
			$conditions[$this->alias . '.action'] = $action;
		}
		if (empty($conditions)) {
			return false;
		}

		$cacheQueries = $this->cacheQueries;
		$this->cacheQueries = false;

		$taskAction = $this->find('first', array(
			'conditions' => $conditions,
			'recursive' => -1
		));

		$this->cacheQueries = $cacheQueries;

		if (!empty($taskAction)) {
			return $taskAction;
		} elseif (is_numeric($action)) {
			return false;
		}

		$taskAction = array('RobotTaskAction' => array(
			'action' => $action
		));

		$this->create();
		if ($this->save($taskAction)) {
			$this->cacheQueries = false;

			$taskAction = $this->find('first', array(
				'conditions' => array($this->alias . '.' . $this->primaryKey => $this->id),
				'recursive' => -1
			));
			$this->cacheQueries = $cacheQueries;
		} else {
			$taskAction = false;
		}

		return $taskAction;
	}
}

?>