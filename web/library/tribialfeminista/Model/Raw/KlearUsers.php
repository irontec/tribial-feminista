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
class KlearUsers extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_userId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_login;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_email;

    /**
     * [password]
     * Database var type varchar
     *
     * @var string
     */
    protected $_pass;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_active;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_createdOn;




    protected $_columnsList = array(
        'userId'=>'userId',
        'login'=>'login',
        'email'=>'email',
        'pass'=>'pass',
        'active'=>'active',
        'createdOn'=>'createdOn',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'pass'=> array('password'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'createdOn' => 'CURRENT_TIMESTAMP',
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
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setUserId($data)
    {

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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setLogin($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_login != $data) {
            $this->_logChange('login');
        }

        if (!is_null($data)) {
            $this->_login = (string) $data;
        } else {
            $this->_login = $data;
        }
        return $this;
    }

    /**
     * Gets column login
     *
     * @return string
     */
    public function getLogin()
    {
            return $this->_login;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setEmail($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_email != $data) {
            $this->_logChange('email');
        }

        if (!is_null($data)) {
            $this->_email = (string) $data;
        } else {
            $this->_email = $data;
        }
        return $this;
    }

    /**
     * Gets column email
     *
     * @return string
     */
    public function getEmail()
    {
            return $this->_email;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setPass($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pass != $data) {
            $this->_logChange('pass');
        }

        if (!is_null($data)) {
            $this->_pass = (string) $data;
        } else {
            $this->_pass = $data;
        }
        return $this;
    }

    /**
     * Gets column pass
     *
     * @return string
     */
    public function getPass()
    {
            return $this->_pass;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setActive($data)
    {

        if ($this->_active != $data) {
            $this->_logChange('active');
        }

        if (!is_null($data)) {
            $this->_active = (int) $data;
        } else {
            $this->_active = $data;
        }
        return $this;
    }

    /**
     * Gets column active
     *
     * @return int
     */
    public function getActive()
    {
            return $this->_active;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \tribialfeminista\Model\Raw\KlearUsers
     */
    public function setCreatedOn($data)
    {

        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }

        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }

        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }


        if ($this->_createdOn != $data) {
            $this->_logChange('createdOn');
        }

        $this->_createdOn = $data;
        return $this;
    }

    /**
     * Gets column createdOn
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getCreatedOn($returnZendDate = false)
    {
    
        if (is_null($this->_createdOn)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_createdOn->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_createdOn->format('Y-m-d H:i:s');

    }


    /**
     * Returns the mapper class for this model
     *
     * @return tribialfeminista\Mapper\Sql\KlearUsers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\tribialfeminista\Mapper\Sql\KlearUsers')) {

                $this->setMapper(new \tribialfeminista\Mapper\Sql\KlearUsers);

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
     * @return null | \tribialfeminista\Model\Validator\KlearUsers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\tribialfeminista\\Validator\KlearUsers')) {

                $this->setValidator(new \tribialfeminista\Validator\KlearUsers);
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
     * @see \Mapper\Sql\KlearUsers::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getUserId() === null) {
            $this->_logger->log('The value for UserId cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'userId = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getUserId())
        );
    }
}
