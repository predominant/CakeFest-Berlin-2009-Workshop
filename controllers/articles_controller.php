<?php
/**
 * Articles Controller
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
class ArticlesController extends AppController {

	var $name = 'Articles';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Article.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('article', $this->Article->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Article->create();
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('The Article has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Article could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Article', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('The Article has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Article could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Article->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Article', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Article->del($id)) {
			$this->Session->setFlash(__('Article deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>