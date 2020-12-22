<?php

use CRM_Exthours_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Exthours_Form_Projects extends CRM_Core_Form {

  public function buildQuickForm() {
    $contactOrganization = [];
    $projects = [];

    // Fetch Contact Organization API
    $fetchContactOrganization = \Civi\Api4\Contact::get()
      ->addWhere('contact_type:name', '=', 'Organization')
      ->execute();
    foreach ($fetchContactOrganization as $organization) {
      $contactOrganization[$organization['id']]['id'] = $organization['id'];
      $contactOrganization[$organization['id']]['text'] = $organization['display_name'];
    }
    sort($contactOrganization);

    // Fetch Kimai Projects
    $kimaiProjects = CRM_Exthours_Kimai_Utils::getKimaiProjects();
    foreach ($kimaiProjects['items'] as $kimaiProject) {
      $projects[$kimaiProject['projectID']]['id'] = $kimaiProject['projectID'];
      $projects[$kimaiProject['projectID']]['text'] = $kimaiProject['name'];
    }
    sort($projects);

    $this->add('text',
      'kimai_projects',
      E::ts('Kimai Projects'),
      [
        'class' => 'crm-projects-selector big',
      ],
      TRUE
    );

    $this->add('text',
      'civicrm_organization',
      E::ts('CiviCRM Organization'),
      [
        'class' => 'crm-organization-selector big',
      ],
      TRUE
    );

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Save'),
        'isDefault' => TRUE,
      ),
      array(
        'type' => 'cancel',
        'name' => E::ts('Cancel'),
      ),
    ));

    $this->assign('contactOrganization', $contactOrganization);
    $this->assign('kimaiProjects', $projects);

    $this->addFormRule(['CRM_Exthours_Form_Projects', 'formRule'], $this);

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
    return $errors;
  }

  /**
   * Process the form submission.
   */
  public function postProcess() {
    $values = $this->exportValues();
    parent::postProcess();
  }

}
