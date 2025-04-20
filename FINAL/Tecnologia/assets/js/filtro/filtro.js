document.addEventListener('DOMContentLoaded', function () {
    let products = [];
    let filteredProducts = [];
    const apiUrl = '../api/products/get_products.php'; 

    const productGrid = document.getElementById('productGrid');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const sortLowHigh = document.getElementById('sortLowHigh');
    const sortHighLow = document.getElementById('sortHighLow');
    const advancedFilterBtn = document.getElementById('advancedFilterBtn');
    const advancedFilters = document.getElementById('advancedFilters');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    const categoryFilter = document.getElementById('categoryFilter');
    const applyFilters = document.getElementById('applyFilters');
    const resetFilters = document.getElementById('resetFilters');

    function toggleAdvancedFilters() {
        if (advancedFilters.style.display === 'none') {
            advancedFilters.style.display = 'block';
        } else {
            advancedFilters.style.display = 'none';
        }
    }

    function showLoading() {
        const loader = document.getElementById('loader');
        if (loader) loader.style.display = 'block';
    }

    function hideLoading() {
        const loader = document.getElementById('loader');
        if (loader) loader.style.display = 'none';
    }

    function performSearch() {
        const keyword = searchInput.value.trim().toLowerCase();
        const results = products.filter(product =>
            product.nombre.toLowerCase().includes(keyword) ||
            product.descripcion.toLowerCase().includes(keyword)
        );
        renderProducts(results);
    }

    function sortProducts(order) {
        const sorted = [...filteredProducts];
        if (order === 'lowToHigh') {
            sorted.sort((a, b) => parseFloat(a.precio) - parseFloat(b.precio));
        } else if (order === 'highToLow') {
            sorted.sort((a, b) => parseFloat(b.precio) - parseFloat(a.precio));
        }
        renderProducts(sorted);
    }

    function applyAdvancedFilters() {
        const min = parseFloat(minPrice.value) || 0;
        const max = parseFloat(maxPrice.value) || Infinity;
        const category = categoryFilter.value;

        filteredProducts = products.filter(product => {
            const price = parseFloat(product.precio);
            const matchesPrice = price >= min && price <= max;
            const matchesCategory = category ? product.categoria === category : true;
            return matchesPrice && matchesCategory;
        });

        renderProducts(filteredProducts);
    }

    function resetAdvancedFilters() {
        minPrice.value = '';
        maxPrice.value = '';
        categoryFilter.value = '';
        filteredProducts = [...products];
        renderProducts(filteredProducts);
    }

    function renderProducts(productsToRender) {
        productGrid.innerHTML = '';
        if (productsToRender.length === 0) {
            productGrid.innerHTML = '<div class="col-12 text-center">No se encontraron productos.</div>';
            return;
        }

        productsToRender.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'col-md-4 mb-4';

            productCard.innerHTML = `
                <div class="card product-card h-100">
                    ${product.imagen_url
                        ? `<img src="${product.imagen_url}" class="card-img-top" alt="${product.nombre}">`
                        : `<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#dee2e6" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z"/>
                        </svg>`}
                    <div class="card-body">
                        <h5 class="card-title">${product.nombre}</h5>
                        <p class="card-text">${product.descripcion || ''}</p>
                        <p class="card-text"><strong>Precio: $${parseFloat(product.precio).toFixed(2)}</strong></p>
                        <button class="buy-button">
                            <span class="label">+ Add to cart</span>
                            <span class="gradient-container">
                                <span class="gradient"></span>
                            </span>
                        </button>
                    </div>
                </div>
            `;
            productGrid.appendChild(productCard);
        });
    }
    function toggleAdvancedFilters() {
        if (advancedFilters.style.display === 'none' || advancedFilters.style.display === '') {
            advancedFilters.style.display = 'block';
        } else {
            advancedFilters.style.display = 'none';
        }
    }
    

    function loadProducts() {
        showLoading();
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar los productos');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    products = data.data;
                    filteredProducts = [...products];
                    renderProducts(filteredProducts);
                } else {
                    throw new Error(data.error || 'Error desconocido');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                productGrid.innerHTML = `<div class="col-12 text-center text-danger">${error.message}</div>`;
            })
            .finally(() => {
                hideLoading();
            });
    }

    if (searchButton && searchInput) {
        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') performSearch();
        });
    }

    if (sortLowHigh && sortHighLow) {
        sortLowHigh.addEventListener('click', () => sortProducts('lowToHigh'));
        sortHighLow.addEventListener('click', () => sortProducts('highToLow'));
    }

    if (advancedFilterBtn && advancedFilters) {
        advancedFilterBtn.addEventListener('click', toggleAdvancedFilters);
    }

    if (applyFilters && resetFilters) {
        applyFilters.addEventListener('click', applyAdvancedFilters);
        resetFilters.addEventListener('click', resetAdvancedFilters);
    }

    loadProducts();
});
