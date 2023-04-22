

// Ouvrir une modal
var btn = document.getElementsByClassName("button_openpush");

for (var i = 0; i < btn.length; i++) {
  var thisBtn = btn[i];
  thisBtn.addEventListener("click", function(){

    var push = document.getElementById(this.dataset.openpush);
    push.style.display = "block";

	}, false);
}

// Fermer une modal
var btn = document.getElementsByClassName("button_closepush");

for (var i = 0; i < btn.length; i++) {
  var thisBtn = btn[i];
  thisBtn.addEventListener("click", function(){

    var push = document.getElementById(this.dataset.closepush);
    push.style.display = "none";

	}, false);
}
