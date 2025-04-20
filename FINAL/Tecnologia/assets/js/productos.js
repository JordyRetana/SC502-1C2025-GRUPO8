document.addEventListener('DOMContentLoaded', function() {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    
    const productGrid = document.getElementById('productGrid');
    const modal = document.getElementById('modal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModal');
    
    fetch('/FINAL/Tecnologia/api/products/productos_api.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar productos');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                renderProducts(data.data);
            } else {
                showError(data.error || 'Error al cargar productos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Error al conectar con el servidor');
        });
    
    function renderProducts(products) {
        productGrid.innerHTML = '';
    
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'col-md-4 mb-4';
    
            productCard.innerHTML = `
            <div class="card product-card h-100">
                ${product.imagen_url 
                    ? `<img src="${product.imagen_url}" class="card-img-top" alt="${product.nombre}">`
                    : `<svg>...</svg>`
                }
                <div class="card-body">
                    <h5 class="card-title">${product.nombre}</h5>
                    <p class="card-text">${product.descripcion || ''}</p>
                    <p class="card-text"><strong>Precio: $${parseFloat(product.precio).toFixed(2)}</strong></p>
                    <button class="buy-button" data-id="${product.id}">
                        <span class="label">+ Add to cart</span>
                        <span class="gradient-container">
                            <span class="gradient"></span>
                        </span>
                    </button>
                </div>
            </div>
            `;
    
            productGrid.appendChild(productCard);
            
            productCard.querySelector('.buy-button').addEventListener('click', () => {
                addToCart(product);
            });
        });
    }
    
    function addToCart(product) {
        const existingItem = cart.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: product.id,
                nombre: product.nombre,
                precio: parseFloat(product.precio),
                imagen_url: product.imagen_url || '',
                quantity: 1
            });
        }
        
        sessionStorage.setItem('cart', JSON.stringify(cart));
        
        showNotification(`${product.nombre} añadido al carrito`);
    }
    
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 500);
        }, 2000);
    }
    
    function showError(message) {
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger col-12';
        errorAlert.textContent = message;
        productGrid.appendChild(errorAlert);
    }
    
function updateCartModal() {
    const productsContainer = document.querySelector('.products');
    const subtotalElement = document.querySelector('.details span:nth-child(2)');
    const shippingElement = document.querySelector('.details span:nth-child(4)');
    const totalElement = document.querySelector('.details span:nth-child(6)');
    const checkoutPrice = document.querySelector('.price');
    
    productsContainer.innerHTML = '';
    
    let subtotal = 0;
    const shippingCost = 2.00;
    
    if (cart.length === 0) {
        productsContainer.innerHTML = '<p class="empty-cart">Tu carrito está vacío</p>';
    } else {
        cart.forEach(item => {
            const productTotal = item.precio * item.quantity;
            subtotal += productTotal;
            
            const productElement = document.createElement('div');
            productElement.className = 'product';
            productElement.innerHTML = `
                <span>${item.nombre}</span>
                <p>${item.imagen_url ? `<img src="${item.imagen_url}" width="50">` : 'Producto'}</p>
                <div class="quantity">
                    <label>${item.quantity}</label>
                </div>
                <span>$${(productTotal).toFixed(2)}</span>
            `;
            
            productsContainer.appendChild(productElement);
        });
    }
    
    const total = subtotal + shippingCost;
    
    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    shippingElement.textContent = `$${shippingCost.toFixed(2)}`;
    totalElement.textContent = `$${total.toFixed(2)}`;
    checkoutPrice.innerHTML = `<sup>$</sup>${total.toFixed(2)}<sub>USD</sub>`;
    
}



function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);

    notification.style.position = 'fixed';
    notification.style.top = '50%';
    notification.style.left = '50%';
    notification.style.transform = 'translate(-50%, -50%)';
    notification.style.backgroundColor = '#4caf50';
    notification.style.color = 'white';
    notification.style.padding = '5px 15px';
    notification.style.borderRadius = '5px';
    notification.style.fontSize = '12px';
    notification.style.zIndex = '9999';
    notification.style.textAlign = 'center';
    notification.style.lineHeight = '1.2';
    notification.style.maxWidth = '200px';
    notification.style.minWidth = '180px';
    notification.style.height = '50px';
    notification.style.whiteSpace = 'nowrap';
    notification.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';

    setTimeout(() => {
        notification.classList.add('fade-out');
        setTimeout(() => notification.remove(), 500);
    }, 2000);
}


openModalBtn.addEventListener('click', function() {
    updateCartModal();
    modal.classList.add('active');
});

closeModalBtn.addEventListener('click', function() {
    modal.classList.remove('active');
});

modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.classList.remove('active');
    }
});

document.querySelector('.checkout-btn')?.addEventListener('click', function () {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    if (cart.length === 0) {
        showNotification('Tu carrito está vacío');
        return;
    }

    fetch('/FINAL/Tecnologia/api/products/comprar_api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cart })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Compra realizada con éxito!');

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            let y = 20;
            
            doc.setFontSize(18);
            doc.setTextColor(40, 40, 40);
            doc.setFont('helvetica', 'bold');
            doc.text(' Resumen de tu compra', 105, y, { align: 'center' });
            
            y += 8;
            doc.setDrawColor(200, 200, 200);
            doc.line(20, y, 190, y);
            y += 10;
            
            const fecha = new Date().toLocaleString();
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(100);
            doc.text(`Fecha: ${fecha}`, 20, y);
            y += 10;
            
            doc.setFontSize(12);
            doc.setTextColor(0);
            doc.setFont('helvetica', 'bold');
            doc.text('Producto', 20, y);
            doc.text('Cant.', 110, y);
            doc.text('Total', 160, y);
            y += 8;
            
            doc.setFont('helvetica', 'normal');
            
            let subtotal = 0;
            
            cart.forEach(item => {
                const totalItem = item.precio * item.quantity;
                subtotal += totalItem;
            
                doc.text(item.nombre, 20, y);
                doc.text(`${item.quantity}`, 112, y);
                doc.text(`$${totalItem.toFixed(2)}`, 190, y, { align: 'right' });
            
                y += 8;
            });
            
            y += 5;
            
            const shipping = 2.00;
            const total = subtotal + shipping;
            
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(60, 60, 60);
            doc.text(`Subtotal:`, 120, y);
            doc.text(`$${subtotal.toFixed(2)}`, 190, y, { align: 'right' });
            y += 7;
            
            doc.setTextColor(100);
            doc.text(`Envío:`, 120, y);
            doc.text(`$${shipping.toFixed(2)}`, 190, y, { align: 'right' });
            y += 7;
            
            doc.setTextColor(0, 128, 64);
            doc.setFontSize(14);
            doc.text(`Total:`, 120, y);
            doc.text(`$${total.toFixed(2)}`, 190, y, { align: 'right' });
            
            y += 20;
            doc.setFontSize(11);
            doc.setTextColor(80);
            doc.text('Gracias por confiar en nosotros', 105, y, { align: 'center' });
            
            doc.save(`pedido_${Date.now()}.pdf`);
            

            cart = [];
            sessionStorage.removeItem('cart');
            updateCartModal();
            modal.classList.remove('active');
        } else {
            showNotification('Error: ' + (data.error || 'No se pudo completar la compra'));
        }
    });
});

});