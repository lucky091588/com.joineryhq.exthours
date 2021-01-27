<?php
use CRM_Exthours_ExtensionUtil as E;

class CRM_Exthours_Page_Projects extends CRM_Core_Page {

  /**
   * @var bool
   * @inheritDoc
   */
  public $useLivePageJS = TRUE;

  /**
   * @var string
   * @inheritDoc
   */
  public static $_links = NULL;

  /**
   * @inheritDoc
   */
  public function &links() {
    if (!(self::$_links)) {
      self::$_links = [
        CRM_Core_Action::UPDATE => [
          'name' => E::ts('View and Edit Project'),
          'url' => 'civicrm/admin/exthours/projects',
          'qs' => 'reset=1&action=update&id=%%id%%',
          'title' => E::ts('Update Project'),
        ],
        CRM_Core_Action::DELETE => [
          'name' => E::ts('Delete'),
          'url' => 'civicrm/admin/exthours/projects',
          'qs' => 'reset=1&action=delete&id=%%id%%',
          'title' => E::ts('Delete Project'),
        ],
      ];
    }
    return self::$_links;
  }

  /**
   * @inheritDoc
   */
  public function run() {
    CRM_Utils_System::setTitle(E::ts('Kimai Integration: Projects'));

    $action = CRM_Utils_Request::retrieve('action', 'String',
      $this, FALSE, 'browse'
    );

    $this->assign('action', $action);

    $id = CRM_Utils_Request::retrieve('id', 'Positive',
      $this, FALSE, 0
    );

    if ($action & CRM_Core_Action::DELETE) {
      $session = CRM_Core_Session::singleton();
      $session->pushUserContext(CRM_Utils_System::url('civicrm/admin/exthours/projects/', 'action=browse'));
      $controller = new CRM_Core_Controller_Simple('CRM_Exthours_Form_ProjectDelete', "Delete Project", NULL);
      $controller->set('id', $id);
      $controller->setEmbedded(TRUE);
      $controller->process();
      $controller->run();
    }


    if ($action & (CRM_Core_Action::UPDATE | CRM_Core_Action::ADD)) {
      $this->edit($id, $action);
    }
    else {
      $this->browse();
    }

    parent::run();
  }

  /**
   * Edit custom group.
   *
   * @param int $id
   *   Custom group id.
   * @param string $action
   *   The action to be invoked.
   *
   * @return void
   */
  public function edit($id, $action) {
    // create a simple controller for editing custom data
    $controller = new CRM_Core_Controller_Simple('CRM_Exthours_Form_Projects', E::ts('Kimai Projects'), $action);

    // set the userContext stack
    $session = CRM_Core_Session::singleton();
    $session->pushUserContext(CRM_Utils_System::url('civicrm/admin/exthours/projects', 'action=browse'));
    $controller->set('id', $id);
    $controller->setEmbedded(TRUE);
    $controller->process();
    $controller->run();
  }

  /**
   * Browse all exthours projects .
   *
   * @param string $action
   *   The action to be invoked.
   *
   * @return void
   */
  public function browse($action = NULL) {
    $projects = [];

    $projectContacts = \Civi\Api4\ProjectContact::get()
      ->execute();
    foreach ($projectContacts as $projectContact) {
      $id = $projectContact['id'];
      $projects[$id]['id'] = $projectContact['id'];
      $projects[$id]['name'] = CRM_Exthours_Kimai_Utils::getKimaiProjectName($projectContact['external_id']);
      $projects[$id]['orgName'] = CRM_Exthours_Kimai_Utils::getOrganizationName($projectContact['contact_id']);
      $projects[$id]['action'] = CRM_Core_Action::formLink(self::links(), $action,
        ['id' => $id],
        E::ts('more'),
        FALSE,
        'project.row.actions',
        'project',
        $id
      );
    }

    $this->assign('rows', $projects);
  }

}
