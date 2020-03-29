function startTime() {
  var today = new Date();
  var hh = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  var dd = "AM";
  var h = hh;
  if (h >= 12) {
    h = hh - 12;
    dd = "PM";
  }
  if (h == 0) {
    h = 12;
  }

  m = m < 10 ? "0" + m : m;

  s = s < 10 ? "0" + s : s;

  // add a zero in front of numbers<10
  document.getElementById('time').innerHTML = h + ":" + m + ":" + s + " " + dd;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();