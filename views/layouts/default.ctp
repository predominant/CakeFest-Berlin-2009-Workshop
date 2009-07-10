<?php
/**
 * Default Layout
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
?>
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
