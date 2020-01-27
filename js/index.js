window.addEventListener("load", _ => {
  fetch("ajax/api.php?action=stations").then(res => res.json()).then(res => {
    if (res.status != "ok") throw Error("a");

    var select = document.getElementById("station");

    res.data.forEach(station => {
      var option = document.createElement("option");
      option.value = station.stop_id;
      option.textContent = station.stop_name;
      select.appendChild(option);
    });

    select.disabled = false;
  }).catch(err => console.error(err));

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js').then(function(registration) {
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      console.log('ServiceWorker registration failed: ', err);
    });
  }
});
