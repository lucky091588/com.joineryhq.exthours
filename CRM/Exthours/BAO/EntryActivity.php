<?php
use CRM_Exthours_ExtensionUtil as E;

class CRM_Exthours_BAO_EntryActivity extends CRM_Exthours_DAO_EntryActivity {

  /**
   * Create a new EntryActivity based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Exthours_DAO_EntryActivity|NULL
   *
  public static function create($params) {
    $className = 'CRM_Exthours_DAO_EntryActivity';
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
