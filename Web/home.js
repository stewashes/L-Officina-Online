var SERVER_URL = "http://localhost/Server/";
var WEB_URL = "http://localhost/Web/";

var token = window.localStorage.token;

if (token) {
  //document.getElementById("link-registrazione").style.display = "none";
  //document.getElementById("link-login").style.display = "none";
  //document.getElementById("link-profilo").style.display = "";

  $("#link-registrazione").css("display", "none");
  $("#link-login").css("display", "none");
  $("#link-profilo").css("display", "");
}

function comparsaMenu() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function logout() {
  var x = confirm("Vuoi veramente sloggarti?");
  if (x) {
    $.post(SERVER_URL + "logOut.php?token=" + token);
    window.localStorage.removeItem("token"); //window.localStorage.token = null;
  }
}
