<?php

use CRM_Exthours_ExtensionUtil as E;

/**
 * Wrapper around Exthours API.
 */
class CRM_Exthours_ExthoursApi {
  /**
   * Perform an HTTP request.
   *
   * @param string $path Endpoint
   * @param array $body Optional body for POST and PUT requests. Array, will be
   *    json-encoded before sending.
   *    See: https://www.eventbrite.com/platform/api#/introduction/expansions
   * @param string $method HTTP verb: GET, POST, etc.
   * @return array
   */
  public function request($path, $body = array(), $method = 'POST') {
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

    $url = $path . 'core/json.php';

    $context = stream_context_create($options);
    $result = @file_get_contents($url, TRUE, $context);

    // Log error if $result is null, probably network is unreachable.
    // if ($result == NULL) {
    //   $bt = debug_backtrace();
    //   $error_location = "{$bt[1]['file']}::{$bt[1]['line']}";

    //   $messageLines = array(
    //     "Eventbrite API error: No response returned. Suspect network connection is down.",
    //     "Request URL: $url",
    //     "Method: $method",
    //     "Body: " . json_encode($body),
    //     "API called from: $error_location",
    //   );
    //   CRM_Eventbrite_BAO_EventbriteLog::create(array(
    //     'message' => implode("\n", $messageLines),
    //     'message_type_id' => CRM_Eventbrite_BAO_EventbriteLog::MESSAGE_TYPE_ID_EVENTBRITE_API_ERROR,
    //   ));
    //   throw new CRM_Core_Exception("Eventbrite API error: No response returned. Suspect network connection is down.");
    // }

    $response = json_decode($result, TRUE);
    if ($response == NULL) {
      $response = array();
    }

    return $response;
  }

}
