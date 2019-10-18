var countDownDate = new Date("Jun 2, 2019 8:00:00").getTime();

var countdownfunction = setInterval(function() {
  var now = new Date().getTime();

  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("tempo").innerHTML =
    days + "g " + hours + "o " + minutes + "m " + seconds + "s ";

  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("tempo").innerHTML = "EXPIRED";
  }
}, 1000);
