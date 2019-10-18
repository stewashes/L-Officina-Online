$("#form").submit(function(event) {
  //listener
  // pulsante in ascolto

  event.preventDefault();
  event.returnValue = false;
  
  var data = {};
  data.firstname = $("#firstname").val();
  data.lastname = $("#lastname").val();
  data.city = $("#city").val();
  data.username = $("#username").val(); //-> document.getElementById("username").value
  data.password = $("#password").val(); // sono la stessa cosa
  data.conferma = $("#conferma").val();
  var x = false;

  // controllo la password e il reinserimento devono coincidere
  if (data.password != data.conferma) {
    $("#confermamsg").css("display", "");
    //document.getElementById("confermamsg").style.display = "";
    x = true;
  } else $("#confermamsg").css("display", "none");
  // else document.getElementById("confermamsg").style.display = "none";
  // controllo password e username non possono coincidere

  // se l'input soddisfa i controlli precedenti
  // passo i dati al server per la "registrazione"
  if (x === false) {
    $.post(SERVER_URL + "registrazione.php", data, function(data) {
      if (data.hasLoggedIn) {
        window.localStorage.token = data.token;
        window.location.href = WEB_URL + "home.html";
      } else {
        alert("Username gi\xE0 utilizzato");
      }
    });
  }
});
