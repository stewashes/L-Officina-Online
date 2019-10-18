$("#form").submit(function(event) {
  //listener

  event.preventDefault();
  event.returnValue = false;
  var data = {};

  data.username = $("#username").val();
  data.password = $("#password").val();

  //con questi due si blocca completamente il sito
  //data.username =document.getElementById("username");
  //data.username =document.getElementById("password");

  $.post(SERVER_URL + "login.php", data, function(data) {
    if (data.hasLoggedIn) {
      window.localStorage.token = data.token;
      window.location.href = WEB_URL + "home.html";
    } else {
      alert("Password o Username non corretto");
    }
  });
});