<?php
class Api_Controller_Helper_ResponseContent extends Zend_Controller_Action_Helper_Abstract
{

  protected function _responseContent($content, $code)
  {


    $this->getResponse()->setHttpResponseCode($code);
    $this->getResponse()->setHeader('Content-type', 'application/json; charset=UTF-8;');
    $view = $this->getActionController()->view;
    if (!is_array($view->content)) {
      $view->content = array();
    }

    $view->content = array_merge($view->content, $content);

  }

  public function direct($content, $code)
  {
    return $this->_responseContent($content, $code);
  }

}
