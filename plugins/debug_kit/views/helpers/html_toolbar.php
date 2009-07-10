<?php
/**
 * Html Toolbar Helper
 *
 * Injects the toolbar elements into HTML layouts.
 * Contains helper methods for
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org
 * @package       debug_kit
 * @subpackage    debug_kit.views.helpers
 * @since         DebugKit 0.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 **/
App::import('helper', 'DebugKit.Toolbar');

class HtmlToolbarHelper extends ToolbarHelper {
/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Javascript');
/**
 * settings property
 *
 * @var array
 * @access public
 */
	var $settings = array('format' => 'html', 'forceEnable' => false);
/**
 * Recursively goes through an array and makes neat HTML out of it.
 *
 * @param mixed $values Array to make pretty.
 * @param int $openDepth Depth to add open class
 * @param int $currentDepth current depth.
 * @return string
 **/
	function makeNeatArray($values, $openDepth = 0, $currentDepth = 0) {
		$className ="neat-array depth-$currentDepth";
		if ($openDepth > $currentDepth) {
			$className .= ' expanded';
		}
		$nextDepth = $currentDepth + 1;
		$out = "<ul class=\"$className\">";
		if (!is_array($values)) {
			if (is_bool($values)) {
				$values = array($values);
			}
			if (is_null($values)) {
				$values = array(null);
			}
		}
		foreach ($values as $key => $value) {
			$out .= '<li><strong>' . $key . '</strong>';
			if ($value === null) {
				$value = '(null)';
			}
			if ($value === false) {
				$value = '(false)';
			}
			if ($value === true) {
				$value = '(true)';
			}
			if (empty($value) && $value != 0) {
				$value = '(empty)';
			}

			if (is_object($value)) {
				$value = Set::reverse($value, true);
			}

			if (is_array($value) && !empty($value)) {
				$out .= $this->makeNeatArray($value, $openDepth, $nextDepth);
			} else {
				$out .= h($value);
			}
			$out .= '</li>';
		}
		$out .= '</ul>';
		return $out;
	}
/**
 * Create an HTML message
 *
 * @param string $label label content
 * @param string $message message content
 * @return string
 */
	function message($label, $message) {
		return sprintf('<p><strong>%s</strong> %s</p>', $label, $message);
	}
/**
 * Start a panel.
 * make a link and anchor.
 *
 * @return void
 **/
	function panelStart($title, $anchor) {
		$link = $this->Html->link($title, '#' . $anchor);
		return $link;
	}
/**
 * Create a table.
 *
 * @param array $rows Rows to make.
 * @param array $headers Optional header row.
 * @return string
 */
	function table($rows, $headers = array()) {
		$out = '<table class="debug-table">';
		if (!empty($headers)) {
			$out .= $this->Html->tableHeaders($headers);
		}
		$out .= $this->Html->tableCells($rows, array('class' => 'odd'), array('class' => 'even'), false, false);
		$out .= '</table>';
		return $out;
	}
/**
 * send method
 *
 * @return void
 * @access public
 */
	function send() {
		if (!$this->settings['forceEnable'] && Configure::read('debug') == 0) {
			return;
		}
		$view =& ClassRegistry::getObject('view');
		$head = $this->Html->css('/debug_kit/css/debug_toolbar');
		if (isset($view->viewVars['debugToolbarJavascript'])) {
			foreach ($view->viewVars['debugToolbarJavascript'] as $script) {
				if ($script) {
					$head .= $this->Javascript->link($script);
				}
			}
		}
		if (preg_match('#</head>#', $view->output)) {
			$view->output = preg_replace('#</head>#', $head . "\n</head>", $view->output, 1);
		}
		$toolbar = $view->element('debug_toolbar', array('plugin' => 'debug_kit', 'disableTimer' => true));
		if (preg_match('#</body>#', $view->output)) {
			$view->output = preg_replace('#</body>#', $toolbar . "\n</body>", $view->output, 1);
		}
	}
}
?>