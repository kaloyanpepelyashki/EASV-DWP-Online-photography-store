(function introLoader() {
  window.addEventListener("load", () => {
    // When the window is fully loaded, hide the loader
    const loader = document.querySelector(".loader-container");
    loader.style.display = "none";
  });
})();
