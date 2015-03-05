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
 * Table definition for Questions
 *
 * @package tribialfeminista\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace tribialfeminista\Mapper\Sql\DbTable;
class Questions extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Questions';

    /**
     * $_id - this is the primary key name
     *
     * @var binary
     */
    protected $_id = 'id';

    protected $_rowClass = 'tribialfeminista\\Model\\Questions';
    protected $_rowMapperClass = 'tribialfeminista\\Mapper\\Sql\\Questions';

    protected $_sequence = true; // binary
    protected $_referenceMap = array(
        'FkPackageId' => array(
            'columns' => 'packageId',
            'refTableClass' => 'tribialfeminista\\Mapper\\Sql\\DbTable\\Packages',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'id',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'binary(36)',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => false,
	  ),
	  'question' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'question',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'question_eu' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'question_eu',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'question_es' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'question_es',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'answer' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'answer',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'answer_eu' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'answer_eu',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer1' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer1',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer1_eu' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer1_eu',
	    'COLUMN_POSITION' => 8,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer1_es' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer1_es',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer2' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer2',
	    'COLUMN_POSITION' => 10,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer2_eu' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer2_eu',
	    'COLUMN_POSITION' => 11,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer2_es' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer2_es',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer3' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer3',
	    'COLUMN_POSITION' => 13,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer3_eu' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer3_eu',
	    'COLUMN_POSITION' => 14,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'falseAnswer3_es' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'falseAnswer3_es',
	    'COLUMN_POSITION' => 15,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '500',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'answer_es' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'answer_es',
	    'COLUMN_POSITION' => 16,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'category' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'category',
	    'COLUMN_POSITION' => 17,
	    'DATA_TYPE' => 'enum(\'e\',\'h\',\'d\',\'g\',\'a\',\'c\')',
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
	  'checked' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'checked',
	    'COLUMN_POSITION' => 18,
	    'DATA_TYPE' => 'tinyint',
	    'DEFAULT' => '0',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'packageId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Questions',
	    'COLUMN_NAME' => 'packageId',
	    'COLUMN_POSITION' => 19,
	    'DATA_TYPE' => 'mediumint',
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
	);




}
