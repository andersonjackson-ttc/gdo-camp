$(document).ready(function () {
  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  //function that closes or opens the side drawer based on if drawer is open already
  function moveDrawer() {
    document.getElementById("sidedrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("backdrop");
  }

  addButtonLink();
});

function addButtonLink() {
  var url = window.location.href;

  //code that removes trailing slashes if user adds trailing slashes
  while (url.charAt(url.length - 1) == "/") {
    url = url.substr(0, url.length - 1);
  }

  //splits sections of path into arrays
  var pathArray = url.split("/");

  //4th section of the url holds the record id. assigning it to the id var
  var id = pathArray[4];

  //setting the app status button to link to this specific applicant's application status page
  document
    .getElementById("statuslink")
    .setAttribute("href", "/application/status/" + id);
}
