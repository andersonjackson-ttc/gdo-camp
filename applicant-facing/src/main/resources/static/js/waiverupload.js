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
      document.getElementById("download").style.display = "none";
      document.getElementById("upload").style.display = "none";
    } else {
      if (data.waiverStatus == "Not Submitted") {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          "! If you're seeing this page, you've successfully submitted your " +
          "application for Girl's Day Out 2020! " +
          "Please upload signed waivers before the due date so your child will be able to participate!";
      } else if (data.waiverStatus == "Pending") {
        document.getElementById("feedback").innerHTML =
          "Your waivers have been submitted, and are pending approval. Please check back at a " +
          "later date to see the updated status of your submitted waivers.";
        document.getElementById("download").style.display = "none";
        document.getElementById("upload").style.display = "none";
      } else if (data.waiverStatus == "Approved") {
        document.getElementById("feedback").innerHTML =
          "Good news " +
          data.fName +
          "! Your waivers have been approved for Girl's Day Out 2020!" +
          " Please continue to check your e-mail for any information regarding the upcoming camp!";
        document.getElementById("download").style.display = "none";
        document.getElementById("upload").style.display = "none";
      } else {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          ". Unfortunately the waivers you have submitted could not be approved. Please check your e-mail to " +
          "see why this was the case. Once you have done so, please upload corrected signed waivers for Girl's Day Out 2020.";
      }
    }
  }
});
