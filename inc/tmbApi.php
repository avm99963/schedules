<?php
class tmbApi {
  const API_ENDPOINT = "https://api.tmb.cat/v1/";

  public static function httpRequest($url, $method = "GET", $params = [], $file = null) {
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url
    ]);

    if ($method === "POST") {
      curl_setopt($curl, CURLOPT_POST, 1);
      if (!empty($params)) curl_setopt($curl, CURLOPT_POST_PARAMS, $params);
    }


    if ($file !== null) {
      curl_setopt($curl, CURLOPT_FILE, $file);
    }

    $response = curl_exec($curl);
    curl_close($curl);

    if ($file === null) return $response;
    return true;
  }

  public static function httpJSONRequest($url, $method = "GET", $params = []) {
    $json = json_decode(self::httpRequest($url, $method, $params), true);
    if (json_last_error() !== JSON_ERROR_NONE) return false;

    return $json;
  }

  public static function request($action, $file = null) {
    global $conf;

    $url = self::API_ENDPOINT.$action."?app_id=".urlencode($conf["tmbApi"]["appId"])."&app_key=".urlencode($conf["tmbApi"]["appKey"]);

    if ($file === null) return self::httpJSONRequest($url);
    self::httpRequest($url, "GET", [], $file);
  }
}
