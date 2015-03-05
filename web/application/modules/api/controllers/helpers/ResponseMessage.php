<?php
class Api_Controller_Helper_ResponseMessage extends Api_Controller_Helper_ResponseContent
{
  public function direct($msg, $code)
  {
    return $this->_responseContent(array('message'=>$msg), $code);
  }

}
