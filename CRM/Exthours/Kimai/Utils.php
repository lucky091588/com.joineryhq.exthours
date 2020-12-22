<?php

/**
 * Settings-related utility methods.
 * @link https://www.kimai.org/v1/api.html
 */
class CRM_Exthours_Kimai_Utils {

  /**
   * Kimai Authenticate Setup Access to get API Key
   *
   * @param string $username Kimai username
   * @param string $password Kimai password
   * @return array for kimai api key request result.
   */
  public static function kimaiAuthAPIKey($username, $password) {
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

    // API Request
    $request = CRM_Exthours_Kimai_Api::request($kimaiAuth, 'POST');

    return $request['result'];
  }

  /**
   * Get Kimai Timesheet
   *
   * @return array of kimai timesheet data.
   */
  public static function getKimaiTimesheet() {
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

    // API Request
    $request = CRM_Exthours_Kimai_Api::request($kimaiAuth, 'POST');

    return $request['result'];
  }

  /**
   * Get Kimai Projects
   *
   * @return array of kimai projects data.
   */
  public static function getKimaiProjects() {
    $apiKey = Civi::settings()->get('exthours_kimai_api_key');

    // Kimai Get Timesheet Method
    $kimaiAuth = array(
      "method" => "getProjects",
      "params" => array(
        "apiKey" => $apiKey,
      ),
      "id" => "1",
      "jsonrpc" => "2.0",
    );

    // API Request
    $request = CRM_Exthours_Kimai_Api::request($kimaiAuth, 'POST');

    return $request['result'];
  }

}
