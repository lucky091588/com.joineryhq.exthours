<?php
use CRM_Exthours_ExtensionUtil as E;

class CRM_Exthours_BAO_projectContact extends CRM_Exthours_DAO_projectContact {

  /**
   * Create a new ProjectContact based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Exthours_DAO_projectContact|NULL
   *
  public static function create($params) {
    $className = 'CRM_Exthours_DAO_projectContact';
    $entityName = 'ProjectContact';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
