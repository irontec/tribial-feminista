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
 * Abstract class that is extended by all base models
 *
 * @package tribialfeminista\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace tribialfeminista\Model\Raw;

abstract class ModelAbstract implements \IteratorAggregate
{
    /**
     * Mapper associated with this model instance
     *
     * @var tribialfeminista\Model\Raw\ModelAbstract
     */
    protected $_mapper;

    /**
    * Default values for not null fields
    * @var array
    */
    protected $_defaultValues = array();

    /**
     * Validator associated with this model instance
     *
     * @var tribialfeminista\Model\ModelValidatorAbstract
     */
    protected $_validator;

    /**
     * $_logger - Zend_Log object
     *
     * @var Zend_Log
     */
    protected $_logger;

    /**
     * Associative array of columns for this model
     *
     * @var array
     */
    protected $_columnsList;

    /**
     * Associative array of columns and their comment
     *
     * @var array
     */
    protected $_columnsMeta;

    /**
     * Associative array of columns for this model
     *
     * @var array
     */
    protected $_multiLangColumnsList;

    /**
     * Associative array of multilang columns for this model
     *
     * @var array
     */
    protected $_availableLangs = array();

    /***
     * Log changes switcher
     */
    protected $_logChanges = true;

    /***
     * Changed attributes
     */
    protected $_changeLog = array();

    /**
     * Associative array of parent relationships for this model
     *
     * @var array
     */
    protected $_parentList;

    /**
     * Associative array of dependent relationships for this model
     *
     * @var array
     */
    protected $_dependentList;

    /**
     * Orphan elements to remove on save()
     */
    protected $_orphans  = array();

    /**
     * Sql triggers
     *
     * @var bool
     */
    protected $_onDeleteCascade = array();
    protected $_onDeleteSetNull = array();

    /**
     * Default language for multilang field setters/getters
     */
    protected $_defaultUserLanguage = '';

    /**
     * Loaded relation log
     */
    protected $_loadedForeignKeyNames = array();

    public function __construct()
    {
        $availableLangs = $this->getAvailableLangs();

        if (count($availableLangs) > 0) {

            $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');

            if (is_null($bootstrap)) {

                $conf = new \Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini',APPLICATION_ENV);
                $conf = (Object) $conf->toArray();

            } else {

                $conf = (Object) $bootstrap->getOptions();
            }

            if (isset($conf->defaultLanguageZendRegistryKey)) {

                if (\Zend_Registry::isRegistered($conf->defaultLanguageZendRegistryKey)) {

                    $this->_defaultUserLanguage = \Zend_Registry::get($conf->defaultLanguageZendRegistryKey);
                }

            } else {

                    $this->_defaultUserLanguage = $availableLangs[0];
            }
        }

        $this->_logger = new \Zend_Log(new \Zend_Log_Writer_Null());


        $this->init();
    }

    abstract protected function init();

    protected function _isMultiLang($column)
    {
        $columnsMeta = $this->getColumnsMeta();
        if (!isset($columnsMeta[$column])) {
            return false;
        }
        if (!in_array("ml", $columnsMeta[$column])) {
            return false;
        }
        return true;
    }

    public function sanitize ()
    {
        $languages = $this->getAvailableLangs();

        foreach ($this->_defaultValues as $fld => $val) {

            if (!in_array($fld, $this->_columnsList)) {
                //Existe un campo definido como defaultValue, que no existe...
                continue;
            }

            if ($this->_isMultiLang($fld)) {
                //ml field!
                foreach ($languages as $lang) {
                    if  (is_null($this->{'_' . $fld . ucfirst($lang)} )) {
                        $setter = 'set' . ucfirst($fld);
                        $this->$setter($val, $lang);
                    }
                }

            } else {

                if (is_null($this->{'_' . $fld})) {
                    $setter = 'set' . ucfirst($fld);
                    $this->$setter($val);
                }
            }
        }

        return $this;
    }

    protected function _getCurrentLanguage($language = null)
    {
        if ($language) {
            if (!in_array($language, $this->getAvailableLangs())) {
                throw new \Exception($language . " is not an available language");
            }
            return $language;
        }

        return $this->getDefaultUserLanguage();
    }

