<?php
class Api_PackagesController extends Zend_Rest_Controller
{

  protected $_request;

  public function init()
  {
    $this->getResponse()->setHttpResponseCode(500);
    $this->_request = $this->getRequest();
  }

  /**
  * @ApiDescription(section="Packages", description="<p><b>Get Packages List.</b></p>")
  * @ApiMethod(type="get")
  * @ApiRoute(name="/tribialfeminista/api/packages")
  * @ApiParams()
  * @ApiReturnHeaders(sample="HTTP 200 Ok")
  * @ApiReturn(type="object", sample="{
  *    'content': {
  *        'collection': [
  *            {
  *                'id': 'string',
  *                'name': 'string'
  *            },
  *            {
  *                'id': 'string',
  *                'categoryName': 'string'
  *            }
  *        ],
  *        'total': 'int'
  *    }
  * }")
  */
public function indexAction()
{
  $packagesMapper = new \tribialfeminista\Mapper\Sql\Packages();
  $packagesModels = $packagesMapper->fetchList(null, null);
  $packagesFields = array('id', 'code');
  $this->_helper->ResponseCollection($packagesModels, $packagesFields);
}

public function getAction()
{
  if (!$this->_helper->ParamsChecker(array('id'))) {
    $this->_helper->ResponseMessage('Missing fields on request', 417);
    return;
  }
  $packageId = $this->_request->getParam('id');

  $questionsMapper = new \tribialfeminista\Mapper\Sql\Questions();
  $questionsModels = $questionsMapper->findByField('packageId',$packageId);
  $questionsFields = array(
    'id',
    'category',
    'packageId',
    'question_eu', 'question_es',
    'answer_eu', 'answer_es',
    'falseAnswer1_eu', 'falseAnswer1_es',
    'falseAnswer2_eu', 'falseAnswer2_es',
    'falseAnswer3_eu', 'falseAnswer3_es',
    'checked');

  $this->_helper->ResponseCollection($questionsModels, $questionsFields, null);
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
