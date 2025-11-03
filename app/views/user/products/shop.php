<main class="shop-page">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Bộ lọc sản phẩm</h2>

        <label for="search">Tìm kiếm:</label>
        <input type="text" id="search" placeholder="Tìm kiếm sản phẩm...">

        <label for="category">Danh mục:</label>
        <select id="category">
            <option value="">Tất cả</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['categoryId'] ?>"><?php echo $category['categoryName'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="price">Lọc theo giá:</label>
        <input type="range" id="price" min="200000" max="3000000" value="900000" step="200000">
        <span id="price-range"></span>
    </aside>

    <!-- Product List -->
    <section id="product1" class="section-p1 shop-product">
        <h2> Cửa hàng</h2>
        <div class="pro-container" id="product-list">
        </div>

    </section>
</main>


<script>
    $(document).ready(function () {
        let enablePriceRange = false;

        // Function to load products
        function loadProducts() {
            const price = parseInt($('#price').val(), 10);
            const filters = {
                search: $('#search').val(),
                categoryId: $('#category').val(),
            };

            if (enablePriceRange) {
                filters.price_start = price - 200000;
                filters.price_end = price + 200000;
            }

            // Build query parameters
            const queryParams = $.param({
                ...filters
            });

            // Make AJAX request
            $.ajax({
                url: `api/shop?${queryParams}`,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        // Clear existing products
                        $('#product-list').empty();
                        // Render products
                        response.data.forEach(product => {
                            $('#product-list').append(`
                                <div class="pro">
                                    <a href="detail?productId=${product.productId}">
                                        <img src="${product.images[0].link}"
                                            alt="${product.productName}">
                                    </a>
                                    <div class="des">
                                        <a href="detail?productId=${product.productId}">
                                            <h4>${product.productName}</h4>
                                            <h5>${formatCurrency(product.price)}</h5>
                                        </a>
                                        <div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <button class="cart add-to-cart" data-product-id="${product.productId}">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        alert('Error loading products: ' + response.message);
                    }
                },
                error: function () {
                    alert('An error occurred while loading products.');
                }
            });
        }

        //get params in url
        const params = new URLSearchParams(window.location.search);
        const categoryId = params.get('categoryId');
        if (categoryId) {
            $('#category').val(categoryId);
            const url = new URL(window.location.href);
            url.searchParams.delete('categoryId');
            window.history.replaceState(null, '', url);
        }

        loadProducts();

        const $priceInput = $('#price');
        const $priceRange = $('#price-range');
        function formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
        }

        //update price range
        function updatePriceRange(value) {
            value = parseInt(value, 10);
            const startPrice = value - 200000;
            const endPrice = value + 200000;

            $priceRange.text(`${formatCurrency(startPrice)} - ${formatCurrency(endPrice)}`);
            enablePriceRange = true;
            loadProducts();
        }
        $priceInput.on('input', function () {
            updatePriceRange(parseInt($(this).val(), 10));
        });

        //handle change category
        $('#category').on('change', function () {
            loadProducts();
        })

        //handle change search text
        let searchTimeout;
        $('#search').on('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                loadProducts();
            }, 300);

        })
    });
</script>