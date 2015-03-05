<?php

/**
 * Application Model DbTables
 *
 * @package tribialfeminista\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Table definition for Users
 *
 * @package tribialfeminista\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace tribialfeminista\Mapper\Sql\DbTable;
class Users extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Users';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'tribialfeminista\\Model\\Users';
    protected $_rowMapperClass = 'tribialfeminista\\Mapper\\Sql\\Users';

    protected $_sequence = true; // int
    
    protected $_dependentTables = array(
        'tribialfeminista\\Mapper\\Sql\\DbTable\\Scores'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'id',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => true,
	  ),
	  'email' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'email',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'active' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'active',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'tinyint',
	    'DEFAULT' => '1',
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'createdOn' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'createdOn',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'timestamp',
	    'DEFAULT' => 'CURRENT_TIMESTAMP',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'deviceId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'deviceId',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '100',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'deviceType' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'deviceType',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'enum(\'ios\',\'android\',\'unknown\')',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'loginType' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'loginType',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'enum(\'twitter\',\'facebook\')',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'fbId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'fbId',
	    'COLUMN_POSITION' => 8,
	    'DATA_TYPE' => 'bigint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'twId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'twId',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'bigint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'fbPicUrl' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'fbPicUrl',
	    'COLUMN_POSITION' => 10,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'twPicUrl' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'twPicUrl',
	    'COLUMN_POSITION' => 11,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'fbUsername' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'fbUsername',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '40',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'twUsername' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'twUsername',
	    'COLUMN_POSITION' => 13,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '40',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
