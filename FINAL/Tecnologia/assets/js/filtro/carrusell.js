document.addEventListener('DOMContentLoaded', function() {
    
    

    const navItems = document.querySelectorAll('.nav-item');
    const indicator = document.querySelector('.nav-indicator');
    
    if (!indicator || navItems.length === 0) {
        console.error('Nav-indicator o elementos de navegación no encontrados.');
        return;
    }

    function updateIndicator(el) {
        const button = el.querySelector("a");
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
        document.querySelector('.nav-item.active')?.classList.remove('active');
        item.classList.add('active');
        updateIndicator(item);
    }

    navItems.forEach(item => {
        item.addEventListener('click', () => setActiveItem(item));
    });

    window.addEventListener("resize", () => {
        const activeItem = document.querySelector(".nav-item.active");
        updateIndicator(activeItem);
    });
    
    const activeItem = document.querySelector(".nav-item.active") || navItems[0];
    setActiveItem(activeItem);
});
