$(document).ready(function () {
  // Moves drawer when hamburger/backdrop is clicked
  document.getElementById("hamburger").onclick = function () {
    moveDrawer();
  };
  document.getElementById("backdrop").onclick = function () {
    moveDrawer();
  };

  //coll = all FAQ elements (questions that expand to show answer)
  var coll = document.getElementsByClassName("collapsible");
  var i;

  //loops through each FAQ element, adding a click event listener, with a function that expands/collapses
  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var answer = this.nextElementSibling;
      if (answer.style.maxHeight) {
        answer.style.maxHeight = null;
        answer.style.border = null;
      } else {
        answer.style.maxHeight = answer.scrollHeight + "px";
        answer.style.border = "2px solid black";
        answer.style.borderTop = null;
      }
    });
  }

  //function/eventlistener for expand all button. Expands all FAQ elements
  document.getElementById("expandall").onclick = function () {
    for (i = 0; i < coll.length; i++) {
      coll[i].classList.add("active");
      var answer = coll[i].nextElementSibling;
      answer.style.maxHeight = answer.scrollHeight + "px";
      answer.style.border = "2px solid black";
      answer.style.borderTop = null;
    }
  };

  //function/eventlistener for collapseall button. Collapses all FAQ elements
  document.getElementById("collapseall").onclick = function () {
    for (i = 0; i < coll.length; i++) {
      coll[i].classList.remove("active");
      coll[i].nextElementSibling.style.maxHeight = null;
      coll[i].nextElementSibling.style.border = null;
    }
  };

  //function that hides toolbar on scroll down
  var prevScrollPos = window.pageYOffset;
  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollPos > currentScrollPos) {
      document.getElementById("toolbar").style.top = "0";
    } else {
      document.getElementById("toolbar").style.top = "-60px";
    }
    prevScrollPos = currentScrollPos;
  };
});

//function that closes or opens the side drawer based on if drawer is open already
function moveDrawer() {
  document.getElementById("sidedrawer").classList.toggle("open");
  document.getElementById("backdrop").classList.toggle("backdrop");
}

//function that searches all FAQ questions and answers
function searchFaq() {
  var input, filter, q, i, qTxt, aTxt;
  input = document.getElementById("searchFaq");
  filter = input.value.toUpperCase();
  q = document.getElementsByClassName("collapsible");
  a = document.getElementsByClassName("answer");
  for (i = 0; i < q.length; i++) {
    qTxt = q[i].textContent;
    aTxt = a[i].textContent;
    if (
      qTxt.toUpperCase().indexOf(filter) > -1 ||
      aTxt.toUpperCase().indexOf(filter) > -1
    ) {
      q[i].style.display = "";
      a[i].style.display = "";
    } else {
      q[i].style.display = "none";
      a[i].style.display = "none";
    }
  }
}
