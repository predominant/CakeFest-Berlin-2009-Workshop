<?php
/**
 * Home Posts View
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
echo $form->create('Post', array(
	'url' => array('controller' => 'posts', 'action' => 'add'),
	'errors' => array(
		'required' => __('This field must not be blank', true),
		'length' => __('Message must be between 5 and 140 characters long', true)
	)));
echo $form->input('text');
echo $form->submit();
echo $form->end();
?>