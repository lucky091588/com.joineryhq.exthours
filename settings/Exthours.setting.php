<?php

use CRM_Exthours_ExtensionUtil as E;

return array(
  'exthours_kimai_url' => array(
    'group_name' => 'External Hours Settings',
    'group' => 'exthours',
    'name' => 'exthours_kimai_url',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => '',
    'title' => E::ts('Kimai URL'),
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'Text',
  ),

  'exthours_kimai_api_key' => array(
    'group_name' => 'External Hours Settings',
    'group' => 'exthours',
    'name' => 'exthours_kimai_api_key',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => '',
    'title' => E::ts('Kimai API Key'),
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'Hidden',
  ),
);
