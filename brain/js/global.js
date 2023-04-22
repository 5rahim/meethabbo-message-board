function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

var btn = document.getElementsByClassName("button-modal");
for (var i = 0; i < btn.length; i++) {
	var thisBtn = btn[i];
thisBtn.addEventListener("click", function() {
  var modal = document.getElementById(this.dataset.modal);
  modal.style.display = "block";
}, false);

}

var span = document.getElementsByClassName("button-close");
for (var i = 0; i < span.length; i++) {
  var thisSpan = span[i];
  thisSpan.addEventListener("click", function(){

    var modaltoclose = document.getElementById(this.dataset.close);
    modaltoclose.style.display = "none";
	}, false);

}
