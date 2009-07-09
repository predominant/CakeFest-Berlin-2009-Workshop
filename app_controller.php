<?php
class AppController extends Controller {
	public $components = array('Security', 'Session');
	public $helpers = array('Form', 'Html', 'Javascript', 'Session');
}
?>