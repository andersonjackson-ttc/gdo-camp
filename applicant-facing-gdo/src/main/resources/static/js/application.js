$(document).ready(function () {
  //Fetches state JSON data
  const stateRequest = async () => {
    var stateJsonUrl = "/states/all";
    const response = await fetch(stateJsonUrl);
    const data = await response.json();
    insertStates(data);
  };

  //Fetches school JSON data
  const schoolRequest = async () => {
    var schoolJsonUrl = "/schools/all";
    const response = await fetch(schoolJsonUrl);
    const data = await response.json();
    insertSchools(data);
  };

  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  //calls methods that fetches JSON
  stateRequest();
  schoolRequest();

  //function that closes or opens the side drawer based on if drawer is open already
  function moveDrawer() {
    document.getElementById("sidedrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("backdrop");
  }

  //function that takes states data and inserts it to dropdown
  function insertStates(data) {
    var stateIds = ["state-dropdown", "pState1", "pState2", "emState"];

    for (let i = 0; i < stateIds.length; i++) {
      let dropdown = document.getElementById(stateIds[i]);
      let defaultOption = document.createElement("option");
      defaultOption.text = "--Choose State--";
      defaultOption.value = "";

      dropdown.add(defaultOption);

      let option;
      for (let i = 0; i < data.length; i++) {
        option = document.createElement("option");
        option.text = data[i].stateName;
        option.value = data[i].stateAbbr;
        dropdown.add(option);
      }
    }
  }

  //function that takes school data and inserts it to school dropdown
  function insertSchools(data) {
    let dropdown = document.getElementById("school-dropdown");
    let defaultOption = document.createElement("option");
    defaultOption.text = "--Choose School--";
    defaultOption.value = "";

    dropdown.add(defaultOption);

    let option;
    for (let i = 0; i < data.length; i++) {
      option = document.createElement("option");
      option.text = data[i].schoolName;
      option.value = data[i].schoolName;
      dropdown.add(option);
    }

    //initializes select2 jquery method. select2 allows dropdown to be searchable
    $("#school-dropdown").select2();
  }

  //three dropdowns/textboxes are initially not shown
  document.getElementById("eduLevel").style.display = "none";
  document.getElementById("milBranch").style.display = "none";
  document.getElementById("otherTextbox").style.display = "none";
});

//function that shows school text box and makes it required if "Other" was selected in dropdown
function showOtherTextBox() {
  var schoolDropdown = document.getElementById("school-dropdown").value;
  if (schoolDropdown == "Other (list in details column)") {
    document.getElementById("otherTextbox").style.display = "block";
    document.getElementById("otherSchool").required = true;
  } else {
    document.getElementById("otherTextbox").style.display = "none";
    document.getElementById("otherSchool").required = false;
  }
}

//function that makes dropdowns appear when "yes" radio button is selected
function showDropdown(dropdown, radioBtnId, dropdownInput) {
  if (
    document.querySelector("input[name=" + radioBtnId + "]:checked").value ==
    "Yes"
  ) {
    document.getElementById(dropdown).style.display = "block";
    document.getElementById(dropdownInput).required = true;
  } else {
    document.getElementById(dropdown).style.display = "none";
    document.getElementById(dropdownInput).required = false;
  }
}

//function that counts characters in Allergies textbox and adds chars remaining underneath
function countAllerChars(obj) {
  var maxLength = 500;
  var strLength = obj.value.length;

  if (strLength >= maxLength) {
    document.getElementById("aller-chars").innerHTML =
      '<span style="color: red;"> Zero characters remaining</span>';
  } else {
    document.getElementById("aller-chars").innerHTML =
      maxLength - strLength + " characters remaining";
  }
}

//function that counts characters in Medications textbox and adds chars remaining underneath
function countMedChars(obj) {
  var maxLength = 500;
  var strLength = obj.value.length;

  if (strLength >= maxLength) {
    document.getElementById("med-chars").innerHTML =
      '<span style="color: red;"> Zero characters remaining</span>';
  } else {
    document.getElementById("med-chars").innerHTML =
      maxLength - strLength + " characters remaining";
  }
}
