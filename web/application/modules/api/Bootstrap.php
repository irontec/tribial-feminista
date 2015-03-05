<?php

class Api_Bootstrap extends Zend_Application_Module_Bootstrap
{

  /**
  * Constructor
  *
  * @param  Zend_Application|Zend_Application_Bootstrap_Bootstrapper
  *     $application
  * @return void
  */
  public function __construct($application)
  {
    parent::__construct($application);
  }

  public function _initAutoload()
  {
    $autoloader = new Zend_Application_Module_Autoloader(
    array(
      'namespace' => 'Api',
      'basePath'  => __DIR__,
    )
  );
  
  $autoloader->addResourceType('actionhelpers', 'controllers/helpers/', 'Controller_Helper');
  $autoloader->addResourceType('exceptions', 'exceptions/', 'Exception');

  Zend_Controller_Action_HelperBroker::addPath(
  __DIR__ . '/controllers/helpers',
  'Api_Controller_Helper_'
);

return $autoloader;
}


public function _initPlugins()
{
  $front = $this->bootstrap("FrontController")->getResource("FrontController");

  //         $front->registerPlugin(new Api_Plugin_Caches());
  $front->registerPlugin(new Api_Plugin_ParamsParser());
}

public function _initContexts()
{
  Zend_Controller_Action_HelperBroker::addHelper(
  new Api_Controller_Helper_Contextualizer()
  );
}


}
