<?php
/**
 * RSS Index Posts View
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
