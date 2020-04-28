$(document).ready(function () {
  //page url is assigned to url var
  var url = window.location.href;

  //code that removes trailing slashes if user adds trailing slashes
  while (url.charAt(url.length - 1) == "/") {
    url = url.substr(0, url.length - 1);
  }

  //id is substring after last /, combined with /applicant/ to make url used to fetch JSON
  var id = url.substring(url.lastIndexOf("/") + 1);
  var jsonUrl = "/applicant/" + id;

  //function that fetches JSON, calls changeHTML function
  const request = async () => {
    const response = await fetch(jsonUrl);
    const data = await response.json();
    changeHTML(data);
  };

  //hides waiver button on page load
  document.getElementById("waiverLink").style.display = "none";

  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  //calls function that fetches JSON
  request();

  //function that closes or opens the side drawer based on if drawer is open already
  function moveDrawer() {
    document.getElementById("sidedrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("backdrop");
  }

  // Function that changes HTML page depending on the status of the applicant's waivers
  function changeHTML(data) {
    //if data is null, tell user id must be incorrect
    if (data == null) {
      document.getElementById("feedback").innerHTML =
        "Sorry, this applicant does not exist! Please verify the ID in the url matches the ID e-mailed to you.";
      document.getElementById("feedback").style.color = "red";
    }
    //if data is found, do certain things based on application status
    else {
      document.getElementById("appstatus").innerHTML =
        "Application Status: " + data.appStatus + "";

      if (
        data.appStatus.toUpperCase() == "PENDING" &&
        (data.waiverStatus.toUpperCase() == "NOT SUBMITTED" ||
          data.waiverStatus.toUpperCase() == "DENIED")
      ) {
        document.getElementById("waiversneeded").innerHTML =
            "Waivers still need to be submitted before your application can be reviewed";
        document.getElementById("waiversneeded").style.color = "red";

        //sets href attribute for waiver button
        document
            .getElementById("waiverLink")
            .setAttribute("href", "/waiver/" + id);

        //makes waiver button visible if waivers not submitted
        document.getElementById("waiverLink").style.display = "block";

        document.getElementById("appstatus").innerHTML =
          "Application Status: " + data.appStatus;

        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          "! Your application is currently pending. If you have any questions or concerns and would like to contact us, " +
          "please visit the <a href='contactus'>Contact Us</a> page for contact information. Please check back at a later date to " +
          "see the updated status of your application.";
      } else if (data.appStatus.toUpperCase() == "PENDING") {
        document.getElementById("appstatus").innerHTML =
          "Application Status: Under Review";

        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          "! Your application is waiting to be reviewed. If you have any questions or concerns and would like to contact us, " +
          "please visit the <a href='contactus'>Contact Us</a> page for contact information. Please check back at a later date to " +
          "see the updated status of your application.";
      } else if (data.appStatus.toUpperCase() == "APPROVED") {
        document.getElementById("appstatus").innerHTML =
          "Application Status: APPROVED ✓";
        document.getElementById("feedback").innerHTML =
          "Good news " +
          data.fName +
          "! Your application has been approved! We look forward to you joining us for Girl's Day Out 2020!";
      } else if (data.appStatus.toUpperCase() == "WAITLIST") {
        document.getElementById("appstatus").innerHTML =
          "Application Status: " + data.appStatus;
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          ". You are currently on the wait list for Girl's Day Out. Please check back here for any possible updates!";
      } else {
        document.getElementById("appstatus").innerHTML =
          "Application Status: " + data.appStatus;
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          ". Unfortunately your application has been denied." +
          "<br><br>Reason for Application Denial: " +
          data.deniedReason;
      }
    }
  }
});
