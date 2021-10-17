<?php
class api {
  private static function writeJSON($array) {
    echo json_encode($array);
  }

  private static function error($error = null) {
    self::writeJSON(["status" => "error", "error" => $error]);
    exit();
  }

  private static function returnData($data) {
    self::writeJSON(["status" => "ok", "data" => $data]);
    exit();
  }

  private static function transformRouteShortName($name) {
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

      $todayTimestamp = (new DateTime("today"))->getTimestamp();
      $nowTimestamp = (new DateTime("now"))->getTimestamp();

      $schedules = [];
      $routes = [];
      foreach ($times as $time) {
        if ($time["trip_headsign"] == $stop["stop_name"]) continue;

        if ($time["date"]) {
          // In this case the train was specifically scheduled for this date,
          // so we are given the exact date.
          $date = new DateTime($time["date"]);
          $arrivalTime = gtfs::time2seconds($time["arrival_time"], false);
          $departureTime = gtfs::time2seconds($time["departure_time"], false);
          while ($departureTime >= 24*60*60) {
            $arrivalTime -= 24*60*60;
            $departureTime -= 24*60*60;
            $date->add(new DateInterval("P1D"));
          }

          $dayTimestamp = $date->getTimestamp();
        } else {
          // In this case the train was scheduled several days, so we'll check
          // whether the train has already passed today (in which case it will
          // pass tomorrow) or it hasn't (in which case it will pass today).
          $arrivalTime = gtfs::time2seconds($time["arrival_time"], true);
          $departureTime = gtfs::time2seconds($time["departure_time"], true);
          if ($todayTimestamp + $departureTime >= $nowTimestamp)
            $dayTimestamp = $todayTimestamp;
          else
            $dayTimestamp = $todayTimestamp->add(new DateInterval("P1D"));
        }

        $schedule = [
          "destination" => $time["trip_headsign"],
          "arrivalTime" => $dayTimestamp + $arrivalTime,
          "departureTime" => $dayTimestamp + $departureTime,
          "route" => self::transformRouteShortName($time["route_short_name"]),
          "color" => $time["route_color"],
          "textColor" => $time["route_text_color"]
        ];
        if (isset($_GET["includeSqlRows"]))
          $schedule["originalSqlRow"] = $time;

        $schedules[] = $schedule;

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
