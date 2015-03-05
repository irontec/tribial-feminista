<?php
/**
* Plugin encargado de instanciar Zend_Auth si está definido en klear.yaml
* @author Luis García
*
*/

class Api_Plugin_Auth extends \Zend_Controller_Plugin_Abstract
{

  protected $_unattendedRequests = array(
    array(
      'controller' => 'login',
      'method' => 'post',
      'params' => array()
    ),
    array(
      'controller' => 'resetpassword',
      'method' => 'put',
      'params' => array()
    ),
    array(
      'controller' => 'users',
      'method' => 'post',
      'params' => array()
    ),
  );

  protected $_whiteRoutesList = array(
  );

  /**
  * Este método se ejecuta una vez se ha matcheado la ruta adecuada
  * (non-PHPdoc)
  * @see Zend_Controller_Plugin_Abstract::routeShutdown()
  */
  public function routeShutdown(Zend_Controller_Request_Abstract $request)
  {

    if (!preg_match("/^api/", $request->getModuleName())) {
      return;
    }

    $front = Zend_Controller_Front::getInstance();

    if (get_class($front->getRouter()) == 'Iron_Controller_Router_Cli') {
      return;
    }

    $currentRoute = $front->getRouter()->getCurrentRouteName();

    if (in_array($currentRoute, $this->_whiteRoutesList)) {
      return;
    }

    $this->_initAuth($request);

  }

  protected function _initAuth(Zend_Controller_Request_Abstract $request)
  {

    $storage = new Zend_Auth_Storage_Session('ohitu');
    $auth = Zend_Auth::getInstance();
    $auth->setStorage($storage);

    if ($auth->hasIdentity()) {
      $user = $auth->getIdentity();
      if (is_null($user)) {
        $auth->clearIdentity();
      } else {
        return;
      }

    }

    $currentController = $request->getControllerName();

    //         /*
    //          * Si venimos desde consola, permitimos el acceso global.
    //          */
    $front = Zend_Controller_Front::getInstance();


    foreach($this->_unattendedRequests as $allowedRequest) {
      if ($currentController != $allowedRequest['controller']) {
        // Continue to 405, forbidden!
        continue;
      }

      $methodChecker = 'is' . ucfirst($allowedRequest['method']);

      if (!$request->{$methodChecker}()) {
        // Continue to 405, forbidden!
        continue;
      }

      // diff should not have any item, after array_diff,
      // if all params are present
      $diff = array_diff($allowedRequest['params'], array_keys($request->getParams()));
      if (sizeof($diff) == 0) {
        // Access granted!
        return;
      }
    }


    // 405, method not allowed
    $request
    ->setControllerName('login')
    ->setActionName('index');

  }

}
