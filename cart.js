$(document).ready(function() {
    // List of products with unique images and details
    const products = [
        { 
            image: 'shop1.png',
            title: 'Nike Green Pullover',
            price: 39.99
        },
        { 
            image: 'shop2.png',
            title: 'Nike Kids T-shirt',
            price: 29.99
        },
        { 
            image: 'shop3.jpeg',
            title: 'Rolex Oyster Perpetual',
            price: 319.99
        },
        { 
            image: 'shop4.png',
            title: 'Nike Air Max',
            price: 109.99
        },
        { 
            image: 'shop5.png',
            title: 'Nike White Bag',
            price: 59.99
        },
        { 
            image: 'shop6.png',
            title: 'Nike Bottle',
            price: 19.99
        },
        { 
            image: 'shop7.jpg',
            title: 'Armani Watch',
            price: 339.99
        },
        { 
            image: 'shop8.jpg',
            title: 'Gucci Pullover',
            price: 343.99
        },
        { 
            image: 'shop9.jpeg',
            title: 'Nike Blue Bag',
            price: 49.99
        },
        { 
            image: 'shop10.png',
            title: 'Nike Waistpack',
            price: 89.99
        },
        { 
            image: 'shop11.webp',
            title: 'Iphone 15 Green',
            price: 799.99
        },
        { 
            image: 'shop12.webp',
            title: 'Prada Sunglasses',
            price: 639.99
        },
        { 
            image: 'shop13.webp',
            title: 'Nike Orange Bottle',
            price: 69.99
        },
        { 
            image: 'shop14.webp',
            title: 'Gucci Shoes',
            price: 789.99
        },
        { 
            image: 'shop15.webp',
            title: 'Nike Black T-Shirt',
            price: 59.99
        },
        { 
            image: 'shop16.webp',
            title: 'Armani Analog Watch',
            price: 539.99
        },
        // Add more products as needed
    ];

    // Function to load products
    function loadProducts() {
        $('#loader-icon').show(); // Show loader
        setTimeout(function() { // Simulate an AJAX request
            // Loop through each product in the list
            products.forEach(function(product) {
                $('#product-grid').append(`
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card">
                            <img src="${product.image}" class="card-img-top" alt="${product.title}">
                            <div class="card-body text-center">
                                <h5 class="card-title">${product.title}</h5>
                                <p class="card-text">$${product.price.toFixed(2)}</p>
                                <button class="btn btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                `);
            });
            $('#loader-icon').hide(); // Hide loader
        }, 1000); // Simulated delay
    }

    // Load products only once
    loadProducts();

    // Disable infinite scroll since we only want to display specific products
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
    //         loadProducts();
    //     }
    // });
});




