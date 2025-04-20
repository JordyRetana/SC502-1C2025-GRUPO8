
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    }
    
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    document.querySelectorAll('.sidebar-menu li').forEach(item => {
        item.classList.remove('active');
        
        const link = item.querySelector('a');
        if (link) {
            const linkPage = link.getAttribute('href');
            if (currentPage === linkPage) {
                item.classList.add('active');
            }
        }
    });
    
    window.addEventListener('error', function(e) {
        console.error('Error loading resource:', e);
    }, true);
});