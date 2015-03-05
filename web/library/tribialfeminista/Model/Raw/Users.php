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
class Users extends ModelAbstract
{

    protected $_deviceTypeAcceptedValues = array(
        'ios',
        'android',
        'unknown',
    );
    protected $_loginTypeAcceptedValues = array(
        'twitter',
        'facebook',
    );

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
    protected $_email;

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

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_deviceId;

    /**
     * [enum:ios|android|unknown]
     * Database var type enum('ios','android','unknown')
     *
     * @var string
     */
    protected $_deviceType;

    /**
     * [enum:twitter|facebook|unknown]
     * Database var type enum('twitter','facebook')
     *
     * @var string
     */
    protected $_loginType;

    /**
     * Database var type bigint
     *
     * @var int
     */
    protected $_fbId;

    /**
     * Database var type bigint
     *
     * @var int
     */
    protected $_twId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fbPicUrl;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_twPicUrl;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fbUsername;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_twUsername;



    /**
     * Dependent relation fk_Scores_Users
     * Type: One-to-Many relationship
     *
     * @var \tribialfeminista\Model\Raw\Scores[]
     */
    protected $_Scores;


    protected $_columnsList = array(
        'id'=>'id',
        'email'=>'email',
        'active'=>'active',
        'createdOn'=>'createdOn',
        'deviceId'=>'deviceId',
        'deviceType'=>'deviceType',
        'loginType'=>'loginType',
        'fbId'=>'fbId',
        'twId'=>'twId',
        'fbPicUrl'=>'fbPicUrl',
        'twPicUrl'=>'twPicUrl',
        'fbUsername'=>'fbUsername',
        'twUsername'=>'twUsername',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'deviceType'=> array('enum:ios|android|unknown'),
            'loginType'=> array('enum:twitter|facebook|unknown'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'FkScoresUsers' => array(
                    'property' => 'Scores',
                    'table_name' => 'Scores',
                ),
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
     * @return \tribialfeminista\Model\Raw\Users
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
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setEmail($data)
    {

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
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Users
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
     * @return \tribialfeminista\Model\Raw\Users
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setDeviceId($data)
    {

        if ($this->_deviceId != $data) {
            $this->_logChange('deviceId');
        }

        if (!is_null($data)) {
            $this->_deviceId = (string) $data;
        } else {
            $this->_deviceId = $data;
        }
        return $this;
    }

    /**
     * Gets column deviceId
     *
     * @return string
     */
    public function getDeviceId()
    {
            return $this->_deviceId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setDeviceType($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_deviceType != $data) {
            $this->_logChange('deviceType');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_deviceTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for deviceType'));
            }
            $this->_deviceType = (string) $data;
        } else {
            $this->_deviceType = $data;
        }
        return $this;
    }

    /**
     * Gets column deviceType
     *
     * @return string
     */
    public function getDeviceType()
    {
            return $this->_deviceType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setLoginType($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_loginType != $data) {
            $this->_logChange('loginType');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_loginTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for loginType'));
            }
            $this->_loginType = (string) $data;
        } else {
            $this->_loginType = $data;
        }
        return $this;
    }

    /**
     * Gets column loginType
     *
     * @return string
     */
    public function getLoginType()
    {
            return $this->_loginType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setFbId($data)
    {

        if ($this->_fbId != $data) {
            $this->_logChange('fbId');
        }

        if (!is_null($data)) {
            $this->_fbId = (int) $data;
        } else {
            $this->_fbId = $data;
        }
        return $this;
    }

    /**
     * Gets column fbId
     *
     * @return int
     */
    public function getFbId()
    {
            return $this->_fbId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setTwId($data)
    {

        if ($this->_twId != $data) {
            $this->_logChange('twId');
        }

        if (!is_null($data)) {
            $this->_twId = (int) $data;
        } else {
            $this->_twId = $data;
        }
        return $this;
    }

    /**
     * Gets column twId
     *
     * @return int
     */
    public function getTwId()
    {
            return $this->_twId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setFbPicUrl($data)
    {

        if ($this->_fbPicUrl != $data) {
            $this->_logChange('fbPicUrl');
        }

        if (!is_null($data)) {
            $this->_fbPicUrl = (string) $data;
        } else {
            $this->_fbPicUrl = $data;
        }
        return $this;
    }

    /**
     * Gets column fbPicUrl
     *
     * @return string
     */
    public function getFbPicUrl()
    {
            return $this->_fbPicUrl;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setTwPicUrl($data)
    {

        if ($this->_twPicUrl != $data) {
            $this->_logChange('twPicUrl');
        }

        if (!is_null($data)) {
            $this->_twPicUrl = (string) $data;
        } else {
            $this->_twPicUrl = $data;
        }
        return $this;
    }

    /**
     * Gets column twPicUrl
     *
     * @return string
     */
    public function getTwPicUrl()
    {
            return $this->_twPicUrl;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setFbUsername($data)
    {

        if ($this->_fbUsername != $data) {
            $this->_logChange('fbUsername');
        }

        if (!is_null($data)) {
            $this->_fbUsername = (string) $data;
        } else {
            $this->_fbUsername = $data;
        }
        return $this;
    }

    /**
     * Gets column fbUsername
     *
     * @return string
     */
    public function getFbUsername()
    {
            return $this->_fbUsername;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setTwUsername($data)
    {

        if ($this->_twUsername != $data) {
            $this->_logChange('twUsername');
        }

        if (!is_null($data)) {
            $this->_twUsername = (string) $data;
        } else {
            $this->_twUsername = $data;
        }
        return $this;
    }

    /**
     * Gets column twUsername
     *
     * @return string
     */
    public function getTwUsername()
    {
            return $this->_twUsername;
    }


    /**
     * Sets dependent relations fk_Scores_Users
     *
     * @param array $data An array of \tribialfeminista\Model\Raw\Scores
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function setScores(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Scores === null) {

                $this->getScores();
            }

            $oldRelations = $this->_Scores;

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

        $this->_Scores = array();

        foreach ($data as $object) {
            $this->addScores($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Scores_Users
     *
     * @param \tribialfeminista\Model\Raw\Scores $data
     * @return \tribialfeminista\Model\Raw\Users
     */
    public function addScores(\tribialfeminista\Model\Raw\Scores $data)
    {
        $this->_Scores[] = $data;
        $this->_setLoaded('FkScoresUsers');
        return $this;
    }

    /**
     * Gets dependent fk_Scores_Users
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \tribialfeminista\Model\Raw\Scores
     */
    public function getScores($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkScoresUsers';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Scores = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Scores;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return tribialfeminista\Mapper\Sql\Users
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\tribialfeminista\Mapper\Sql\Users')) {

                $this->setMapper(new \tribialfeminista\Mapper\Sql\Users);

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
     * @return null | \tribialfeminista\Model\Validator\Users
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\tribialfeminista\\Validator\Users')) {

                $this->setValidator(new \tribialfeminista\Validator\Users);
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
     * @see \Mapper\Sql\Users::delete
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
