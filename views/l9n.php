<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Panell d'informació</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/views/l9n.css">
  </head>
  <body class="<?=($view == views::VIEW_L9N_OLD ? "view-old" : "view-new")?>">
    <div id="container">
      <div id="trains">
        <div class="train" style="filter: blur(10px);">
          <div class="logo" style="background-color: #FB712B; color: #ffffff;">L9</div>
          <div class="destination">La Sagrera</div>
          <div class="time">02:07</div>
        </div>
        <div class="train" style="filter: blur(10px);">
          <div class="logo" style="background-color: #FB712B; color: #ffffff;">L9</div>
          <div class="destination">Can Zam</div>
          <div class="time">05:42</div>
        </div>
        <div class="train" style="filter: blur(10px);">
          <div class="logo" style="background-color: #FB712B; color: #ffffff;">L9</div>
          <div class="destination">La Sagrera</div>
          <div class="time">8min</div>
        </div>
        <div class="train" style="filter: blur(10px);">
          <div class="logo" style="background-color: #FB712B; color: #ffffff;">L9</div>
          <div class="destination">Can Zam</div>
          <div class="time">11min</div>
        </div>
      </div>
      <div id="rightpanel">
      </div>
    </div>

    <div class="marquee">
    </div>

    <script src="js/views/l9n.js"></script>
  </body>
</html>
