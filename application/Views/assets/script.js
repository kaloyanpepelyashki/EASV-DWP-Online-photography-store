// LOADER ANIMATION START
(function introLoader() {
  window.addEventListener("load", () => {
    // When the window is fully loaded, hide the loader
    const loader = document.querySelector(".loader-container");
    loader.style.display = "none";
  });
})();

// LOADER ANIMATION END
(function header() {
  let lastScrollTop = 0;

  // TOGGLE HAMBURGER & COLLAPSE NAV START
  const hamburger = document.querySelector(".hamburger"),
    menuLeft = document.querySelector(".menu-left");
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("open");
    menuLeft.classList.toggle("collapse");
  });

  // REMOVE X & COLLAPSE NAV ON CLICK
  const menuLeftLinks = document.querySelectorAll(".menu-left a");
  menuLeftLinks.forEach((link) => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("open");
      menuLeft.classList.remove("collapse");
    });
  });

  // REMOVE X & COLLAPSE SHOPPING CART ON HOVER
  const cartNavigation = document.querySelector(".cart-navigation"),
    shoppingCart = document.querySelector(".shopping-cart");

  shoppingCart.addEventListener("click", () => {
    cartNavigation.classList.toggle("open");
  });

  // END
  let ticking = false;
  window.addEventListener("scroll", () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        hasScrolled();
        ticking = false;
      });
      ticking = true;
    }
  });

  function hasScrolled() {
    const st = window.pageYOffset || document.documentElement.scrollTop;
    const header = document.querySelector("header"),
      cartNavigation = document.querySelector(".cart-navigation");
    const navbarHeight = header.offsetHeight;
    const windowHeight = window.innerHeight;
    const delta = 5;

    if (Math.abs(lastScrollTop - st) <= delta) return;

    if (st > lastScrollTop && st > navbarHeight) {
      header.classList.remove("show-nav");
      header.classList.add("hide-nav");
      hamburger.classList.remove("open");
      cartNavigation.classList.remove("open");
      menuLeft.classList.remove("collapse");
    } else if (st + windowHeight < document.documentElement.scrollHeight) {
      header.classList.remove("hide-nav");
      header.classList.add("show-nav");
    }
    lastScrollTop = st;
  }
})();

/// LOADER AT SUBMITING A FORM START

(function contactForm() {
  const contactForm = document.querySelector("form");

  function onFormSubmission(event) {
    const isValid = Array.from(event.target.elements).every((element) =>
        element.reportValidity()
      ),
      submitButton = document.querySelector(".submit-btn");

    if (isValid) {
      submitButton.innerHTML = "<div class='loader'></div>";
    } else {
      event.preventDefault();
    }
  }
  contactForm.addEventListener("submit", onFormSubmission);
  // LOADER AT SUBMITING A FORM END

  // SUBMIT AT ENTER START
  document.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
      onFormSubmission(event);
    }
  });
  // SUBMIT AT ENTER END
})();

// CONTENT REVEAL START
function reveal() {
  const reveals = document.querySelectorAll(".reveal"),
    windowHeight = window.innerHeight;

  reveals.forEach((reveal) => {
    const revealtop = reveal.getBoundingClientRect().top;
    const revealpoint = 0;
    if (revealtop < windowHeight - revealpoint) {
      reveal.classList.add("active");
    }
  });
}
window.addEventListener("scroll", reveal);
reveal();
// CONTENT REVEAL END
// SWIPER START
const swiper = new Swiper(".product-swiper", {
  // Optional parameters
  direction: "horizontal",
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  }, // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },
});
const reviewsSwiper = new Swiper(".recommendation-swiper", {
  // Optional parameters
  direction: "horizontal",
  loop: true,
  speed: 600,
  spaceBetween: 10,
  autoplay: {
    delay: 3000,
  },
  breakpoints: {
    375: {
      slidesPerView: 2,
    },
    620: {
      slidesPerView: 3,
    },
  },
});
// SWIPER END
if (document.body.id === "store-checkout") {
  const showCheckbox = document.getElementById("adresstype");
  const hiddenElement = document.getElementById("hiddenElement");

  showCheckbox.addEventListener("change", function () {
    if (showCheckbox.checked) {
      hiddenElement.style.display = "grid";
    } else {
      hiddenElement.style.display = "none";
    }
  });
}
