<?php

use CRM_Exthours_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Exthours_Form_Setup extends CRM_Core_Form {

  public function preProcess() {
    CRM_Utils_System::setTitle(E::ts('External Hours: Kimai API Key setup'));
  }

  public function buildQuickForm() {
    $this->add('text',
      'kimai_username',
      E::ts('Username'),
      '',
      TRUE
    );

    $this->add('password',
      'kimai_pass',
      E::ts('Password'),
      '',
      TRUE
    );

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Setup API Key'),
        'isDefault' => TRUE,
      ),
      array(
        'type' => 'cancel',
        'name' => E::ts('Cancel'),
      ),
    ));

    parent::buildQuickForm();
  }

  /**
   * Override parent::validate().
   */
  public function validate() {
    $error = parent::validate();
    $values = $this->exportValues();

    $request = CRM_Exthours_Kimai_Utils::kimaiAuthAPIKey($values['kimai_username'], $values['kimai_pass']);
    if (!$request['success']) {
      $this->setElementError('kimai_username', E::ts('Unknown user or no permissions.'));
      $this->setElementError('kimai_pass', E::ts('Unknown password or no permissions.'));
      CRM_Core_Session::setStatus(E::ts('There is an error with the username and password since it fails to connect in Kimai API.'), E::ts('External Hours: Kimai API Key setup'), "error");
    }
    else {
      $this->set('kimaiRequest', $request);
    }

    return (0 == count($this->_errors));
  }

  /**
   * Process the form submission.
   */
  public function postProcess() {
    $values = $this->exportValues();
    $request = $this->get('kimaiRequest');
    Civi::settings()->set('exthours_kimai_api_key', $request['items'][0]['apiKey']);
    CRM_Exthours_Kimai_Utils::kimaiSetupPrime();

    // Get option value details of exthours_servicehours
    $serviceHours = \Civi\Api4\OptionValue::get()
      ->addWhere('name', '=', 'exthours_servicehours')
      ->execute()
      ->first();

    // Get option group details of exthours_workcategory
    $workCategory = \Civi\Api4\OptionGroup::get()
      ->addWhere('name', '=', 'exthours_workcategory')
      ->execute()
      ->first();

    // Create custom group for the Service Hours Details
    // Extend as Activity with column value as exthours_servicehours value
    $createCustomGroup = \Civi\Api4\CustomGroup::create()
      ->addValue('title', 'Service Hours Details')
      ->addValue('extends', 'Activity')
      ->addValue('collapse_display', FALSE)
      ->addValue('style:name', 'Inline')
      ->addValue('extends_entity_column_value', [
          $serviceHours['value'],
        ])
      ->execute()
      ->first();

    // Create custom fields for the Service Hours Details custom group
    // set option group id is exthours_workcategory
    $createCustomField = \Civi\Api4\CustomField::create()
      ->addValue('custom_group_id', $createCustomGroup['id'])
      ->addValue('label', 'Work Category')
      ->addValue('data_type', 'Int')
      ->addValue('html_type', 'Select')
      ->addValue('option_group_id', $workCategory['id'])
      ->addValue('is_view', TRUE)
      ->execute();

    // Save all kimai activities in option group id exthours_workcategory
    $kimaiActivities = CRM_Exthours_Kimai_Utils::getKimaiActivities();
    foreach ($kimaiActivities as $activity) {
      $results = \Civi\Api4\OptionValue::create()
        ->addValue('option_group_id:name', 'exthours_workcategory')
        ->addValue('label', $activity['name'])
        ->addValue('value', $activity['activityID'])
        ->execute();
    }

    CRM_Core_Session::setStatus(E::ts('Kimai API Key has successfully setup.'), E::ts('External Hours: Kimai API Key setup'), "success");
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/admin/exthours/settings', 'reset=1'));
    parent::postProcess();
  }

}
