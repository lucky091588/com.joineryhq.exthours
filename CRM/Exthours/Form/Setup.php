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

    $this->addFormRule(['CRM_Exthours_Form_Setup', 'formRule'], $this);

    parent::buildQuickForm();
  }

  /**
   * Global validation rules for the form.
   *
   * @param array $values
   *   Posted values of the form.
   *
   * @return array
   *   list of errors to be posted back to the form
   */
  public function formRule($values) {
    $errors = [];
    $request = CRM_Exthours_Kimai_Utils::kimaiAuthAPIKey($values['kimai_username'], $values['kimai_pass']);
    if (!$request['success']) {
      $errors['kimai_username'] = E::ts('Unknown user or no permissions.');
      $errors['kimai_pass'] = E::ts('Unknown password or no permissions.');
      CRM_Core_Session::setStatus(E::ts('There is an error with the username and password since it fails to connect in Kimai API.'), E::ts('External Hours: Kimai API Key setup'), "error");
    }
    return $errors;
  }

  /**
   * Process the form submission.
   */
  public function postProcess() {
    $values = $this->exportValues();
    $request = CRM_Exthours_Kimai_Utils::kimaiAuthAPIKey($values['kimai_username'], $values['kimai_pass']);
    Civi::settings()->set('exthours_kimai_api_key', $request['items'][0]['apiKey']);
    CRM_Core_Session::setStatus(E::ts('Kimai API Key has successfully setup.'), E::ts('External Hours: Kimai API Key setup'), "success");
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/admin/exthours/settings', 'reset=1'));
    parent::postProcess();
  }

}
