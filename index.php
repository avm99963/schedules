<?php
require_once("core.php");

$gtfs = new gtfs();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Panell d'informació</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <form action="info.php" method="GET">
      <p>
        <label for="station">Estació:</label>
        <select name="station" id="station" required disabled></select>
      </p>
      <p>
        <label for="view">Vista:</label>
        <select name="view" id="view" required>
          <?php
          foreach (views::$views as $view) {
            echo '<option value="'.(int)$view.'">'.security::htmlsafe(views::$viewsNames[$view] ?? "undefined").'</option>';
          }
          ?>
        </select>
      </p>
      <p>
        <button>Mostrar</button>
      </p>
    </form>

    <script src="js/index.js"></script>
  </body>
</html>
