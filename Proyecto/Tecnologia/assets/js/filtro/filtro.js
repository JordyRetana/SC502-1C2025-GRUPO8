document.getElementById('toggleKeywords').addEventListener('click', function() {
    var keywordSection = document.getElementById('keywordSection');
    if (keywordSection.classList.contains('hidden')) {
        keywordSection.classList.remove('hidden');
        this.textContent = 'Hide Keywords';
    } else {
        keywordSection.classList.add('hidden');
        this.textContent = 'Show Keywords';
    }
});

document.getElementById('newBtn').addEventListener('click', function() {
    sortProducts('new');
});

document.getElementById('priceAscBtn').addEventListener('click', function() {
    sortProducts('priceAsc');
});

document.getElementById('priceDescBtn').addEventListener('click', function() {
    sortProducts('priceDesc');
});

document.getElementById('ratingBtn').addEventListener('click', function() {
    sortProducts('rating');
});

document.getElementById('search').addEventListener('input', function() {
    filterProducts(this.value);
});

function sortProducts(criteria) {
    var productGrid = document.getElementById('productGrid');
    var products = Array.from(productGrid.children);

    products.sort(function(a, b) {
        var priceA = parseFloat(a.querySelector('p').textContent.split('$')[1]);
        var priceB = parseFloat(b.querySelector('p').textContent.split('$')[1]);

        if (criteria === 'priceAsc') {
            return priceA - priceB;
        } else if (criteria === 'priceDesc') {
            return priceB - priceA;
        } else if (criteria === 'new') {
            return 0;
        } else if (criteria === 'rating') {
            return 0;
        }
    });

    products.forEach(function(product) {
        productGrid.appendChild(product);
    });
}

function filterProducts(query) {
    var productGrid = document.getElementById('productGrid');
    var products = Array.from(productGrid.children);

    products.forEach(function(product) {
        var productName = product.querySelector('p').textContent.toLowerCase();
        if (productName.includes(query.toLowerCase())) {
            product.style.display = '';
        } else {
            product.style.display = 'none';
        }
    });
}