    public function getCurrentLanguage()
    {
        return $this->_getCurrentLanguage();
    }

    public function initChangeLog()
    {
        $this->_logChanges = true;
        return $this;
    }

    public function stopChangeLog()
    {
        $this->_logChanges = false;
        return $this;
    }

    public function hasChange($field = '')
    {
        if (empty($field)) {

            if (!empty($this->_changeLog)) {

                return true;
            }

        } else {

            if ( in_array($field, $this->_changeLog) ) {

                return true;

            } elseif (in_array(lcfirst($field), $this->_changeLog)) {

                return true;
            }
        }

        return false;
    }

    public function fetchChangelog()
    {
        return $this->_changeLog;
    }

    public function resetChangeLog()
    {
        $this->_changeLog = array();
        return $this;
    }

    protected final function _logChange($field)
    {
        if ($this->_logChanges === true) {
            $this->_changeLog[] = $field;
        }
    }

    protected function _setLoaded($foreignKeyName)
    {
        $this->_loadedForeignKeyNames[$foreignKeyName] = true;
    }

    public function setNotLoaded($foreignKeyName)
    {
        $this->_loadedForeignKeyNames[$foreignKeyName] = false;
        return $this;
    }

    protected function _isLoaded($foreignKeyName)
    {
        return isset($this->_loadedForeignKeyNames[$foreignKeyName])
               && $this->_loadedForeignKeyNames[$foreignKeyName];
    }

    protected function getDefaultUserLanguage()
    {
        return $this->_defaultUserLanguage;
    }

    /**
     * Set the list of columns associated with this model
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setColumnsList($data)
    {
        $this->_columnsList = $data;
        return $this;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getColumnsList()
    {
        return $this->_columnsList;
    }


    /**
     * Associative array of columns and their comment
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setColumnsMeta($data)
    {
        $this->_columnsMeta = $data;
        return $this;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getColumnsMeta()
    {
        return $this->_columnsMeta;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getColumnMeta($key)
    {
        if (! isset($this->_columnsList[$key])) {

            Throw new Exception("Field $key was not found in column list");
        }

        if (isset($this->_columnsMeta[$key])) {

            return $this->_columnsMeta[$key];
        }

        return array();
    }

    /**
     * Set the list of columns associated with this model
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setMultiLangColumnsList($data)
    {
        $this->_multiLangColumnsList = $data;
        return $this;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getMultiLangColumnsList()
    {
        return $this->_multiLangColumnsList;
    }

    /**
     * Returns language list array
     *
     * @param array
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setAvailableLangs($langs)
    {
        $this->_availableLangs = $langs;
        return $this;
    }

    /**
     * Returns columns list array
     *
     * @return array
     */
    public function getAvailableLangs()
    {
        return $this->_availableLangs;
    }

    /**
     * Set the list of relationships associated with this model
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setParentList($data)
    {
        $this->_parentList = $data;
        return $this;
    }

    /**
     * Returns relationship list array
     *
     * @return array
     */
    public function getParentList()
    {
        return $this->_parentList;
    }

    /**
     * Set the list of relationships associated with this model
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setDependentList($data)
    {
        $this->_dependentList = $data;
        return $this;
    }

    /**
     * Returns relationship list array
     *
     * @return array
     */
    public function getDependentList()
    {
        return $this->_dependentList;
    }

    /**
     * Get orphan elements
     */
    public function getOrphans()
    {
        return $this->_orphans;
    }

    public function resetOrphans()
    {
        $this->_orphans = array();
        return $this;
    }

    /*
     * Set the list of relationships to delete when this object is erased
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setOnDeleteCascadeRelationships($data)
    {
        $this->_onDeleteCascade = $data;
        return $this;
    }

    /**
     * Return relationships to delete when this object is erased
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function getOnDeleteCascadeRelationships()
    {
        return $this->_onDeleteCascade;
    }

    /*
     * Set the list of relationships to delete when this object is erased
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setOnDeleteSetNullRelationships($data)
    {
        $this->_onDeleteSetNull = $data;
        return $this;
    }

    /**
     * Return relationships to delete when this object is erased
     *
     * @param array $data
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function getOnDeleteSetNullRelationships()
    {
        return $this->_onDeleteSetNull;
    }

    /**
     * Returns the mapper associated with this model
     *
     * @return tribialfeminista\Model\Mapper\MapperAbstract
     */
    public abstract function getMapper();

