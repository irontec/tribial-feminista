<?php

/**
 * Application Model
 *
 * @package tribialfeminista\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package tribialfeminista\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace tribialfeminista\Model\Raw;
class Questions extends ModelAbstract
{

    protected $_categoryAcceptedValues = array(
        'e',
        'h',
        'd',
        'g',
        'a',
        'c',
    );

    /**
     * [uuid]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_question;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_questionEu;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_questionEs;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_answer;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_answerEu;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer1;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer1Eu;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer1Es;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer2;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer2Eu;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer2Es;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer3;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer3Eu;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_falseAnswer3Es;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_answerEs;

    /**
     * [enum:e|h|d|g|a|c]
     * Database var type enum('e','h','d','g','a','c')
     *
     * @var string
     */
    protected $_category;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_checked;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_packageId;


    /**
     * Parent relation fk_package_id
     *
     * @var \tribialfeminista\Model\Raw\Packages
     */
    protected $_Package;



    protected $_columnsList = array(
        'id'=>'id',
        'question'=>'question',
        'question_eu'=>'questionEu',
        'question_es'=>'questionEs',
        'answer'=>'answer',
        'answer_eu'=>'answerEu',
        'falseAnswer1'=>'falseAnswer1',
        'falseAnswer1_eu'=>'falseAnswer1Eu',
        'falseAnswer1_es'=>'falseAnswer1Es',
        'falseAnswer2'=>'falseAnswer2',
        'falseAnswer2_eu'=>'falseAnswer2Eu',
        'falseAnswer2_es'=>'falseAnswer2Es',
        'falseAnswer3'=>'falseAnswer3',
        'falseAnswer3_eu'=>'falseAnswer3Eu',
        'falseAnswer3_es'=>'falseAnswer3Es',
        'answer_es'=>'answerEs',
        'category'=>'category',
        'checked'=>'checked',
        'packageId'=>'packageId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid'),
            'question'=> array('ml'),
            'answer'=> array('ml'),
            'falseAnswer1'=> array('ml'),
            'falseAnswer2'=> array('ml'),
            'falseAnswer3'=> array('ml'),
            'category'=> array('enum:e|h|d|g|a|c'),
        ));

        $this->setMultiLangColumnsList(array(
            'question'=>'Question',
            'answer'=>'Answer',
            'falseAnswer1'=>'FalseAnswer1',
            'falseAnswer2'=>'FalseAnswer2',
            'falseAnswer3'=>'FalseAnswer3',
        ));

        $this->setAvailableLangs(array('es', 'eu'));

        $this->setParentList(array(
            'FkPackageId'=> array(
                    'property' => 'Package',
                    'table_name' => 'Packages',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'checked' => '0',
        );

        $this->_initFileObjects();
        parent::__construct();
    }

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    /**************************************************************************
    ************************** File System Object (FSO)************************
    ***************************************************************************/

    protected function _initFileObjects()
    {

        return $this;
    }

    public function getFileObjects()
    {

        return array();
    }



    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
            return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setQuestion($data, $language = '')
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setQuestion". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_question = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column question
     *
     * @return string
     */
    public function getQuestion($language = '')
    {
    
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getQuestion". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_question;
        }

        return $this->$methodName();

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setQuestionEu($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_questionEu != $data) {
            $this->_logChange('questionEu');
        }

        if (!is_null($data)) {
            $this->_questionEu = (string) $data;
        } else {
            $this->_questionEu = $data;
        }
        return $this;
    }

    /**
     * Gets column question_eu
     *
     * @return string
     */
    public function getQuestionEu()
    {
            return $this->_questionEu;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setQuestionEs($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_questionEs != $data) {
            $this->_logChange('questionEs');
        }

        if (!is_null($data)) {
            $this->_questionEs = (string) $data;
        } else {
            $this->_questionEs = $data;
        }
        return $this;
    }

    /**
     * Gets column question_es
     *
     * @return string
     */
    public function getQuestionEs()
    {
            return $this->_questionEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setAnswer($data, $language = '')
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setAnswer". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_answer = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column answer
     *
     * @return string
     */
    public function getAnswer($language = '')
    {
    
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getAnswer". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_answer;
        }

        return $this->$methodName();

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setAnswerEu($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_answerEu != $data) {
            $this->_logChange('answerEu');
        }

        if (!is_null($data)) {
            $this->_answerEu = (string) $data;
        } else {
            $this->_answerEu = $data;
        }
        return $this;
    }

    /**
     * Gets column answer_eu
     *
     * @return string
     */
    public function getAnswerEu()
    {
            return $this->_answerEu;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer1($data, $language = '')
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setFalseAnswer1". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_falseAnswer1 = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column falseAnswer1
     *
     * @return string
     */
    public function getFalseAnswer1($language = '')
    {
    
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getFalseAnswer1". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_falseAnswer1;
        }

        return $this->$methodName();

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer1Eu($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer1Eu != $data) {
            $this->_logChange('falseAnswer1Eu');
        }

        if (!is_null($data)) {
            $this->_falseAnswer1Eu = (string) $data;
        } else {
            $this->_falseAnswer1Eu = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer1_eu
     *
     * @return string
     */
    public function getFalseAnswer1Eu()
    {
            return $this->_falseAnswer1Eu;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer1Es($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer1Es != $data) {
            $this->_logChange('falseAnswer1Es');
        }

        if (!is_null($data)) {
            $this->_falseAnswer1Es = (string) $data;
        } else {
            $this->_falseAnswer1Es = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer1_es
     *
     * @return string
     */
    public function getFalseAnswer1Es()
    {
            return $this->_falseAnswer1Es;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer2($data, $language = '')
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setFalseAnswer2". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_falseAnswer2 = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column falseAnswer2
     *
     * @return string
     */
    public function getFalseAnswer2($language = '')
    {
    
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getFalseAnswer2". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_falseAnswer2;
        }

        return $this->$methodName();

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer2Eu($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer2Eu != $data) {
            $this->_logChange('falseAnswer2Eu');
        }

        if (!is_null($data)) {
            $this->_falseAnswer2Eu = (string) $data;
        } else {
            $this->_falseAnswer2Eu = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer2_eu
     *
     * @return string
     */
    public function getFalseAnswer2Eu()
    {
            return $this->_falseAnswer2Eu;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer2Es($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer2Es != $data) {
            $this->_logChange('falseAnswer2Es');
        }

        if (!is_null($data)) {
            $this->_falseAnswer2Es = (string) $data;
        } else {
            $this->_falseAnswer2Es = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer2_es
     *
     * @return string
     */
    public function getFalseAnswer2Es()
    {
            return $this->_falseAnswer2Es;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer3($data, $language = '')
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setFalseAnswer3". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_falseAnswer3 = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column falseAnswer3
     *
     * @return string
     */
    public function getFalseAnswer3($language = '')
    {
    
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getFalseAnswer3". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_falseAnswer3;
        }

        return $this->$methodName();

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer3Eu($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer3Eu != $data) {
            $this->_logChange('falseAnswer3Eu');
        }

        if (!is_null($data)) {
            $this->_falseAnswer3Eu = (string) $data;
        } else {
            $this->_falseAnswer3Eu = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer3_eu
     *
     * @return string
     */
    public function getFalseAnswer3Eu()
    {
            return $this->_falseAnswer3Eu;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setFalseAnswer3Es($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_falseAnswer3Es != $data) {
            $this->_logChange('falseAnswer3Es');
        }

        if (!is_null($data)) {
            $this->_falseAnswer3Es = (string) $data;
        } else {
            $this->_falseAnswer3Es = $data;
        }
        return $this;
    }

    /**
     * Gets column falseAnswer3_es
     *
     * @return string
     */
    public function getFalseAnswer3Es()
    {
            return $this->_falseAnswer3Es;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setAnswerEs($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_answerEs != $data) {
            $this->_logChange('answerEs');
        }

        if (!is_null($data)) {
            $this->_answerEs = (string) $data;
        } else {
            $this->_answerEs = $data;
        }
        return $this;
    }

    /**
     * Gets column answer_es
     *
     * @return string
     */
    public function getAnswerEs()
    {
            return $this->_answerEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setCategory($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_category != $data) {
            $this->_logChange('category');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_categoryAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for category'));
            }
            $this->_category = (string) $data;
        } else {
            $this->_category = $data;
        }
        return $this;
    }

    /**
     * Gets column category
     *
     * @return string
     */
    public function getCategory()
    {
            return $this->_category;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setChecked($data)
    {

        if ($this->_checked != $data) {
            $this->_logChange('checked');
        }

        if (!is_null($data)) {
            $this->_checked = (int) $data;
        } else {
            $this->_checked = $data;
        }
        return $this;
    }

    /**
     * Gets column checked
     *
     * @return int
     */
    public function getChecked()
    {
            return $this->_checked;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setPackageId($data)
    {

        if ($this->_packageId != $data) {
            $this->_logChange('packageId');
        }

        if (!is_null($data)) {
            $this->_packageId = (int) $data;
        } else {
            $this->_packageId = $data;
        }
        return $this;
    }

    /**
     * Gets column packageId
     *
     * @return int
     */
    public function getPackageId()
    {
            return $this->_packageId;
    }


    /**
     * Sets parent relation Package
     *
     * @param \tribialfeminista\Model\Raw\Packages $data
     * @return \tribialfeminista\Model\Raw\Questions
     */
    public function setPackage(\tribialfeminista\Model\Raw\Packages $data)
    {
        $this->_Package = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPackageId($primaryKey);
        }

        $this->_setLoaded('FkPackageId');
        return $this;
    }

    /**
     * Gets parent Package
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \tribialfeminista\Model\Raw\Packages
     */
    public function getPackage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkPackageId';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Package = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_Package;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return tribialfeminista\Mapper\Sql\Questions
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\tribialfeminista\Mapper\Sql\Questions')) {

                $this->setMapper(new \tribialfeminista\Mapper\Sql\Questions);

            } else {

                 new \Exception("Not a valid mapper class found");
            }

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(false);
        }

        return $this->_mapper;
    }

    /**
     * Returns the validator class for this model
     *
     * @return null | \tribialfeminista\Model\Validator\Questions
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\tribialfeminista\\Validator\Questions')) {

                $this->setValidator(new \tribialfeminista\Validator\Questions);
            }
        }

        return $this->_validator;
    }

    public function setFromArray($data)
    {
        return $this->getMapper()->loadModel($data, $this);
    }

    /**
     * Deletes current row by deleting the row that matches the primary key
     *
     * @see \Mapper\Sql\Questions::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getId() === null) {
            $this->_logger->log('The value for Id cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getId())
        );
    }
}
