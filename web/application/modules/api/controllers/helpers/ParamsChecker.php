<?php
class Api_Controller_Helper_ParamsChecker extends Zend_Controller_Action_Helper_Abstract
{

  public function direct($params, $checkEmpty = false)
  {
    if (!is_array($params)) {
      throw new \Exception("Invalid parameter passed to ParamsChecker helper. Array excepted.");
    }

    $request = $this->getRequest();

    foreach($params as $param) {
      if ($request->getParam($param, false) === false) {
        return false;
      }

      if ($checkEmpty === true) {
        $param = $request->getParam($param);
        if (empty($param)) {
          return false;
        }
      }
    }
    return true;

  }

}
