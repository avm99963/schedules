<?php
class gtfsHandler {
  public static $databases = [
    "agency" => [
      "columns" => [
        "agency_id" => "TEXT",
        "agency_name" => "TEXT NOT NULL",
        "agency_url" => "TEXT NOT NULL",
        "agency_timezone" => "TEXT NOT NULL",
        "agency_lang" => "TEXT",
        "agency_phone" => "TEXT",
        "agency_fare_url" => "TEXT",
        "agency_email" => "TEXT"
      ]
    ],
    "attributions" => [
      "columns" => [
        "attribution_id" => "TEXT PRIMARY KEY",
        "agency_id" => "TEXT",
        "route_id" => "TEXT",
        "trip_id" => "TEXT",
        "organization_name" => "TEXT NOT NULL",
        "is_producer" => "INT",
        "is_operator" => "INT",
        "is_authority" => "INT",
        "attribution_url" => "TEXT",
        "attribution_email" => "TEXT",
        "attribution_phone" => "TEXT"
      ]
    ],
    "stops" => [
      "columns" => [
        "stop_id" => "TEXT PRIMARY KEY",
        "stop_code" => "TEXT",
        "stop_name" => "TEXT",
        "stop_desc" => "TEXT",
        "stop_lat" => "TEXT",
        "stop_lon" => "TEXT",
        "zone_id" => "TEXT",
        "stop_url" => "TEXT",
        "location_type" => "INT",
        "parent_station" => "TEXT",
        "stop_timezone" => "TEXT",
        "wheelchair_boarding" => "INT",
        "level_id" => "TEXT",
        "platform_code" => "TEXT"
      ],
      "indexes" => ["parent_station"]
    ],
    "routes" => [
      "columns" => [
        "route_id" => "TEXT PRIMARY KEY",
        "agency_id" => "TEXT",
        "route_short_name" => "TEXT",
        "route_long_name" => "TEXT",
        "route_desc" => "TEXT",
        "route_type" => "INT NOT NULL",
        "route_url" => "TEXT",
        "route_color" => "TEXT",
        "route_text_color" => "TEXT",
        "route_sort_order" => "INT"
      ]
    ],
    "trips" => [
      "columns" => [
        "route_id" => "TEXT NOT NULL",
        "service_id" => "TEXT NOT NULL",
        "trip_id" => "TEXT PRIMARY KEY",
        "trip_headsign" => "TEXT",
        "trip_short_name" => "TEXT",
        "direction_id" => "INT",
        "block_id" => "TEXT",
        "shape_id" => "TEXT",
        "wheelchair_accessible" => "INT",
        "bikes_allowed" => "INT"
      ],
      "indexes" => ["route_id", "service_id"]
    ],
    "stop_times" => [
      "columns" => [
        "trip_id" => "TEXT NOT NULL",
        "arrival_time" => "TEXT",
        "departure_time" => "TEXT",
        "stop_id" => "TEXT NOT NULL",
        "stop_sequence" => "INT NOT NULL",
        "stop_headsign" => "TEXT",
        "pickup_type" => "INT",
        "drop_off_type" => "INT",
        "shape_dist_traveled" => "INT",
        "timepoint" => "INT"
      ],
      "indexes" => ["trip_id", "stop_id"],
      "times" => ["arrival_time", "departure_time"]
    ],
    "calendar" => [
      "columns" => [
        "service_id" => "TEXT PRIMARY KEY",
        "monday" => "INT NOT NULL",
        "tuesday" => "INT NOT NULL",
        "wednesday" => "INT NOT NULL",
        "thursday" => "INT NOT NULL",
        "friday" => "INT NOT NULL",
        "saturday" => "INT NOT NULL",
        "sunday" => "INT NOT NULL",
        "start_date" => "INT NOT NULL",
        "end_date" => "INT NOT NULL"
      ],
      "indexes" => ["start_date", "end_date"]
    ],
    "calendar_dates" => [
      "columns" => [
        "service_id" => "TEXT NOT NULL",
        "date" => "INT NOT NULL",
        "exception_type" => "INT NOT NULL"
      ],
      "indexes" => ["service_id", "date"]
    ],
    "fare_attributes" => [
      "columns" => [
        "fare_id" => "TEXT NOT NULL PRIMARY KEY",
        "price" => "FLOAT NOT NULL",
        "currency_type" => "INT NOT NULL",
        "payment_method" => "INT NOT NULL",
        "transfers" => "TEXT NOT NULL",
        "agency_id" => "TEXT",
        "transfer_duration" => "INT"
      ]
    ],
    "fare_rules" => [
      "columns" => [
        "fare_id" => "TEXT NOT NULL",
        "route_id" => "TEXT",
        "origin_id" => "TEXT",
        "destination_id" => "TEXT",
        "contains_id" => "TEXT",
      ]
    ],
    "shapes" => [
      "columns" => [
        "shape_id" => "TEXT",
        "shape_pt_lat" => "FLOAT NOT NULL",
        "shape_pt_lon" => "FLOAT NOT NULL",
        "shape_pt_sequence" => "INT NOT NULL",
        "shape_dist_traveled" => "FLOAT"
      ]
    ],
    "frequencies" => [
      "columns" => [
        "trip_id" => "TEXT NOT NULL",
        "start_time" => "TEXT NOT NULL",
        "end_time" => "TEXT NOT NULL",
        "headway_secs" => "INT NOT NULL",
        "exact_times" => "INT"
      ],
      "indexes" => ["trip_id"]
    ],
    "transfers" => [
      "columns" => [
        "from_stop_id" => "TEXT NOT NULL",
        "to_stop_id" => "TEXT NOT NULL",
        "transfer_type" => "INT NOT NULL",
        "min_transfer_time" => "INT"
      ],
      "indexes" => ["from_stop_id", "to_stop_id"]
    ],
    "pathways" => [
      "columns" => [
        "pathway_id" => "TEXT PRIMARY KEY",
        "from_stop_id" => "TEXT NOT NULL",
        "to_stop_id" => "TEXT NOT NULL",
        "pathway_mode" => "INT NOT NULL",
        "is_bidirectional" => "INT NOT NULL",
        "length" => "FLOAT",
        "traversal_time" => "INT",
        "stair_count" => "INT",
        "max_slope" => "FLOAT",
        "min_width" => "FLOAT",
        "signposted_as" => "TEXT",
        "reversed_signposted_as" => "TEXT"
      ]
    ],
    "levels" => [
      "columns" => [
        "level_id" => "TEXT PRIMARY KEY",
        "level_index" => "FLOAT NOT NULL",
        "level_name" => "TEXT"
      ]
    ],
    "feed_info" => [
      "columns" => [
        "feed_publisher_name" => "TEXT NOT NULL",
        "feed_publisher_url" => "TEXT NOT NULL",
        "feed_lang" => "TEXT NOT NULL",
        "feed_start_date" => "INT",
        "feed_end_date" => "INT",
        "feed_version" => "TEXT",
        "feed_contact_email" => "TEXT",
        "feed_contact_url" => "TEXT"
      ]
    ]
  ];

