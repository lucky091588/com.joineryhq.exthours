<?php

// This file declares managed database entities which will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
return array(
  array(
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
  ),
  array(
    'module' => 'com.joineryhq.exthours',
    'name' => 'workcategory',
    'entity' => 'OptionGroup',
    'params' => array(
      'version' => 3,
      'title' => 'ExtHours Work Category',
      'name' => 'exthours_workcategory',
      'description' => 'Work Category for External Hours Tracking extension',
    ),
  ),
);
