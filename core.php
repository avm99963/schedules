<?php
// Core of the application

require __DIR__.'/vendor/autoload.php';

// Classes autoload
spl_autoload_register(function($className) {
  include_once(__DIR__."/inc/".str_replace("\\", DIRECTORY_SEPARATOR, str_replace("..", "", $className)).".php");
});

// Getting configuration
require_once(__DIR__."/config.php");

// Setting timezone and locale accordingly
date_default_timezone_set("Europe/Madrid");
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
