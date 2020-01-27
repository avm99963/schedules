<?php
require_once(__DIR__."/../core.php");

echo "[info] Getting gtfs.zip file...\n";
$temp = tmpfile();
tmbApi::request("static/datasets/gtfs.zip", $temp);

echo "\n";

gtfsHandler::createDatabase(stream_get_meta_data($temp)['uri']);
