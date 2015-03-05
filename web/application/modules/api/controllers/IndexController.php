<?php
class Api_IndexController extends Zend_Rest_Controller
{

  protected $_request;

  public function init()
  {
    $this->getResponse()->setHttpResponseCode(500);
    $this->_request = $this->getRequest();
  }

  public function indexAction()
  {
  }

  public function getAction()
  {
  }

  public function headAction()
  {
  }

  public function postAction()
  {
  }

  public function putAction()
  {
  }

  public function deleteAction()
  {
  }

}
