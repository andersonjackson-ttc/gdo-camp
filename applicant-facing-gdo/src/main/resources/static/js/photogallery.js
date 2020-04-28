$(document).ready(function () {
  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  addPics(2019, 29);
  addPics(2018, 31);
});

//function that closes or opens the side drawer based on if drawer is open already
function moveDrawer() {
  if (!document.getElementById("sidedrawer").classList.contains("open")) {
    document.getElementById("sidedrawer").classList.add("open");
    document.getElementById("backdrop").classList.add("backdrop");
  } else {
    document.getElementById("sidedrawer").classList.remove("open");
    document.getElementById("backdrop").classList.remove("backdrop");
  }
}

function addPics(year, numPics) {
  let modalContainer = document.getElementById("modal-content-" + year);

  let slide;
  let number;
  let image;

  for (let i = 1; i < numPics; i++) {
    slide = document.createElement("div");
    slide.className = "mySlides " + year + "Slides";
    slide.id = "image-" + i;
    number = document.createElement("div");
    number.className = "numbertext";
    number.innerHTML = i + " / " + numPics;
    image = document.createElement("img");
    image.src = "images/" + year + "/" + year + "-" + i + ".jpg";
    image.alt = "Image " + i + " in " + year + " Photo gallery";

    slide.appendChild(number);
    slide.appendChild(image);
    modalContainer.appendChild(slide);
  }
}

function openPics(year) {
  document.getElementById("modal" + year).style.display = "block";
}

function closePics(year) {
  document.getElementById("modal" + year).style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n, year) {
  showSlides((slideIndex += n), year);
}

function currentSlide(n, year) {
  showSlides((slideIndex = n), year);
}

function showSlides(n, year) {
  var i;
  var slides = document.getElementsByClassName(year + "Slides");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex - 1].style.display = "block";
}
