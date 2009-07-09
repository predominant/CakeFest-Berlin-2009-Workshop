<?php
$data = array();

foreach ($posts as $i => $post) {
	$link = Router::url(array(
		'action' => 'view',
		'slug' => Inflector::slug($post['Post']['text']),
		'id' => $post['Post']['id']
	), true);

	$data[] = array(
		'title' => $text->truncate($post['Post']['text'], 20),
		'description' => $post['Post']['text'],
		'link' => $link,
		'guid' => $link,
		'pubDate' => $post['Post']['created']
	);
}

echo $rss->items($data);
?>
