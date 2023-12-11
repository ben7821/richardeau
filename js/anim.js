
const ending = document.querySelector(".ending");

$(document).ready(function () {

  $("#form").submit(function (event) {
    event.preventDefault();
    animateEnding();
  });
});

function animateEnding() {
  ending.classList.add("ending-animate");
  setTimeout(function () {
    $("#form").unbind("submit").submit();
  }, 2000);
}

