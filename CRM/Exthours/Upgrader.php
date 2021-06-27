<?php
use CRM_Exthours_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Exthours_Upgrader extends CRM_Exthours_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).

  /**
   * Example: Run an external SQL script when the module is installed.
   *
  public function install() {
    $this->executeSqlFile('sql/myinstall.sql');
  }

  /**
   * Example: Work with entities usually not available during the install step.
   *
   * This method can be used for any post-install tasks. For example, if a step
   * of your installation depends on accessing an entity that is itself
   * created during the installation (e.g., a setting or a managed entity), do
   * so here to avoid order of operation problems.
   */
  // public function postInstall() {
  //  $customFieldId = civicrm_api3('CustomField', 'getvalue', array(
  //    'return' => array("id"),
  //    'name' => "customFieldCreatedViaManagedHook",
  //  ));
  //  civicrm_api3('Setting', 'create', array(
  //    'myWeirdFieldSetting' => array('id' => $customFieldId, 'weirdness' => 1),
  //  ));
  // }

  /**
   * Example: Run an external SQL script when the module is uninstalled.
   */
  public function uninstall() {
    // Delete related settings when uninstall
    Civi::settings()->set('exthours_kimai_url', '');
    Civi::settings()->set('exthours_kimai_api_key', '');
    Civi::settings()->set('exthours_kimai_setup_primed', '');

    // Get service hours option value to delete all activity related to exthours and custom group
    $getServiceHours = \Civi\Api4\OptionValue::get()
      ->setCheckPermissions(FALSE)
      ->addWhere('name', '=', 'exthours_servicehours')
      ->execute()
      ->first();

    // Delete all activity related to exthours
    $cleanActivities = \Civi\Api4\Activity::delete()
      ->setCheckPermissions(FALSE)
      ->addWhere('activity_type_id', '=', $getServiceHours['value'])
      ->execute();

    // Delete all related custom field
    $cleanCustomField = \Civi\Api4\CustomField::delete()
      ->setCheckPermissions(FALSE)
      ->addWhere('option_group_id:name', '=', 'exthours_workcategory')
      ->execute();

    // Delete all related custom field
    $cleanCustomField = \Civi\Api4\CustomField::delete()
      ->setCheckPermissions(FALSE)
      ->addWhere('label', '=', 'Tracking Number')
      ->execute();

    // Delete all related custom field
    $cleanCustomField = \Civi\Api4\CustomField::delete()
      ->setCheckPermissions(FALSE)
      ->addWhere('label', '=', 'Is Invoiced?')
      ->execute();

    // Get all related custom group
    $getCustomServiceHours = \Civi\Api4\CustomGroup::get()
      ->setCheckPermissions(FALSE)
      ->addWhere('extends_entity_column_value', '=', $getServiceHours['value'])
      ->execute()
      ->first();

    // Delete all related custom group
    $cleanCustomGroups = \Civi\Api4\CustomGroup::delete()
      ->setCheckPermissions(FALSE)
      ->addWhere('extends_entity_column_value', '=', $getServiceHours['value'])
      ->execute();

    CRM_Core_DAO::executeQuery("DROP TABLE IF EXISTS {$getCustomServiceHours['table_name']}");

    // $this->executeSqlFile('sql/myuninstall.sql');
  }

  public function upgrade_1001() {
    $this->ctx->log->info('Applying update 1001 (Create Is Invoiced Custom Field)');

    try {
      $serviceHoursDetailsCustomGroup = \Civi\Api4\CustomGroup::get()
        ->addWhere('name', '=', 'Service_Hours_Details')
        ->addWhere('extends', '=', 'Activity')
        ->execute()
        ->first();

      $isInvoicedCustomeField = \Civi\Api4\CustomField::create()
        ->addValue('custom_group_id', $serviceHoursDetailsCustomGroup['id'])
        ->addValue('name', 'Is_Invoiced')
        ->addValue('label', 'Is Invoiced?')
        ->addValue('data_type', 'Boolean')
        ->addValue('html_type', 'Radio')
        ->addValue('is_view', TRUE)
        ->addValue('is_searchable', TRUE)
        ->execute();
    } catch (API_Exception $e) {
    }

    return TRUE;
  }

  /**
   * Example: Run a simple query when a module is enabled.
   */
  // public function enable() {
  //  CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
  // }

  /**
   * Example: Run a simple query when a module is disabled.
   */
  // public function disable() {
  //   CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
  // }

  /**
   * Example: Run a couple simple queries.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4200() {
  //   $this->ctx->log->info('Applying update 4200');
  //   CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
  //   CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
  //   return TRUE;
  // }


  /**
   * Example: Run an external SQL script.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4201() {
  //   $this->ctx->log->info('Applying update 4201');
  //   // this path is relative to the extension base dir
  //   $this->executeSqlFile('sql/upgrade_4201.sql');
  //   return TRUE;
  // }


  /**
   * Example: Run a slow upgrade process by breaking it up into smaller chunk.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4202() {
  //   $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

  //   $this->addTask(E::ts('Process first step'), 'processPart1', $arg1, $arg2);
  //   $this->addTask(E::ts('Process second step'), 'processPart2', $arg3, $arg4);
  //   $this->addTask(E::ts('Process second step'), 'processPart3', $arg5);
  //   return TRUE;
  // }
  // public function processPart1($arg1, $arg2) { sleep(10); return TRUE; }
  // public function processPart2($arg3, $arg4) { sleep(10); return TRUE; }
  // public function processPart3($arg5) { sleep(10); return TRUE; }

  /**
   * Example: Run an upgrade with a query that touches many (potentially
   * millions) of records by breaking it up into smaller chunks.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4203() {
  //   $this->ctx->log->info('Planning update 4203'); // PEAR Log interface

  //   $minId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(min(id),0) FROM civicrm_contribution');
  //   $maxId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(max(id),0) FROM civicrm_contribution');
  //   for ($startId = $minId; $startId <= $maxId; $startId += self::BATCH_SIZE) {
  //     $endId = $startId + self::BATCH_SIZE - 1;
  //     $title = E::ts('Upgrade Batch (%1 => %2)', array(
  //       1 => $startId,
  //       2 => $endId,
  //     ));
  //     $sql = '
  //       UPDATE civicrm_contribution SET foobar = whiz(wonky()+wanker)
  //       WHERE id BETWEEN %1 and %2
  //     ';
  //     $params = array(
  //       1 => array($startId, 'Integer'),
  //       2 => array($endId, 'Integer'),
  //     );
  //     $this->addTask($title, 'executeSql', $sql, $params);
  //   }
  //   return TRUE;
  // }

}
