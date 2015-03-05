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
class Packages extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_code;



    /**
     * Dependent relation fk_package_id
     * Type: One-to-Many relationship
     *
     * @var \tribialfeminista\Model\Raw\Questions[]
     */
    protected $_Questions;


    protected $_columnsList = array(
        'id'=>'id',
        'code'=>'code',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'FkPackageId' => array(
                    'property' => 'Questions',
                    'table_name' => 'Questions',
                ),
        ));




        $this->_defaultValues = array(
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
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Packages
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
            $this->_id = (int) $data;
        } else {
            $this->_id = $data;
        }
        return $this;
    }

    /**
     * Gets column id
     *
     * @return int
     */
    public function getId()
    {
            return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Packages
     */
    public function setCode($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_code != $data) {
            $this->_logChange('code');
        }

        if (!is_null($data)) {
            $this->_code = (string) $data;
        } else {
            $this->_code = $data;
        }
        return $this;
    }

    /**
     * Gets column code
     *
     * @return string
     */
    public function getCode()
    {
            return $this->_code;
    }


    /**
     * Sets dependent relations fk_package_id
     *
     * @param array $data An array of \tribialfeminista\Model\Raw\Questions
     * @return \tribialfeminista\Model\Raw\Packages
     */
    public function setQuestions(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Questions === null) {

                $this->getQuestions();
            }

            $oldRelations = $this->_Questions;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    if (is_numeric($pk = $newItem->getPrimaryKey())) {

                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_Questions = array();

        foreach ($data as $object) {
            $this->addQuestions($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_package_id
     *
     * @param \tribialfeminista\Model\Raw\Questions $data
     * @return \tribialfeminista\Model\Raw\Packages
     */
    public function addQuestions(\tribialfeminista\Model\Raw\Questions $data)
    {
        $this->_Questions[] = $data;
        $this->_setLoaded('FkPackageId');
        return $this;
    }

    /**
     * Gets dependent fk_package_id
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \tribialfeminista\Model\Raw\Questions
     */
    public function getQuestions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkPackageId';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Questions = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Questions;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return tribialfeminista\Mapper\Sql\Packages
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\tribialfeminista\Mapper\Sql\Packages')) {

                $this->setMapper(new \tribialfeminista\Mapper\Sql\Packages);

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
     * @return null | \tribialfeminista\Model\Validator\Packages
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\tribialfeminista\\Validator\Packages')) {

                $this->setValidator(new \tribialfeminista\Validator\Packages);
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
     * @see \Mapper\Sql\Packages::delete
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
