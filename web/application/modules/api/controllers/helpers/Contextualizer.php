<?php

class Api_Controller_Helper_Contextualizer  extends Zend_Controller_Action_Helper_Abstract
{
  public function preDispatch()
  {

    $controller = $this->getActionController();
    $request = $controller->getRequest();

    if (!preg_match("/^api/", $request->getModuleName())) {
      return;
    }

    $contextSwitch = $controller->getHelper("contextSwitch");
    $contextSwitch
    ->addActionContext('index','json')
    ->addActionContext('get','json')
    ->addActionContext('post','json')
    ->addActionContext('head','json')
    ->addActionContext('put','json')
    ->addActionContext('delete','json')
    ->initContext('json');

    $this->getResponse()->setHttpResponseCode(405);

  }
}
