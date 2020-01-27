<?php
class gtfs {
  //private static $files = ["calendar_dates", "calendar", "routes", "stop_times", "stops", "trips"];

  private $db;

  private static $dow = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];

  function __construct($path = null) {
    global $conf;

    try {
      $this->db = new PDO('sqlite:'.($conf["databaseFile"]));
    } catch (PDOException $e) {
      die("SQLite error: $e\n");
    }
  }

  static function timeSinceMidnight() {
    //return 8*60*60 + 9*60; //TESTING
    return (time() - mktime(0, 0, 0));
  }

  static function today() {
    return date("Ymd");
  }

  static function time2seconds($time) {
    $timeSinceMidnight = self::timeSinceMidnight();

    $boom = explode(":", $time);
    if (count($boom) != 3) return null;

    return ((($boom[0]*60) + $boom[1])*60 + $boom[2]) % (24*60*60);
  }

  private function fetchAll($sql) {
    $query = $this->db->query($sql);
    if (!$query) return false;

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  private function fetchAllPrepared($sql, $values) {
    $query = $this->db->prepare($sql);
    if (!$query) return false;

    $query->execute($values);
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  private function fetchTable($table, $filters = [], $orderedField = null) {
    $order = ($orderedField === null ? "" : " ORDER BY $orderedField");

    if (!count($filters)) {
      return $this->fetchAll("SELECT * FROM $table".$order);
    }

    $whereConditions = [];
    $values = [];
    foreach ($filters as $filter) {
      $whereConditions[] = $filter[0]." = ?";
      $values[] = $filter[1];
    }

    return $this->fetchAllPrepared("SELECT * FROM $table WHERE ".implode(" AND ", $whereConditions).$order, $values);
  }

  function getRoutes() {
    return $this->fetchTable("routes");
  }

  function getTrips($route) {
    return $this->fetchTable("trips", [["route_id", $route]]);
  }

  function getStations($ordered = false) {
    return $this->fetchTable("stops", [["location_type", Gtfs\Stop\LocationType::STATION]], ($ordered ? "stop_name" : null));
  }

  function getStop($stop) {
    $results = $this->fetchTable("stops", [["stop_id", $stop]]);

    if (!count($results)) return null;

    return $results[0];
  }

  function getPlatforms($stop) {
    $results = $this->fetchTable("stops", [["parent_station", $stop], ["location_type", Gtfs\Stop\LocationType::STOP]], "stop_id");

    return $results;
  }

  const TIME_LIMIT = 160;
  function getStopTimes($stop, $timeLimit = self::TIME_LIMIT) {
    $stops = $this->getPlatforms($stop);

    $values = [];
    foreach ($stops as $s) {
      $values[] = $s["stop_id"]; // Stops
    }

    $rdow = (int)date("w");
    $dow = self::$dow[$rdow]; // Today's day of week
    $dow2 = self::$dow[($rdow + 1) % 7]; // Tomorrow's day of week

    if (!count($stops)) return [];

    $sql = "SELECT st.*, t.*, r.*, c.*, cd.*, strftime('%Y%m%d', 'now', 'localtime') as today, strftime('%Y%m%d', 'now', 'localtime', '1 day') as tomorrow, time('now', 'localtime') as now
      FROM stop_times st
      INNER JOIN trips t
        ON st.trip_id = t.trip_id
      INNER JOIN routes r
        ON t.route_id = r.route_id
      LEFT JOIN calendar c
        ON t.service_id = c.service_id
      LEFT JOIN calendar_dates cd
        ON t.service_id = cd.service_id
      WHERE
      st.stop_id IN (".implode(", ", array_fill(0, count($stops), "?")).") AND
      (
        cd.service_id IS NULL OR
        cd.exception_type = ".(int)Gtfs\CalendarDate\ExceptionType::ADDED."
      ) AND
      (
        (
          (
            (
              time(now) < time('00:00:00', '-".(int)$timeLimit." minutes') AND
              st.departure_time BETWEEN time(now) AND time(now, '".(int)$timeLimit." minutes')
            ) OR
            (
              time(now) >= time('00:00:00', '-".(int)$timeLimit." minutes') AND
              st.departure_time BETWEEN time(now) AND strftime('24:%M:%S', now, '".(int)$timeLimit." minutes')
            )
          ) AND
          (
            c.service_id IS NULL OR
            (
              c.start_date <= today AND
              c.end_date >= today AND
              c.$dow = ".(int)Gtfs\Calendar\CalendarDay::AVAILABLE."
            )
          ) AND
          (
            cd.service_id IS NULL OR
            cd.date = today
          )
        ) OR
        (
          (
            (
              time(now) < time('00:00:00', '-".(int)$timeLimit." minutes') AND
              st.departure_time BETWEEN ((strftime('%H', now) + 24) || strftime(':%M:%S', now)) AND ((strftime('%H', now, '".(int)$timeLimit." minutes') + 24) || strftime(':%M:%S', now, '".(int)$timeLimit." minutes'))
            ) OR
            (
              time(now) >= time('00:00:00', '-".(int)$timeLimit." minutes') AND
              st.departure_time BETWEEN time(now) AND strftime('24:%M:%S', now, '".(int)$timeLimit." minutes')
            )
          ) AND
          (
            c.service_id IS NULL OR
            (
              c.start_date <= tomorrow AND
              c.end_date >= tomorrow AND
              c.$dow2 = ".(int)Gtfs\Calendar\CalendarDay::AVAILABLE."
            )
          ) AND
          (
            cd.service_id IS NULL OR
            cd.date = tomorrow
          )
        )
      )
      ORDER BY departure_time ASC";

    $result = $this->fetchAllPrepared($sql, $values);
    if ($result === false) {
      echo implode("\n", $this->db->errorInfo());
      exit();
    }

    return $result;
  }

  function __destruct() {
    $this->db = null;
  }
}
