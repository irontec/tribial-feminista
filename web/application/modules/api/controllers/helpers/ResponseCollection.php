<?php

class Api_Controller_Helper_ResponseCollection extends Api_Controller_Helper_ResponseItem
{

  // Si ItemCallbak es un closure, se invocará con la entiudad iterada.
  public function direct($collection, $fields, $childrenFields = null, $lang = null, $code = 200, $itemCallback = null)
  {
    $items = array();
    $total = 0;

    if (is_array($collection) && sizeof($collection)> 0) {

      foreach ($collection as $entity) {
        if ($itemCallback instanceof Closure) {
          $itemCallback($entity);
        }
        $items[] = $this->_buildItem($entity, $fields, $childrenFields, $lang);
        $total++;
      }
    }


    return $this->_responseContent(array('collection'=>$items,'total'=>$total), $code);
  }


}
