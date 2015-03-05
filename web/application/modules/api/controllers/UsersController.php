<?php
class Api_UsersController extends Zend_Rest_Controller
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

    //$twId = $this->getRequest()->getParam('twId', false);
    //$fbId = $this->getRequest()->getParam('fbId', false);
    //
    //


    $fbId = $this->getRequest()->getParam('fbId', false);
    $twId = $this->getRequest()->getParam('twId', false);

    $deviceId = $this->getRequest()->getParam('deviceId', false);

    if(
      !$fbId &&
      !$twId
    ) {
      $this->_helper->ResponseMessage('Missing fields on request', 417);
      return;
    }

    if (!$deviceId) {
      $this->_helper->ResponseMessage('Missing fields on request', 417);
      return;
    }

    // Get data
    $email = $this->getRequest()->getParam('email', false);

    $deviceType = $this->getRequest()->getParam('deviceType', false);
    if(!$deviceType) {
      $deviceType = 'unknown';
    }

    $loginType = $this->getRequest()->getParam('loginType', false);
    if(!$loginType) {
      $loginType = 'unknown';
    }

    $fbUsername = $this->getRequest()->getParam('fbUsername', null);
    $twUsername = $this->getRequest()->getParam('twUsername', null);
    $fbId = $this->getRequest()->getParam('fbId', null);
    $twId = $this->getRequest()->getParam('twId', null);
    $fbPicUrl = $this->getRequest()->getParam('fbPicUrl', null);
    $twPicUrl = $this->getRequest()->getParam('twPicUrl', null);

    // Get user
    $user = $this->_getExistingUser($deviceId);

    if ($user == null) {
      $user = new \tribialfeminista\Model\Users();

      // Write model
      $user
        ->setEmail($email)
        ->setDeviceId($deviceId)
        ->setDeviceType($deviceType)
        ->setLoginType($loginType)
        ->setFbUsername($fbUsername)
        ->setTwUsername($twUsername)
        ->setFbId($fbId)
        ->setTwId($twId)
        ->setFbPicUrl($fbPicUrl)
        ->setTwPicUrl($twPicUrl)
        ->setActive(1);

    } else {

      // Write model
      $user
        ->setDeviceId($deviceId)
        ->setDeviceType($deviceType)
        ->setLoginType($loginType);

      if ($email) {
        $user->setEmail($email);
      }

      if ($fbUsername) {
        $user->setFbUsername($fbUsername);
      }

      if ($twUsername) {
        $user->setTwUsername($twUsername);
      }

      if ($fbId) {
        $user->setFbId($fbId);
      }

      if ($twId) {
        $user->setTwId($twId);
      }

      if ($fbPicUrl) {
        $user->setFbPicUrl($fbPicUrl);
      }

      if ($twPicUrl) {
        $user->setTwPicUrl($twPicUrl);
      }

    }

    try {
      $user->save();
      $this->_helper->ResponseItem($user, [
        'id',
        'email',
        'active',
        'createdOn',
        'deviceId',
        'deviceType',
        'loginType',
        'fbId',
        'twId',
        'fbPicUrl',
        'twPicUrl',
        'fbUsername',
        'twUsername',
        'twId',
        'fbId',
        'twUsername',
        'fbUsername',
        'twPicUrl',
        'fbPicUrl'
        ]);
    } catch (Exception $e) {
      $this->_helper->ResponseMessage("Error saving user registry", 500);
    }

    return;


  }

  protected function _getExistingUser($deviceId) {

    $usersMapper = new \tribialfeminista\Mapper\Sql\Users();

    $user = $usersMapper->findOneByField('deviceId',$deviceId);

    return $user;
  }

  public function putAction()
  {
    if (!$this->_helper->ParamsChecker(array('uuid'))) {
      $this->_helper->ResponseMessage('Missing fields on request', 417);
      return;
    }


  }

  public function deleteAction()
  {
  }

}
