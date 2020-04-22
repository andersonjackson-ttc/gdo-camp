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
    } else {
      if (data.appStatus == "Pending") {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          "! Your application is currently pending. If you have any questions or concerns and would like to contact us, " +
          "please visit the 'Contact Us' page for contact information. Please check back at a later date to " +
          "see the updated status of your application.";
      } else if (data.appStatus == "Approved") {
        document.getElementById("feedback").innerHTML =
          "Good news " +
          data.fName +
          "! Your application has been approved! If you haven't already done so, please make sure that " +
          "your waivers are signed and submitted. We look forward to you joining us for Girl's Day Out 2020!";
      } else {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          ". Unfortunately your application has been denied. Please check your e-mail to " +
          "see why this was the case.";
      }
    }
  }
});
