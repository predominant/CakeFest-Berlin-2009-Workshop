<?php
/**
 * Admin Index Users View
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
<ul>
	<?php foreach ($users as $user): ?>
		<li><?php echo $user['User']['email']; ?> -
		<?php echo $user['User']['username']; ?> -
		(<?php echo $user['User']['posts_count']; ?>)</li>
	<?php endforeach; ?>
</ul>