<?php

use CRM_Exthours_ExtensionUtil as E;

/**
 * Wrapper around Exthours API.
 */
class CRM_Exthours_Kimai_Api {

  /**
   * Perform an HTTP request.
   *
   * @param array $body Optional body for POST and PUT requests. Array, will be
   *    json-encoded before sending.
   *    See: https://www.eventbrite.com/platform/api#/introduction/expansions
   * @param string $method HTTP verb: GET, POST, etc.
   * @return array
   */
  public static function request($body = array(), $method = 'POST', $pathCall = 'core/json.php') {

    $path = Civi::settings()->get('exthours_kimai_url');

    // Add trailing slash to URL
    if (substr($path, -1) !== '/') {
      $path .= '/';
    }

    $options = array(
      'http' => array(
        'method' => $method,
        'header' => "content-type: application/json\r\n",
        'ignore_errors' => TRUE,
      ),
    );

    if (
      $method == 'POST'
      || $method == 'PUT'
    ) {
      $options['http']['content'] = json_encode($body);
    }

    $url = $path . $pathCall;

    $context = stream_context_create($options);
    $result = @file_get_contents($url, TRUE, $context);

    $response = json_decode($result, TRUE);
    if ($response == NULL) {
      $response = array();
    }

    return $response;
  }

}
