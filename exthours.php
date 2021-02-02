<?php

require_once 'exthours.civix.php';
// phpcs:disable
use CRM_Exthours_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function exthours_civicrm_config(&$config) {
  _exthours_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function exthours_civicrm_xmlMenu(&$files) {
  _exthours_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function exthours_civicrm_install() {
  _exthours_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function exthours_civicrm_postInstall() {
  _exthours_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function exthours_civicrm_uninstall() {
  _exthours_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function exthours_civicrm_enable() {
  _exthours_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function exthours_civicrm_disable() {
  _exthours_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function exthours_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _exthours_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function exthours_civicrm_managed(&$entities) {
  _exthours_civix_civicrm_managed($entities);
  $entities[] = array(
    'module' => 'com.joineryhq.exthours',
    'name' => 'servicehours',
    'entity' => 'OptionValue',
    'params' => array(
      'version' => 3,
      'label' => 'Service Hours',
      'name' => 'exthours_servicehours',
      'description' => 'Service Hours for External Hours Tracking extension',
      'option_group_id' => 2,
    ),
  );

  $entities[] = array(
    'module' => 'com.joineryhq.exthours',
    'name' => 'workcategory',
    'entity' => 'OptionGroup',
    'params' => array(
      'version' => 3,
      'title' => 'ExtHours Work Category',
      'name' => 'exthours_workcategory',
      'description' => 'Work Category for External Hours Tracking extension',
    ),
  );
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function exthours_civicrm_caseTypes(&$caseTypes) {
  _exthours_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function exthours_civicrm_angularModules(&$angularModules) {
  _exthours_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function exthours_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _exthours_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function exthours_civicrm_entityTypes(&$entityTypes) {
  _exthours_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function exthours_civicrm_themes(&$themes) {
  _exthours_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function exthours_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_pageRun().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_pageRun
 */
function exthours_civicrm_pageRun(&$page) {
  $pageName = $page->getVar('_name');

  // $meowk = CRM_Exthours_Kimai_Utils::getKimaiUpdatesData();
  // echo "<pre>";
  // print_r($meowk);
  // echo "</pre>";
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function exthours_civicrm_navigationMenu(&$menu) {
  $pages = array(
    'admin_page' => array(
      'label' => E::ts('External Hours'),
      'name' => 'External Hours',
      'url' => 'civicrm/admin/exthours/settings?reset=1',
      'parent' => array('Administer', 'System Settings'),
      'permission' => 'access CiviCRM',
    ),
  );

  foreach ($pages as $item) {
    // Check that our item doesn't already exist.
    $menu_item_search = array('url' => $item['url']);
    $menu_items = array();
    CRM_Core_BAO_Navigation::retrieve($menu_item_search, $menu_items);
    if (empty($menu_items)) {
      // Now we're sure it doesn't exist; add it to the menu.
      $path = implode('/', $item['parent']);
      unset($item['parent']);
      _exthours_civix_insert_navigation_menu($menu, $path, $item);
    }
  }
}

/**
 * Log CiviCRM API errors to CiviCRM log.
 */
function _exthours_log_api_error(API_Exception $e, string $entity, string $action, array $params) {
  $message = "CiviCRM API Error '{$entity}.{$action}': " . $e->getMessage() . '; ';
  $message .= "API parameters when this error happened: " . json_encode($params) . '; ';
  $bt = debug_backtrace();
  $error_location = "{$bt[1]['file']}::{$bt[1]['line']}";
  $message .= "Error API called from: $error_location";
  CRM_Core_Error::debug_log_message($message);
}

/**
 * CiviCRM API wrapper. Wraps with try/catch, redirects errors to log, saves
 * typing.
 */
function _exthours_civicrmapi(string $entity, string $action, array $params, bool $silence_errors = TRUE) {
  try {
    $result = civicrm_api3($entity, $action, $params);
  }
  catch (API_Exception $e) {
    _exthours_log_api_error($e, $entity, $action, $params);
    if (!$silence_errors) {
      throw $e;
    }
  }

  return $result;
}
