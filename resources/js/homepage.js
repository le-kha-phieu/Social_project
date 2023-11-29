window.addEventListener("scroll", function () {
  let lastScrollTop = 0
  const headerNavbar = document.querySelector(".header-navbar")
  const currentScrollTop = window.scrollY

  if (currentScrollTop === 0) {
    headerNavbar.classList.remove("header-scrolled")
  } else {
    headerNavbar.classList.add("header-scrolled")
  }

  lastScrollTop = currentScrollTop
})

document.addEventListener("DOMContentLoaded", function () {
  const closeButton = document.getElementById("closeButton")
  const notification = document.getElementById("notifyBlog")


  if (closeButton && notification) {
    closeButton.addEventListener("click", function () {
      notification.style.display = 'none'
    })
  }
})

const categorySelect = document.getElementById('categorySelect');

if (categorySelect) {
  categorySelect.addEventListener('change', function () {
    const selectedValue = categorySelect.value;
    window.location.href = selectedValue;
  });
}




