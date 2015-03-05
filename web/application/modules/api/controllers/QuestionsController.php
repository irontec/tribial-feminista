<?php
class Api_QuestionsController extends Zend_Rest_Controller
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

  /* ONLY FOR MANAGE PURPOSE */
  public function putAction()
  {

    $questionId = $this->getRequest()->getParam('id', false);

    if (!$questionId) {
      $this->_helper->ResponseMessage('Missing fields on request', 417);
      return;
    }

    $question_es = $this->getRequest()->getParam('question_es', null);
    $question_eu = $this->getRequest()->getParam('question_eu', null);

    $answer_es = $this->getRequest()->getParam('answer_es', null);
    $answer_eu = $this->getRequest()->getParam('answer_eu', null);

    $falseAnswer1_es = $this->getRequest()->getParam('falseAnswer1_es', null);
    $falseAnswer1_eu = $this->getRequest()->getParam('falseAnswer1_eu', null);

    $falseAnswer2_es = $this->getRequest()->getParam('falseAnswer2_es', null);
    $falseAnswer2_eu = $this->getRequest()->getParam('falseAnswer2_es', null);

    $falseAnswer3_es = $this->getRequest()->getParam('falseAnswer3_es', null);
    $falseAnswer3_eu = $this->getRequest()->getParam('falseAnswer3_eu', null);

    $checked = $this->getRequest()->getParam('checked', false);

    $question = $this->_getQuestion($questionId);

    if(!$question) {
      $this->_helper->ResponseMessage('Question Not Found', 404);
      return;
    }

    if ($question_es) {
      $question->setQuestionES($question_es);
    }

    if ($question_eu) {
      $question->setQuestionEU($question_eu);
    }

    if ($answer_es) {
      $question->setAnswerES($answer_es);
    }

    if ($answer_eu) {
      $question->setAnswerES($answer_eu);
    }

    if ($falseAnswer1_es) {
      $question->setFalseAnswer1ES($falseAnswer1_es);
    }

    if ($falseAnswer1_eu) {
      $question->setFalseAnswer1EU($falseAnswer1_eu);
    }

    if ($falseAnswer2_es) {
      $question->setFalseAnswer2ES($falseAnswer2_es);
    }

    if ($falseAnswer2_eu) {
      $question->setFalseAnswer2EU($falseAnswer2_eu);
    }

    if ($falseAnswer3_es) {
      $question->setFalseAnswer3ES($falseAnswer3_es);
    }

    if ($falseAnswer3_eu) {
      $question->setFalseAnswer3EU($falseAnswer3_eu);
    }

    $question->setChecked($checked);

    try {
      $question->save();
      $this->_helper->ResponseMessage("Question Updated Succesful", 200);
    } catch (Exception $e) {
        $this->_helper->ResponseMessage("Error updating question registry", 500);
    }

    return;
  }

  public function _getQuestion($id) {
    $questionsMapper = new \tribialfeminista\Mapper\Sql\Questions();

    $question = $questionsMapper->findOneByField('id',$id);

    return $question;
  }

  public function deleteAction()
  {
  }

  public function optionsAction()
  {
    $this->_response->setHttpResponseCode(200);
    $this->_helper->json(array('action' => 'options'));
  }

}
