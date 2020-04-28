$(document).ready(function () {
  //assigns page url to url var
  var url = window.location.href;

  //code that removes trailing slashes if user adds trailing slashes
  while (url.charAt(url.length - 1) == "/") {
    url = url.substr(0, url.length - 1);
  }

  //id is the substring after the last /
  var id = url.substring(url.lastIndexOf("/") + 1);
  //combining id with applicant address. JSON url that fetches applicant data
  var jsonUrl = "/applicant/" + id;

  //function that fetches JSON data from server
  const request = async () => {
    const response = await fetch(jsonUrl);
    const data = await response.json();
    changeHTML(data);
  };

  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  //calls the function that fetches data
  request();

  //function that closes or opens the side drawer based on if drawer is open already
  function moveDrawer() {
    document.getElementById("sidedrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("backdrop");
  }

  // Function that changes HTML page depending on the status of the applicant's waivers
  function changeHTML(data) {
    //if data is null, tell user that ID must be incorrect
    if (data == null) {
      document.getElementById("feedback").innerHTML =
        "Sorry, this applicant does not exist! Please verify the ID in the url matches the ID e-mailed to you.";
      document.getElementById("feedback").style.color = "red";
      document.getElementById("download").style.display = "none";
      document.getElementById("upload").style.display = "none";
    }
    //if data is found
    else {
      //add url action, specific to the applicant, to the submit button
      document.getElementById("waiverform").action =
        "/waiver/" + data.recordId + "/submit";

      //if waivers are not submitted, tell user to upload waivers
      if (data.waiverStatus.toUpperCase() == "NOT SUBMITTED") {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          "! If you're seeing this page, you've successfully submitted your " +
          "application for Girl's Day Out 2020! " +
          "Please upload signed waivers before the due date so your child will be able to participate!";
      }
      //if pending or submitted, tell user waivers are submitted and pending approval
      else if (
        data.waiverStatus.toUpperCase() == "PENDING" ||
        data.waiverStatus.toUpperCase() == "SUBMITTED"
      ) {
        document.getElementById("feedback").innerHTML =
          "Your waivers have been submitted, and are pending approval. Please check back at a " +
          "later date to see the updated status of your submitted waivers.";
        document.getElementById("download").style.display = "none";
        document.getElementById("upload").style.display = "none";
      }
      //if approved, tell user waivers are approved
      else if (data.waiverStatus.toUpperCase() == "APPROVED") {
        document.getElementById("feedback").innerHTML =
          "Good news " +
          data.fName +
          "! Your waivers have been approved for Girl's Day Out 2020!" +
          " Please continue to check your e-mail for any information regarding the upcoming camp!";
        document.getElementById("download").style.display = "none";
        document.getElementById("upload").style.display = "none";
      }
      //else (denied), tell user waivers need to be re-submitted
      else {
        document.getElementById("feedback").innerHTML =
          "Hello, " +
          data.fName +
          ". Unfortunately the waivers you have submitted could not be approved. Please check your e-mail to " +
          "see why this was the case. Once you have done so, please upload corrected signed waivers for Girl's Day Out 2020.";
      }
    }
  }
});

//function that verifies waiver file is an image file or pdf file
function verifyFile(obj) {
  var ext = obj.value.match(/\.([^\.]+)$/)[1];
  switch (ext) {
    case "jpg":
    case "pdf":
    case "png":
    case "jpeg":
    case "svg":
      break;
    default:
      alert(
        "This file type is not allowed. Please choose a PDF or image file."
      );
      obj.value = "";
  }
}
