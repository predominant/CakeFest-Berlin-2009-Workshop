<?php
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