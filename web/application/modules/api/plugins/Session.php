<?php
/**
* Inicialización y registro en bootstrap de caches
* @author Jabi Infante
*
*/

class Api_Plugin_Session extends \Zend_Controller_Plugin_Abstract
{
  /**
  * @var Api_Bootstrap
  */
  protected $_bootstrap;

  public function routeShutdown(Zend_Controller_Request_Abstract $request)
  {
    if (!preg_match("/^api/", $request->getModuleName())) {
      return;
    }

    $this->_bootstrap = Zend_Controller_Front::getInstance()
    ->getParam('bootstrap')
    ->getResource('modules')
    ->offsetGet('api');

    $this->_initSession($request);
  }


  protected function _initSession(Zend_Controller_Request_Abstract $request)
  {

    $session = new Zend_Session_Namespace('userData');

    $this->_bootstrap->setOptions(
    array(
      "currentSession" => $session
    )
  );

}

}
