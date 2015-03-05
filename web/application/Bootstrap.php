<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  public function _initREST()
  {
    $front = Zend_Controller_Front::getInstance();

    $router = $front->getRouter();

    $restRoute = new Zend_Rest_Route(
    $front, array(), array(
      'api'
    ));

    $router->addRoute('api', $restRoute);
  }

}
