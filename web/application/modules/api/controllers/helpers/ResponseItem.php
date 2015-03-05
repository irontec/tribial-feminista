<?php

use Goplay\Mapper\Sql\GeneralConfiguration;
class Api_Controller_Helper_ResponseItem extends Api_Controller_Helper_ResponseContent
{
  protected $_autoCastToBoolean = array(
    "finished"
  );

  protected $_dateTimeFields = array(
    "date",
    "finishDate",
    "creationDate"
  );

  protected $_dateFields = array(
  );

  protected $_autoInjectHTML = array(
  );

  protected function _getGetters($fields, $entity)
  {
    $getters = array();
    foreach ($fields as $field) {
      if($this->_isLanguageField($field)) {
        $getters[$field] = $this->_generateLanguageGetter($field);
      } else {
        if($entity->varNameToColumn($field)) {
          $getters[$field] = 'get' . $entity->varNameToColumn($field);
        } else {
          $getters[$field] = 'get' . $field;
        }

      }
    }
    return $getters;
  }

  protected function _generateLanguageGetter($field) {
    $explodedField = explode("_", $field, 10);
    $imploded = implode($explodedField);
    return 'get' . $imploded;
  }

  protected function _isLanguageField($field) {
    if($this->_endsWith($field, '_es') ||
      $this->_endsWith($field, '_eu') ||
      $this->_endsWith($field, '_en')){
          return true;
    }
    return false;
  }

  protected function _endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    if (strpos($haystack, $needle) !== false) {
      return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
    }
    return false;
  }

  protected function _buildItem($entity, $fields, $childrenFields = null, $lang = null)
  {

    $availableLangs = $entity->getAvailableLangs();
    if (is_null($lang) || !in_array($lang, $availableLangs)) {
      $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
      $apiOptions = $config->getOption("api");
      $lang = $apiOptions["defaultLang"];
    }

    $getters = $this->_getGetters($fields, $entity);
    $item = array();

    foreach ($getters as $field => $getter) {

      $itemFromGetter = $entity->{$getter}($lang);

      if (is_object($itemFromGetter) && strpos(get_class($itemFromGetter),'Model') !== false) {
        if(is_array($childrenFields) && array_key_exists($field, $childrenFields)) {

          $childFields = $childrenFields[$field];

          $childGetters = $this->_getGetters($childFields, $itemFromGetter);
          $item[$field] = array();

          foreach($childGetters as $childField => $childGetter) {
            $item[$field][$childField] = $itemFromGetter->{$childGetter}($lang);
          }
        } else {
            $item[$field] = $itemFromGetter;
        }

      } else {
        $item[$field] = $itemFromGetter;
      }



      if (is_null($item[$field])) {
        $item[$field] = '';
      }

      if (in_array($field, $this->_autoCastToBoolean)) {
        $item[$field] = (bool)$item[$field];
      }

      if (in_array($field, $this->_dateTimeFields)) {
        if ($date = $entity->{$getter}(true)) {
          $date->setTimezone(date_default_timezone_get());
          $item[$field] = $date->toString();
        }
      }


      if (in_array($field, $this->_dateFields)) {
        if ($date = $entity->{$getter}(true)) {
          $date->setTimezone(date_default_timezone_get());
          $item[$field] = $date->toString(Zend_Date::DATES);
        }
      }

      if (in_array($field, $this->_autoInjectHTML)) {

        $item[$field] = $this->_buildHTMLField($item[$field]);
      }


    }

    return $item;
  }



  /**
  * Deprecated (for windows)
  * @return boolean
  */
  protected function _mustSplitHTML()
  {

    $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    $apiBootstrap = $bootstrap->getResource('modules')->offsetGet('api');
    $session = $apiBootstrap->getOption("currentSession");

    $currentDevice = $session->currentDevice;

    $splitableHTMLDevices = array("windows");
    return in_array($currentDevice->getDeviceType(),$splitableHTMLDevices);

  }

  protected function _buildHTMLField($content)
  {
    $head = GeneralConfiguration::fetchAttribute("htmlHead");
    $foot = GeneralConfiguration::fetchAttribute("htmlFoot");

    return $head . $content . $foot;

    if (empty($content)) {
      return array('');
    }

    $DOM = new DOMDocument;
    $DOM->loadHTML($content);
    $body = $DOM->getElementsByTagName("body")->item(0);

    $max = 40;

    $fragment = '';
    $retContent = array();

    foreach($body->childNodes as $node) {
      if ($node->nodeType != 1) {
        continue;
      }

      $node->normalize();
      $fragment .= $node->C14N();

      if (strlen($fragment) > $max) {
        $retContent[] = $head . $fragment . $foot;
        $fragment = '';
      }
    }

    if (!empty($fragment)) {
      $retContent[] = $head . $fragment . $foot;
    }
    return $retContent;
  }

  public function direct($entity, $fields, $childrenFields = null, $lang = null, $code = 200)
  {
    $item = array();

    if (is_object($entity)) {
      $item = $this->_buildItem($entity, $fields, $childrenFields, $lang);
      $content = array('item'=>$item);
    } else {
      $code = 404;
      $content = array('message'=>'Item not found');
    }

    return $this->_responseContent($content, $code);
  }


}
