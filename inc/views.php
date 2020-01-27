<?php
class views {
  const VIEW_L9N_OLD = 0;
  const VIEW_L9N_NEW = 1;
  const VIEW_L9S = 2;

  public static $views = [self::VIEW_L9N_OLD, self::VIEW_L9N_NEW, self::VIEW_L9S];
  public static $viewsNames = [
    self::VIEW_L9N_OLD => "VIEW_L9N_OLD",
    self::VIEW_L9N_NEW => "VIEW_L9N_NEW",
    self::VIEW_L9S => "VIEW_L9S"
  ];
  public static $viewsInclude = [
    self::VIEW_L9N_OLD => "l9n.php",
    self::VIEW_L9N_NEW => "l9n.php",
    self::VIEW_L9S => "l9s.php"
  ];

  public static function renderPage($view) {
    if (!in_array($view, self::$views)) return;

    $gtfs = new gtfs();

    require_once(__DIR__."/../views/".self::$viewsInclude[$view]);
  }
}
