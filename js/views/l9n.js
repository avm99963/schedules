Number.prototype.mod = function(n) {
  return ((this % n) + n) % n;
}

var scheduleController = {
  maxSchedules: 6,
  recommendedSchedulesPerLine: 2,
  fetchInterval: 8*60*1000,
  _times: [],
  _queueTimes: [],
  _lastTime: -1,
  _lastDestinations: [],
  _numRoutes: -1,
  _stop: -1,
  init: function() {
    scheduleController.setStop();
    scheduleController.removeDummy();
    scheduleController.fetchTimes();
    scheduleController.timer();
  },
  setStop: function() {
    var params = new URLSearchParams(window.location.search);
    scheduleController._stop = params.get("station");
  },
  isOldView: function() {
    return document.body.classList.contains("view-old");
  },
  numSchedules: function() {
    return Math.min(scheduleController.maxSchedules, 2 * scheduleController.recommendedSchedulesPerLine * scheduleController._numRoutes);
  },
  numSchedulesDetailed: function() {
    return Math.ceil(scheduleController.numSchedules() / 2);
  },
  isDetailed: function(i) {
    return (i < scheduleController.numSchedulesDetailed());
  },
  removeElement: function(el) {
    el.parentNode.removeChild(el);
  },
  removeDummy: function() {
    document.getElementById("trains").innerHTML = "";
  },
  timeSinceMidnight: function() {
    var now = new Date();
    var then = new Date(
      now.getFullYear(),
      now.getMonth(),
      now.getDate(),
      0,0,0);
    return Math.floor((now.getTime() - then.getTime())/1000);
  },
  prettyTime: function(seconds, detailed = true) {
    if (detailed) return (Math.floor(seconds/60)).toString().padStart(2, '0')+":"+(seconds % 60).toString().padStart(2, '0');
    return Math.floor(seconds/60)+"min";
  },
  addCurrentTime: function(data) {
    var trains = document.getElementById("trains");

    var train = document.createElement("div");
    train.setAttribute("class", "train");

    var logo = document.createElement("div");
    logo.setAttribute("class", "logo");
    logo.style.backgroundColor = "#"+data.color;
    logo.style.color = "#"+data.textColor;
    logo.style.fontSize = ("calc("+((scheduleController.isOldView() ? 20 : 18)/data.route.length)+"*var(--unit-size))");
    logo.textContent = data.route;
    train.appendChild(logo);

    var destination = document.createElement("div");
    destination.setAttribute("class", "destination");
    destination.textContent = data.destination;
    train.appendChild(destination);

    var time = document.createElement("div");
    time.setAttribute("class", "time");
    train.appendChild(time);

    trains.appendChild(train);

    data._element = time;
    data._markedToRemove = false;
    scheduleController._times.push(data);
  },
  addTime: function(data) {
    if (data.departureTime > scheduleController._lastTime) {
      scheduleController._lastTime = data.departureTime;
      scheduleController._lastDestinations = [data.destination];
    } else if (data.departureTime == scheduleController.lastTime) {
      var flag = false;
      scheduleController._lastDestinations.forEach(dest => {
        if (data.destination == dest) flag = true;
      });

      if (flag) {
        return;
      }

      scheduleController._lastDestinations.push(dest);
    } else return;

    if (scheduleController._times.length < scheduleController.numSchedules()) {
      scheduleController.addCurrentTime(data);
    } else {
      scheduleController._queueTimes.push(data);
    }
  },
  fetchTimes: function() {
    fetch("ajax/api.php?action=getTimes&stop="+scheduleController._stop).then(res => {
      return res.json();
    }).then(json => {
      if (json.status != "ok") throw Error("Not ok");

      scheduleController._numRoutes = json.data.numRoutes;

      json.data.schedules.forEach(data => {
        scheduleController.addTime(data);
      });
    });

    setTimeout(scheduleController.fetchTimes, scheduleController.fetchInterval);
  },
  timer: function() {
    var timeSinceMidnight = scheduleController.timeSinceMidnight();

    var removed = 0;
    for (var i = 0;; ++i) {
      if (scheduleController._times[i - removed] === undefined) break;

      if (scheduleController._times[i - removed]._markedToRemove) {
        scheduleController.removeElement(scheduleController._times[i - removed]._element.parentNode);
        scheduleController._times.shift();
        ++removed;
      } else if (scheduleController._times[i - removed].departureTime - timeSinceMidnight == 0) {
        scheduleController._times[i - removed]._markedToRemove = true;
      }
    }

    for (var i = 0; i < removed; ++i) {
      if (scheduleController._queueTimes.length > 0) {
        scheduleController.addCurrentTime(scheduleController._queueTimes.shift());
      }
    }

    var i = 0;
    scheduleController._times.forEach(time => {
      var diff = (time.departureTime - timeSinceMidnight).mod(24*60*60);

      time._element.textContent = scheduleController.prettyTime(diff, scheduleController.isDetailed(i));

      ++i;
    });

    setTimeout(scheduleController.timer, (1000 - (new Date().getTime()) % 1000));
  }
};

window.addEventListener("load", _ => {
  scheduleController.init();
});
