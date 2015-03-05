<?php
class Api_ScoresController extends Zend_Rest_Controller
{

  protected $_request;

  public function init()
{
  $this->getResponse()->setHttpResponseCode(500);
  $this->_request = $this->getRequest();
}

public function indexAction()
{
  $scoresMapper = new \tribialfeminista\Mapper\Sql\Scores();
  $scoresModels = $scoresMapper->fetchList(null, 'score desc', 20);
  $scoresFields = array('user', 'score');
  $childrenFields = array();
  $childrenFields['user'] = array(
    'id',
    'loginType',
    'fbId',
    'twId',
    'fbPicUrl',
    'twPicUrl',
    'fbUsername',
    'twUsername'
  );

  $this->_helper->ResponseCollection($scoresModels, $scoresFields, $childrenFields);
}

public function getAction()
{

}

public function headAction()
{
}

public function postAction()
{
  $userId = $this->_request->getParam("userId", false);
  $score = $this->_request->getParam("score", false);

  if (!$userId || !$userId) {
    $this->_helper->ResponseMessage("Missing fields on request", 417);
    return;
  }

  

  $scoreModel = new \tribialfeminista\Model\Scores();

  $scoreModel
  ->setUserId($userId)
  ->setScore($score);

  try {
    $scoreModel->save();
    $this->_helper->ResponseMessage("Score registry saved", 200);
  } catch (Exception $e) {
    $this->_helper->ResponseMessage("Error saving score registry", 500);
  }
}

public function putAction()
{
}

public function deleteAction()
{
}

}
