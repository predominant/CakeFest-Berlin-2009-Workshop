<?php
class TweetsController extends AppController {
	public function index() {
		$tweets = $this->Tweet->find('all');
		$this->set(compact('tweets'));
	}
	public function add() {
		$this->Tweet->save(array('status' => 'This is an update'));
		die();
	}
}
?>