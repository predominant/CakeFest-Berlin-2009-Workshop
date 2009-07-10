<?php
/**
 * Posts Controller
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
class PostsController extends AppController {
	public $components = array('RequestHandler');
	public $helpers = array('Paginator', 'Text');
	public $paginate = array(
		'Post' => array(
			'limit' => 2,
			'order' => array('Post.created' => 'DESC'),
			'recursive' => -1
		)
	);
	public function beforeFilter() {
		parent::beforeFilter();
		// Ensure that the 'add' action is accessed after a POST request only.
		$this->Security->requirePost('add');
	}
	public function home() {
	}
	public function index() {
		if ($this->RequestHandler->prefers('rss')) {
			$this->paginate['Posts']['limit'] = 10;
		}
		$posts = $this->paginate('Post');
		$this->set(compact('posts'));
	}
	public function add() {
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('Your post has been saved.', true));
				$this->redirect(array('controller' => 'posts', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Failed saving your post.', true));
			}
		}
		$this->setAction('home');
	}
	public function view($id) {
		$post = $this->Post->find('first', array(
			'conditions' => array('Post.id' => $id),
			'recursive' => -1
		));
		$this->set(compact('post'));
	}
}
?>