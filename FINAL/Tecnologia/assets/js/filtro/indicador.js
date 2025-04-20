const navItems = document.querySelectorAll(".nav-item");
const indicator = document.querySelector(".indicator");

function updateIndicator(el) {
    const indicator = document.querySelector(".nav-indicator");
    if (!indicator || !el) return;
  
    const button = el.querySelector("a");
    if (!button) return;
  
    const offsetLeft = button.offsetLeft + button.offsetParent.offsetLeft;
    const width = button.offsetWidth;
  
    gsap.to(indicator, {
      x: offsetLeft,
      width: width,
      duration: 0.3,
      ease: "power2.out"
    });
  }
  

function setActiveItem(item) {
  document.querySelector(".nav-item.active")?.classList.remove("active");
  item.classList.add("active");
  updateIndicator(item);
}

window.addEventListener("DOMContentLoaded", () => {
  const currentPage = window.location.pathname.split("/").pop();

  let matchedItem = null;
  navItems.forEach(item => {
    const link = item.querySelector("a");
    const href = link.getAttribute("href").split("/").pop();

    if (href === currentPage) {
      matchedItem = item;
    }

    item.addEventListener("click", () => setActiveItem(item));
  });

  setActiveItem(matchedItem || navItems[0]);
});

window.addEventListener("resize", () => {
  const activeItem = document.querySelector(".nav-item.active");
  if (activeItem) updateIndicator(activeItem);
});


var swiper = new Swiper(".vertical-slide-carousel", {
    loop: true,
    direction: 'vertical',
    mousewheelControl: true,
    mousewheel: {
        releaseOnEdges: true,
    },
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
        el: ".vertical-slide-carousel .swiper-pagination",
        clickable: true,
    },
});
