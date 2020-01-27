<?php
class api {
  private function writeJSON($array) {
    echo json_encode($array);
  }

  private function error($error = null) {
    self::writeJSON(["status" => "error", "error" => $error]);
    exit();
  }

  private function returnData($data) {
    self::writeJSON(["status" => "ok", "data" => $data]);
    exit();
  }

  public static function handleRequest() {
    global $_GET, $_POST;

    if (!isset($_GET["action"])) self::error("actionNotProvided");

    switch ($_GET["action"]) {
      case "linies":
      $liniesFull = tmbApi::request("transit/linies/metro");
      if ($liniesFull === false || !isset($liniesFull["features"])) self::error("unexpected");

      $linies = [];
      foreach ($liniesFull["features"] as $linia) {
        if (!isset($linia["properties"])) self::error("unexpected");
        $linies[] = [
          "id" => $linia["properties"]["ID_LINIA"] ?? null,
          "nom" => $linia["properties"]["NOM_LINIA"] ?? "",
          "desc" => $linia["properties"]["DESC_LINIA"] ?? "",
          "color" => $linia["properties"]["COLOR_LINIA"] ?? "000",
          "colorText" => $linia["properties"]["COLOR_TEXT_LINIA"] ?? "fff",
          "ordre" => $linia["properties"]["ORDRE_LINIA"] ?? 0
        ];
      }

      usort($linies, function ($a, $b) {
        return $a["ordre"] - $b["ordre"];
      });

      self::returnData($linies);
      break;

      case "estacions":
      if (!isset($_GET["linia"])) self::error("missingArguments");
      $linia = (int)$_GET["linia"];
      $estacionsFull = tmbApi::request("transit/linies/metro/".$linia."/estacions");
      if ($estacionsFull === false || !isset($estacionsFull["features"])) self::error("unexpected");

      $estacions = [];
      foreach ($estacionsFull["features"] as $estacio) {
        if (!isset($estacio["properties"])) self::error("unexpected");
        $estacions[] = [
          "id" => $estacio["properties"]["CODI_ESTACIO"] ?? null,
          "nom" => $estacio["properties"]["NOM_ESTACIO"] ?? "",
          "color" => $estacio["properties"]["COLOR_LINIA"] ?? "000",
          "ordre" => $estacio["properties"]["ORDRE_ESTACIO"] ?? 0
        ];
      }

      usort($estacions, function ($a, $b) {
        return $a["ordre"] - $b["ordre"];
      });

      self::returnData($estacions);
      break;

      default:
      self::error("actionNotImplemented");
    }
  }
}
