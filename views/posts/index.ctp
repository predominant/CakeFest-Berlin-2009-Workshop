<?php
/**
 * Index Posts View
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
<p><?php echo $paginator->counter(array(
	'format' => 'Page %page% out of %pages% pages, showing %current% records of a total %count%.'
)); ?></p>

<p>Sort by <?php echo $paginator->sort('Creation Date', 'created'); ?></p>

<?php foreach ($posts as $post): ?>
	<p><?php echo $post['Post']['text']; ?> -
	<?php echo $html->link(
		'Read more..',
		array(
			'controller' => 'posts', 
			'action' => 'view',
			'slug' => Inflector::slug($post['Post']['text']),
			'id' => $post['Post']['id'])); ?></p>
<?php endforeach; ?>

<p><?php echo $paginator->numbers(); ?></p>