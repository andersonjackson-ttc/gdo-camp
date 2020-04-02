$(document).ready(function() {
  var url = window.location.href;
  var id = url.substring(url.lastIndexOf("/") + 1);
  var jsonUrl = "http://localhost:8080/applicant/" + id;

  const request = async () => {
    const response = await fetch(jsonUrl);
    const data = await response.json();
    changeHTML(data);
  };

  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function() {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function() {
    moveDrawer();
  };
  request();

  //function that closes or opens the side drawer based on if drawer is open already
  function moveDrawer() {
    document.getElementById("sidedrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("backdrop");
  }

  // Function that changes HTML page depending on the status of the applicant's waivers
  function changeHTML(data) {
    if (data == null) {
      document.getElementById("feedback").innerHTML =
        "Sorry, this applicant does not exist! Please verify the ID in the url matches the ID e-mailed to you.";
      document.getElementById("feedback").style.color = "red";
      document.getElementById("nextstep").style.display = "none";
    } else {
      document.getElementById("feedback").innerHTML =
        "Hello, " +
        data.fName +
        "! Your application has been submitted. Please check your e-mail for verification.";
      document.getElementById("nextstep").style.display = "block";
      document
        .getElementById("waiverlink")
        .setAttribute("href", "http://localhost:8080/waiver/" + data.recordId);
    }
  }
});
