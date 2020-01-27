<?php
/*require_once("core.php");

$element = "Gtfs\CalendarDate";

$item = new $element([
  "service_id" => "a",
  "date" => "b",
  "exception_type" => Gtfs\CalendarDate\ExceptionType::ADDED
]);

//$feed->setServiceId(Gtfs\CalendarDate\ExceptionType::ADDED);

var_dump(json_decode($item->serializeToJsonString(), true));
*/
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
    @media (orientation: landscape) {
      :root {
        --size: 4vh;
      }
    }

    @media (orientation: portrait) {
      :root {
        --size: 4vw;
      }
    }

    .a {
      font-size: calc(4 * var(--size));
      background: cyan;
      width: 400px;
      height: 400px;
    }
    </style>
  </head>
  <body>
    <div class="a">
      Adri
    </div>
  </body>
</html>