    /**
     * Sets the mapper class
     *
     * @param tribialfeminista\Model\Mapper\MapperAbstract $mapper
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    public abstract function getValidator ();

    public function setValidator($validator)
    {
        $this->_validator = $validator;
        return $this;
    }

    /**
     * Converts database column name to php setter/getter function name
     * @param string $column
     */
    public function columnNameToVar($column)
    {
        if (!isset($this->_columnsList[$column])) {
            $this->_logger->log("Column name to variable conversion failed for '$column' in columnNameToVar for " . get_class($this), \Zend_Log::ERR);
            throw new \Exception("column '$column' not found!");
        }

        return $this->_columnsList[$column];
    }

    /**
     * Fetch database constraint name from column name
     * @param string $column
     */
    public function varNameToConstraint($column)
    {
        foreach ($this->_parentList as $constraint => $values) {

            if ($values['property'] == $column) {

                return $constraint;
            }
        }

        foreach ($this->_dependentList as $constraint => $values) {

            if ($values['property'] == $column) {

                return $constraint;
            }
        }

        if (!isset($this->_columnsList[$column])) {
            throw new \Exception("No contraint found for column '$column'!");
        }
    }

    /**
     * Fetch database column name from constraint
     * @param string $column
     */
    public function constraintToVarName($constraint)
    {
        if (isset($this->_parentList[$constraint])) {

            return $this->_parentList[$constraint]['property'];
        }

        if (isset($this->_dependentList[$constraint])) {

            return $this->_dependentList[$constraint]['property'];
        }

        throw new \Exception("Contraint '$constraint' not found!");
    }

    /**
     * Converts database column name to PHP setter/getter function name
     * @param string $column
     */
    public function varNameToColumn($thevar)
    {
        foreach ($this->_columnsList as $column => $var) {
            if ($var == $thevar or $var == lcfirst($thevar)) {
                return $column;
            }
        }

        return null;
    }

    /**
     * @param string $method
     * @throws Exception if method does not exist
     * @param array $args
     */
    public function __call($method, array $args)
    {
        $this->_logger->log("Unrecoginized method requested in call for '$method' in " . get_class($this), \Zend_Log::ERR);
        throw new \Exception("Unrecognized method '$method()'");
    }

    public function __isset($name)
    {
        $method = 'get' . ucfirst($name);

        if (('mapper' == $name) || !method_exists($this, $method)) {
            $name = $this->columnNameToVar($name);
            $method = 'get' . ucfirst($name);
            if (('mapper' == $name) || !method_exists($this, $method)) {
                return false;
            }
        }

        return true;
    }

    /**
     *  __set() is run when writing data to inaccessible properties overloading
     *  it to support setting columns.
     *
     * Example:
     * <code>class->column_name='foo'</code> or <code>class->ColumnName='foo'</code>
     *  will execute the function <code>class->setColumnName('foo')</code>
     *
     * @param string $name
     * @param mixed $value
     * @throws Exception if the property/column does not exist
     */
    public function __set($name, $value)
    {
        $name = $this->columnNameToVar($name);

        $method = 'set' . ucfirst($name);

        if (('mapper' == $name) || !method_exists($this, $method)) {
            $this->_logger->log("Unable to find setter for '$name' in " . get_class($this), \Zend_Log::ERR);
            throw new \Exception("name:$name value:$value - Invalid property");
        }

        $this->$method($value);
    }