  public static function fixTime($time) {
    return str_pad($time, 8, "0", STR_PAD_LEFT);
  }

  public static function underscoreToCamelCase($string) {
    return lcfirst(str_replace('_', '', ucwords($string, '_')));
  }

  public static function camelCaseToUnderscore($string) {
    return strtolower(preg_replace("/([a-z])([A-Z])/", "$1_$2", $name));
  }

  public static function getFieldType($table, $field) {
    if (!isset(self::$databases[$table]) || !isset(self::$databases[$table]["columns"][$field])) return false;

    $definition = self::$databases[$table]["columns"][$field];

    return explode(",", explode(" ", $definition)[0])[0];
  }

  private static function addRowsToTable($dbName, &$dbTemplate, &$stream) {
    global $db;

    $db->beginTransaction();

    $query = null;

    $headers = [];
    $times = [];
    $flag = true;
    while (($line = fgetcsv($stream, null, ",")) !== false) {
      if ($flag) {
        $headers = $line;
        $sql = "INSERT INTO $dbName (".implode(", ", $headers).") VALUES (".implode(", ", array_fill(0, count($headers), "?")).")";
        if (isset($dbTemplate["times"])) {
          foreach ($dbTemplate["times"] as $field) {
            $times[] = array_search($field, $headers);
          }
        }
        $query = $db->prepare($sql);
        $flag = false;
        continue;
      }

      $values = array_map(function($value) {
        return trim($value);
      }, $line);

      foreach ($times as $time) {
        $values[$time] = self::fixTime($values[$time]);
      }

      $query->execute($values);
    }

    $db->commit();

    fclose($stream);
  }

  private static function setUpDatabase(&$zip) {
    global $conf, $db;

    @unlink($conf["databaseFile"]);
    $db = new PDO('sqlite:'.($conf["databaseFile"]));

    $db->beginTransaction();

    foreach (self::$databases as $dbName => $dbTemplate) {
      $definitions = [];
      foreach ($dbTemplate["columns"] as $column => $definition) {
        $definitions[] = $column." ".$definition;
      }

      $sql = "CREATE TABLE $dbName (".implode(", ", $definitions).")";
      if ($db->query($sql)) {
        echo "[info] Created table $dbName.\n";
      } else {
        echo "[error] Couldn't create table $dbName:\n".implode("\n", $db->errorInfo())."\n";
        $db->rollBack();
        exit();
      }

      if (isset($dbTemplate["indexes"])) {
        foreach ($dbTemplate["indexes"] as $index) {
          $sql = "CREATE INDEX ${dbName}_${index} ON $dbName ($index)";
          if ($db->query($sql)) {
            echo "[info] Created index $index.\n";
          } else {
            echo "[error] Couldn't create index $index:\n".implode("\n", $db->errorInfo())."\n";
            $db->rollBack();
            exit();
          }
        }
      }
    }

    $db->commit();

    foreach (self::$databases as $dbName => $dbTemplate) {
      $stream = $zip->getStream($dbName.".txt");
      if (!$stream) {
        echo "[warning] The $dbName file does not exist.\n";
        continue;
      }

      self::addRowsToTable($dbName, $dbTemplate, $stream);
      echo "[info] Added rows to $dbName.\n";
    }
  }

  public static function createDatabase($file) {
    $zip = new ZipArchive();
    $zip->open($file);

    echo "[info] Setting up database:\n";
    self::setUpDatabase($zip);
  }
}
