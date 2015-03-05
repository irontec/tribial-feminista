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
class Scores extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_score;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_userId;


    /**
     * Parent relation fk_Scores_Users
     *
     * @var \tribialfeminista\Model\Raw\Users
     */
    protected $_User;



    protected $_columnsList = array(
        'id'=>'id',
        'score'=>'score',
        'userId'=>'userId',
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
            'FkScoresUsers'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'score' => '0',
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
     * @return \tribialfeminista\Model\Raw\Scores
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
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Scores
     */
    public function setScore($data)
    {

        if ($this->_score != $data) {
            $this->_logChange('score');
        }

        if (!is_null($data)) {
            $this->_score = (int) $data;
        } else {
            $this->_score = $data;
        }
        return $this;
    }

    /**
     * Gets column score
     *
     * @return int
     */
    public function getScore()
    {
            return $this->_score;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Scores
     */
    public function setUserId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_userId != $data) {
            $this->_logChange('userId');
        }

        if (!is_null($data)) {
            $this->_userId = (int) $data;
        } else {
            $this->_userId = $data;
        }
        return $this;
    }

    /**
     * Gets column userId
     *
     * @return int
     */
    public function getUserId()
    {
            return $this->_userId;
    }


    /**
     * Sets parent relation User
     *
     * @param \tribialfeminista\Model\Raw\Users $data
     * @return \tribialfeminista\Model\Raw\Scores
     */
    public function setUser(\tribialfeminista\Model\Raw\Users $data)
    {
        $this->_User = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setUserId($primaryKey);
        }

        $this->_setLoaded('FkScoresUsers');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkScoresUsers';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_User = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_User;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return tribialfeminista\Mapper\Sql\Scores
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\tribialfeminista\Mapper\Sql\Scores')) {

                $this->setMapper(new \tribialfeminista\Mapper\Sql\Scores);

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
     * @return null | \tribialfeminista\Model\Validator\Scores
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\tribialfeminista\\Validator\Scores')) {

                $this->setValidator(new \tribialfeminista\Validator\Scores);
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
     * @see \Mapper\Sql\Scores::delete
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
