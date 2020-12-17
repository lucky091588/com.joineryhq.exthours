<?php
use CRM_Exthours_ExtensionUtil as E;

class CRM_Exthours_BAO_entryActivity extends CRM_Exthours_DAO_entryActivity {

  /**
   * Create a new EntryActivity based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Exthours_DAO_entryActivity|NULL
   *
  public static function create($params) {
    $className = 'CRM_Exthours_DAO_entryActivity';
    $entityName = 'EntryActivity';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
