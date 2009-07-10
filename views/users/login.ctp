<?php
echo $form->create(array('action' => 'login'));
echo $form->input('username');
echo $form->input('password');
?><h4>Or, you can login with your OpenID</h4><?php
echo $form->input('open_id_url');
echo $form->end('Login');
?>