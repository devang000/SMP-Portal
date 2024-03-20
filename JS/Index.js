// Typewriter Effect JavaScript
var TxtType = function (el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = "";
  this.tick();
  this.isDeleting = false;
};

TxtType.prototype.tick = function () {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">' + this.txt + "</span>";

  var that = this;
  var delta = 200 - Math.random() * 100;

  if (this.isDeleting) {
    delta /= 2;
  }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === "") {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function () {
    that.tick();
  }, delta);
};

window.onload = function () {
  var elements = document.getElementsByClassName("typewrite");
  for (var i = 0; i < elements.length; i++) {
    var toRotate = elements[i].getAttribute("data-type");
    var period = elements[i].getAttribute("data-period");
    if (toRotate) {
      new TxtType(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML =
    ".typewrite > .wrap { border-right: 0.08em solid rgb(211, 77, 0); animation: caret infinite 1s; } @keyframes caret { 0%, 100% { border-right-color: transparent; } 50% { border-right-color: rgb(211, 77, 0); } }";
  document.body.appendChild(css);
};

//autoplay

$(document).ready(function () {
  $(".owl-carousel1").owlCarousel({
    loop: true,
    center: true,
    margin: 0,
    responsiveClass: true,
    nav: false,
    autoplay: true, // Enable autoplay
    autoplayTimeout: 5000, // Set autoplay timeout to 5 seconds
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      680: {
        items: 2,
        nav: false,
        loop: false,
      },
      1000: {
        items: 3,
        nav: true,
      },
    },
  });
});

//Scroll to handle

$(document).ready(function () {
  var servicesContainer = $("#services-container");

  // Function to handle the scroll event
  function handleScroll() {
    if (
      $(window).scrollTop() > ($("#carouselExampleSlidesOnly").height() || 0)
    ) {
      // Add animation class and set opacity to 1
      servicesContainer.addClass("animated fadeInUp").css("opacity", 1);
      // Remove the scroll event listener to avoid unnecessary animations
      $(window).off("scroll", handleScroll);
    }
  }

  // Attach the scroll event listener
  $(window).on("scroll", handleScroll);

  // Trigger the scroll event handler on page load
  handleScroll();
});

//Modal
