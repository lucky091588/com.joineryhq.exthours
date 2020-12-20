<?php

/**
 * Settings-related utility methods.
 * @link https://www.kimai.org/v1/api.html
 */
class CRM_Exthours_Utils {

  /**
   * Kimai Authenticate Setup Access to get API Key
   *
   * @param string $username Kimai username
   * @param string $password Kimai password
   * @return array for kimai api key request result.
   */
  public static function kimaiAuthAPIKey($username, $password) {
    $path = Civi::settings()->get('exthours_kimai_url');

    // Kimai authenticate method array
    $kimaiAuth = array(
      "method" => "authenticate",
      "params" => array(
        $username,
        $password,
      ),
      "id" => "1",
      "jsonrpc" => "2.0",
    );

    // Add trailing slash to URL
    if (substr($path, -1) !== '/') {
      $path .= '/';
    }

    // API Request
    $request = CRM_Exthours_ExthoursApi::request($path, $kimaiAuth, 'POST');

    return $request['result'];
  }

  /**
   * Get Kimai Timesheet
   *
   * @return array of kimai timesheet data.
   */
  public static function getKimaiTimesheet() {
    $path = Civi::settings()->get('exthours_kimai_url');
    $apiKey = Civi::settings()->get('exthours_kimai_api_key');

    // Kimai Get Timesheet Method
    $kimaiAuth = array(
      "method" => "getTimesheet",
      "params" => array(
        "apiKey" => $apiKey,
      ),
      "id" => "1",
      "jsonrpc" => "2.0",
    );

    // Add trailing slash to URL
    if (substr($path, -1) !== '/') {
      $path .= '/';
    }

    // API Request
    $request = CRM_Exthours_ExthoursApi::request($path, $kimaiAuth, 'POST');

    return $request['result'];
  }

}
