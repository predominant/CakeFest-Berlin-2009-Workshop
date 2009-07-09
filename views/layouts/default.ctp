<?php echo $html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout;?>
	</title>
	<?php
	echo $html->meta('icon');
	echo $html->css('base');
	echo $javascript->link('jquery-1.3.2');
	echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>CakeFest 2009</h1>
		</div>
		<div id="content">
			<?php
				$session->flash();
				$session->flash('auth');
				echo $content_for_layout;
			?>
		</div>
		<div id="footer">
			<?php
			echo $html->link(
				$html->image('cake.power.gif', array('border' => 0)),
				'http://www.cakephp.org/', array('target'=>'_blank'), null, false
			);
			?>
		</div>
	</div>
	<?php echo $cakeDebug?>
</body>
</html>
