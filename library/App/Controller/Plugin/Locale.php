<?php
class App_Controller_Plugin_Locale extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$lang = $this->getRequest()->getParam('lang', false);
		$session = new Zend_Session_Namespace('Zend_Locale');
		if (false === $lang) {
			$lang = (!isset ($session->lang) ? 'en' : $session->lang);
		}
		$session->lang = $lang;
		$translate = Zend_Registry::get('Zend_Translate');
		$translate->setLocale(new Zend_Locale($lang));

		Zend_Registry::set('Zend_Translate', $translate);
		$this->getRequest()->setParam('lang', $session->lang);
	}
}