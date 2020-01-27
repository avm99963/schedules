<?php
require_once("core.php");

if (!isset($_GET["view"])) exit();

views::renderPage($_GET["view"]);
