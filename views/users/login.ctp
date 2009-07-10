<?php
echo $form->create(array('action' => 'login'));
echo $form->input('username');
echo $form->input('password');
echo $form->end('Login');
?>