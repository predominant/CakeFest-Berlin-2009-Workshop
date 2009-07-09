<ul>
	<?php foreach ($users as $user): ?>
		<li><?php echo $user['User']['email']; ?> -
		<?php echo $user['User']['username']; ?> -
		(<?php echo $user['User']['posts_count']; ?>)</li>
	<?php endforeach; ?>
</ul>