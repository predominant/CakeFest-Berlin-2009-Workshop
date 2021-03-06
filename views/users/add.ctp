<?php
/**
 * Add User View
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
echo $form->create();
//echo $form->input('email');
//echo $form->input('username');
//echo $form->input('password');
echo $form->inputs(array(
	'username',
	'email',
	'password',
	'confirm_password' => array('type' => 'password'),
	'open_id_url'));
echo $form->end('Add');
?>