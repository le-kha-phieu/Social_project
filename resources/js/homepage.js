window.addEventListener("scroll", function () {
  let lastScrollTop = 0;
  const headerNavbar = document.querySelector(".header-navbar");
  const currentScrollTop = window.scrollY;

  if (currentScrollTop === 0) {
    headerNavbar.classList.remove("header-scrolled");
  } else {
    headerNavbar.classList.add("header-scrolled");
  }

  lastScrollTop = currentScrollTop;
});




