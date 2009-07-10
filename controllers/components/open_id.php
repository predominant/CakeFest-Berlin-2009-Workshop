<?php
/**
 * A CakePHP OpenID consumer component for CakePHP
 * 
 * Based on work that is copyright (c) by Daniel Hofstetter (http://cakebaker.42dh.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class OpenIdComponent extends Object {

	protected $_controller = null;

	public function initialize($controller) {
		$this->_controller = $controller;
		$sep = PATH_SEPARATOR;
		$path = ini_get('include_path');
		ini_set('include_path', APP . '/vendors/' . $sep . VENDORS . $sep . $path);

		App::import('Vendor', 'consumer', array('file' => 'Auth/OpenID/Consumer.php'));
		App::import('Vendor', 'filestore', array('file' => 'Auth/OpenID/FileStore.php'));
		App::import('Vendor', 'sreg', array('file' => 'Auth/OpenID/SReg.php'));
	}

	/**
	 * @throws InvalidArgumentException if an invalid OpenID was provided
	 */
	public function authenticate($url, $return, $realm, $required = array(), $optional = array()) {
		if (empty($realm)) {
			$realm = 'http' . (env('HTTPS') ? 's' : '') . '://' . env('SERVER_NAME');
		}

		if (trim($url) != '') {
			$consumer = $this->_consumer();
			$authRequest = $consumer->begin($url);
		}
		
		if (!isset($authRequest) || !$authRequest) {
		    throw new InvalidArgumentException('Invalid OpenID');
		}
		$sregRequest = Auth_OpenID_SRegRequest::build($required, $optional);

		if ($sregRequest) {
			$authRequest->addExtension($sregRequest);
		}

		if (!$authRequest->shouldSendRedirect()) {
			$formId = 'openid_message';
			$formHtml = $authRequest->formMarkup($realm, $return, false , array('id' => $formId));

			if (Auth_OpenID::isFailure($formHtml)) {
				throw new Exception('Could not redirect to server: ' . $formHtml->message);
			}

			echo '<html><head><title>OpenID transaction in progress</title></head>' .
				 "<body onload='document.getElementById(\"{$formId}\").submit()'>" .
				 $formHtml . '</body></html>';
			exit;
		}
		$redirectUrl = $authRequest->redirectUrl($realm, $return);

		if (Auth_OpenID::isFailure($redirectUrl)) {
			throw new Exception('Could not redirect to server: ' . $redirectUrl->message);
		}
		$this->_controller->redirect($redirectUrl, null, true);
	}

	public function hasResponse() {
		return (count($_GET) > 1);
	}

	public function response($url) {
		$consumer = $this->_consumer();
		return $consumer->complete($url);
	}

	public function contents($response) {
		$sReg = Auth_OpenId_SRegResponse::fromSuccessResponse($response);
		return $sReg->contents();
	}

	protected function _consumer() {
		$storePath = TMP . 'openid';

		if (!file_exists($storePath) && !mkdir($storePath)) {
			$msg = "Could not create the FileStore directory {$storePath}. ";
			$msg .= "Please check the effective permissions.";
		    throw new Exception($msg);
		}
		$store = new Auth_OpenID_FileStore($storePath);
		return new Auth_OpenID_Consumer($store);
	}
}

?>