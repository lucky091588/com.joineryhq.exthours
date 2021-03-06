<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from C:\xampp2\htdocs\drupal\sites\default\files\civicrm\ext\com.joineryhq.exthours\xml/schema/CRM/Exthours/entryActivity.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:1ac6832dd88d158e29a5de3628022c7c)
 */

/**
 * Database access object for the EntryActivity entity.
 */
class CRM_Exthours_DAO_EntryActivity extends CRM_Core_DAO {

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_exthours_entry_activity';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Unique EntryActivity ID
   *
   * @var int
   */
  public $id;

  /**
   * External ID (ex: kimai timeEntryID)
   *
   * @var int
   */
  public $external_id;

  /**
   * FK to Activity
   *
   * @var int
   */
  public $activity_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_exthours_entry_activity';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   */
  public static function getEntityTitle() {
    return ts('Entry Activities');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'activity_id', 'civicrm_activity', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => CRM_Exthours_ExtensionUtil::ts('Unique EntryActivity ID'),
          'required' => TRUE,
          'where' => 'civicrm_exthours_entry_activity.id',
          'table_name' => 'civicrm_exthours_entry_activity',
          'entity' => 'EntryActivity',
          'bao' => 'CRM_Exthours_DAO_EntryActivity',
          'localizable' => 0,
          'add' => NULL,
        ],
        'external_id' => [
          'name' => 'external_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => CRM_Exthours_ExtensionUtil::ts('External ID (ex: kimai timeEntryID)'),
          'where' => 'civicrm_exthours_entry_activity.external_id',
          'table_name' => 'civicrm_exthours_entry_activity',
          'entity' => 'EntryActivity',
          'bao' => 'CRM_Exthours_DAO_EntryActivity',
          'localizable' => 0,
          'add' => NULL,
        ],
        'activity_id' => [
          'name' => 'activity_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => CRM_Exthours_ExtensionUtil::ts('FK to Activity'),
          'where' => 'civicrm_exthours_entry_activity.activity_id',
          'table_name' => 'civicrm_exthours_entry_activity',
          'entity' => 'EntryActivity',
          'bao' => 'CRM_Exthours_DAO_EntryActivity',
          'localizable' => 0,
          'FKClassName' => 'CRM_Activity_DAO_Activity',
          'add' => NULL,
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'exthours_entry_activity', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'exthours_entry_activity', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
