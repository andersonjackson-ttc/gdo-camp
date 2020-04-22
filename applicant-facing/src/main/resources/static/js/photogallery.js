$(document).ready(function() {
  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function() {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function() {
    moveDrawer();
  };
});

//function that closes or opens the side drawer based on if drawer is open already
function moveDrawer() {
  document.getElementById("sidedrawer").classList.toggle("open");
  document.getElementById("backdrop").classList.toggle("backdrop");
}
