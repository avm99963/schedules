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

  private function transformRouteShortName($name) {
    if ($name == "L9N") return "L9";
    if ($name == "L10N") return "L10";
    return $name;
  }

  public static function handleRequest() {
    global $_GET, $_POST, $conf;

    header("Content-Type: application/json");

    if (!isset($_GET["action"])) self::error("actionNotProvided");

    $gtfs = new gtfs();

    switch ($_GET["action"]) {
      case "routes":
      self::returnData($gtfs->getRoutes());
      break;

      case "trips":
      if (!isset($_GET["route"])) self::error("missingArguments");
      $route = $_GET["route"];

      self::returnData($gtfs->getTrips($route));
      break;

      case "stations":
      self::returnData($gtfs->getStations(true));

      /*$estacionsFull = tmbApi::request("transit/linies/metro/".$linia."/estacions");
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
      });*/
      break;

      case "getTimes":
      if (!isset($_GET["stop"])) self::error("missingArguments");

      $stop = $gtfs->getStop($_GET["stop"]);
      $times = $gtfs->getStopTimes($_GET["stop"]);

      $schedules = [];
      $routes = [];
      foreach ($times as $time) {
        if ($time["trip_headsign"] == $stop["stop_name"]) continue;
        $schedules[] = [
          "destination" => $time["trip_headsign"],
          "arrivalTime" => gtfs::time2seconds($time["arrival_time"]),
          "departureTime" => gtfs::time2seconds($time["departure_time"]),
          "route" => self::transformRouteShortName($time["route_short_name"]),
          "color" => $time["route_color"],
          "textColor" => $time["route_text_color"]
        ];

        if (!in_array($time["route_short_name"], $routes)) $routes[] = $time["route_short_name"];
      }

      $timeSinceMidnight = gtfs::timeSinceMidnight();

      usort($schedules, function($a, $b) use ($timeSinceMidnight) {
        return ($a["departureTime"] - $b["departureTime"]) % (24*60*60);
      });

      $data = [
        "schedules" => $schedules,
        "numRoutes" => count($routes)
      ];

      self::returnData($data);
      break;

      default:
      self::error("actionNotImplemented");
    }
  }
}
