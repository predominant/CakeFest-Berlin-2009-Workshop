<?php
class PostsController extends AppController {
	public $helpers = array('Paginator');
	public function beforeFilter() {
		parent::beforeFilter();
		
		// Ensure that the 'add' action is accessed after a POST request only.
		$this->Security->requirePost('add');
	}
	public function home() {
	}
	public function index() {
		$this->paginate['Post'] = array(
			'limit' => 2,
			'order' => array('Post.created' => 'DESC')
		);
		$posts = $this->paginate('Post');
		$this->set(compact('posts'));
	}
	public function add() {
		if (!empty($this->data)) {
			if ($this->Post->add($this->data)) {
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
			'conditions' => array('id' => $id)
		));
		$this->set(compact('post'));
	}
}
?>