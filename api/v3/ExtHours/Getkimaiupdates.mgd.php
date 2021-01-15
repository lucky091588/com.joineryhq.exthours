<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
return [
  [
    'name' => 'Cron:ExtHours.Getkimaiupdates',
    'entity' => 'Job',
    'params' => [
      'version' => 3,
      'name' => 'Call ExtHours.Getkimaiupdates API',
      'description' => 'Call ExtHours.Getkimaiupdates API',
      'run_frequency' => 'Always',
      'api_entity' => 'ExtHours',
      'api_action' => 'Getkimaiupdates',
      'parameters' => '',
    ],
  ],
];