    /**
     * __get() is utilized for reading data from inaccessible properties
     * overloading it to support getting columns value.
     *
     * Example:
     * <code>$foo=class->column_name</code> or <code>$foo=class->ColumnName</code>
     * will execute the function <code>$foo=class->getColumnName()</code>
     *
     * @param string $name
     * @param mixed $value
     * @throws Exception if the property/column does not exist
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);

        if (('mapper' == $name) || !method_exists($this, $method)) {
            $name = $this->columnNameToVar($name);
            $method = 'get' . ucfirst($name);
            if (('mapper' == $name) || !method_exists($this, $method)) {
                $this->_logger->log("Unable to find getter for '$name' in " . get_class($this), \Zend_Log::ERR);
                throw new \Exception("name:$name  - Invalid property");
            }
        }

        return $this->$method();
    }

    /**
     * @deprecated
     * Array of options/values to be set for this model. Options without a
     * matching method are ignored.
     *
     * @param array $options
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function setOptions(array $options)
    {
        trigger_error("Deprecated method called. populateFromArray should be used", E_USER_NOTICE);
        $this->populateFromArray($options);
    }

    /**
     * Array of options/values to be set for this model. Options without a
     * matching method are ignored.
     *
     * @param array $options
     * @return tribialfeminista\Model\Raw\ModelAbstract
     */
    public function populateFromArray(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {

            $key = preg_replace_callback('/_(.)/', function ($matches) {
                           return ucfirst($matches[1]);
                   }, $key);

            $method = 'set' . ucfirst($key);

            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Returns the primary key column name
     *
     * @see tribialfeminista\Mapper\DbTable\TableAbstract::getPrimaryKeyName()
     * @return string|array The name or array of names which form the primary key
     */
    public function getPrimaryKeyName()
    {
        return $this->getMapper()->getDbTable()->getPrimaryKeyName();
    }

    /**
     * Returns an associative array of column-value pairings if the primary key
     * is an array of values, or the value of the primary key if not
     *
     * @return any|array
     */
    public function getPrimaryKey()
    {
        $primary_key = $this->getPrimaryKeyName();

        if (is_array($primary_key)) {
            $result = array();
            foreach ($primary_key as $key) {

                $key = $this->columnNameToVar($key);
                $result[$key] = $this->{'_' . $key};
            }

            return $result;

        } else {

            $primary_key = $this->columnNameToVar($primary_key);
            return $this->{'_' . $primary_key};
        }

    }

    /**
     * Returns an array, keys are the field names.
     *
     * @see tribialfeminista\Model\Mapper\MapperAbstract::toArray()
     * @return array
     */
    public function toArray()
    {
        return $this->getMapper()->toArray($this);
    }

    /**
     * Saves current row
     *
     * @see tribialfeminista\Model\Mapper\MapperAbstract::save()
     * @return boolean If the save was sucessful
     */
    public function save()
    {
        return $this->getMapper()->save($this);
    }

    /**
     * Saves current and dependant rows
     *
     * @see tribialfeminista\Model\Mapper\MapperAbstract::saveRecursive()
     * @param boolean $useTransaction
     * @return boolean If the save was sucessful
     */
    public function saveRecursive($useTransaction = true)
    {
        return $this->getMapper()->saveRecursive($this, $useTransaction);
    }

    /**
     * Checks if current object values make sense
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->getValidator()->isValid($this->toArray());
    }

    /**
     * Deletes current loaded row
     *
     * @return int
     */
    public function delete()
    {
        return $this->getMapper()->delete($this);
    }

    /**
     * Serializa los atributos y Setea los mappers a null
     */
    public function __sleep()
    {
        $this->setMapper(null);
        $vars = get_object_vars($this);

        $attrs = array();

        $parentClass = get_parent_class($this);

        //Filter private properties
        foreach (array_keys($vars) as $val) {

            if (!property_exists($parentClass, $val)) {

                continue;
            }

            $attrs[] = $val;
        }

        return $attrs;
    }

    public function getColumnForParentTable($parentTable, $propertyName)
    {
        $parents = $this->getParentList();

        foreach ($parents as $_fk => $parentData) {

            if ($parentData['table_name'] == $parentTable && $propertyName == $parentData['property']) {

                return $this->columnNameToVar(
                            $this->getMapper()->getDbTable()->getReferenceMap($_fk)
                       );
                break;
            }
        }

        return false;
    }

    public function getFileObjects()
    {
        return array();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->_columnsList);
    }
}
