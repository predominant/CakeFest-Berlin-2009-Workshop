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