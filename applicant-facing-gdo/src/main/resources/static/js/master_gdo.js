$(document).ready(function () {
  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  var prevScrollpos = window.pageYOffset;
  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("toolbar").style.top = "0";
    } else {
      document.getElementById("toolbar").style.top = "-60px";
    }
    prevScrollpos = currentScrollPos;
  };
});

//function that closes or opens the side drawer based on if drawer is open already
function moveDrawer() {
  document.getElementById("sidedrawer").classList.toggle("open");
  document.getElementById("backdrop").classList.toggle("backdrop");
}

//function that counts characters in Contact Us Message textbox and adds chars remaining underneath
function countMessChars(obj) {
  var maxLength = 500;
  var strLength = obj.value.length;

  if (strLength >= maxLength) {
    document.getElementById("mess-chars").innerHTML =
      "ZERO CHARACTERS REMAINING";
  } else {
    document.getElementById("mess-chars").innerHTML =
      maxLength - strLength + " characters remaining";
  }
}
