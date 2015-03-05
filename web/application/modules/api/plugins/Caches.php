<?php
/**
* Inicialización y registro en bootstrap de caches
* @author Jabi Infante
*
*/

class Api_Plugin_Caches extends \Zend_Controller_Plugin_Abstract
{
  /**
  * @var Api_Bootstrap
  */
  protected $_bootstrap;

  public function routeShutdown(Zend_Controller_Request_Abstract $request)
  {
    //         if (!preg_match("/^api/", $request->getModuleName())) {
    //             return;
    //         }

    $this->_bootstrap = Zend_Controller_Front::getInstance()
    ->getParam('bootstrap')
    ->getResource('modules')
    ->offsetGet('api');

    $this->_initFastCache($request);
    $this->_initFileCache($request);
  }


  protected function _initFastCache(Zend_Controller_Request_Abstract $request)
  {
    $frontendOpts = array(
      'caching' => true,
      'lifetime' => 3600,
      'automatic_serialization' => true
    );

    $backendOpts = array(
      'servers' =>array(
        array(
          'host' => 'localhost',
          'port' => 11211
        )
      ),
      'compression' => false
    );

    $cache = Zend_Cache::factory('Core', 'Libmemcached', $frontendOpts, $backendOpts);

    $this->_bootstrap->setOptions(
    array(
    "fastCache" => $cache
    )
    );

  }

  protected function _initFileCache(Zend_Controller_Request_Abstract $request)
  {
    $frontendOpts = array(
    'caching' => true,
    'lifetime' => 36000,
    'automatic_serialization' => true
    );

    $backendOpts = array(
    'cache_dir' => APPLICATION_PATH . '/cache'
    //                 'file_name_prefix' => 'resizedImages'
    );

    $cache = Zend_Cache::factory('Core', 'File', $frontendOpts, $backendOpts);





    $this->_bootstrap->setOptions(
    array(
    "fileCache" => $cache
    )
    );

  }

}
