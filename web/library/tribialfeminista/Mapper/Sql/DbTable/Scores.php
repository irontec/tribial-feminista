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
 * Table definition for Scores
 *
 * @package tribialfeminista\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace tribialfeminista\Mapper\Sql\DbTable;
class Scores extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Scores';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'tribialfeminista\\Model\\Scores';
    protected $_rowMapperClass = 'tribialfeminista\\Mapper\\Sql\\Scores';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'FkScoresUsers' => array(
            'columns' => 'userId',
            'refTableClass' => 'tribialfeminista\\Mapper\\Sql\\DbTable\\Users',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Scores',
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
	  'score' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Scores',
	    'COLUMN_NAME' => 'score',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => '0',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'userId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Scores',
	    'COLUMN_NAME' => 'userId',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
