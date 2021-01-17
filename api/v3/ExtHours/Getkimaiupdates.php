<?php
use CRM_Exthours_ExtensionUtil as E;

/**
 * ExtHours.Getkimaiupdates API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_ext_hours_Getkimaiupdates_spec(&$spec) {
}

/**
 * ExtHours.Getkimaiupdates API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_ext_hours_Getkimaiupdates($params) {
  $queuedData = CRM_Exthours_Kimai_Utils::getKimaiUpdatesData();

  foreach ($queuedData as $data) {
    $results[$data['timeEntryID']] = CRM_Exthours_Kimai_Utils::getKimaiUpdate($data['id'], $data['action'], $data);
  }

  // Spec: civicrm_api3_create_success($values = 1, $params = [], $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($results, $params, 'ExtHours', 'Getkimaiupdates');
}
