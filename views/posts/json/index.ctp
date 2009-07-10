<?php
foreach ($posts as $i => $post) {
	$post['url'] = Router::url(array(
		'controller' => 'posts',
		'action' => 'view',
		'slug' => Inflector::slug(Inflector::truncate($post['Post']['text'], 30)),
		'id' => $post['Post']['id']
	));
}
echo $javascript->object($posts);
?>