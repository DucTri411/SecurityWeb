<!-- <h2>cart page</h2>
<?php if (count($carts) === 0): ?>
    <p>Cart is empty</p>
<?php else: ?>
    <table>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>TotalPrice</th>
            <th>Update</th>
            <th>Action</th>
        </tr>
        <?php foreach ($carts as $cart): ?>
            <tr>
                <td><img src="<?php echo $cart['images'][0]['link']; ?>" alt="" style="width: 150px; height: 150px;"> </td>
                <td><?php echo $cart['productName']; ?></td>
                <td><?php echo $cart['price']; ?></td>
                <td><?php echo $cart['quantity']; ?></td>
                <td><?php echo $cart['totalPrice']; ?></td>
                <td>
                    <a style="margin-right: 20px;"
                        href="increase-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>">+</a>
                    <a
                        href="decrease-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>">-</a>
                </td>
                <td><a
                        href="delete-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>">delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="checkout">Thanh toán</a>
<?php endif; ?> -->

<div class="cart-container">
    <div class="cart-header">GIỎ HÀNG</div>
    <?php if (count($carts) === 0): ?>
        <div class="cart-body">
            <p>Giỏ hàng trống? <a href="shop">Mua ngay</a></p>
        </div>
    <?php else: ?>
        <?php foreach ($carts as $cart): ?>
            <div class="cart-item">
                <img src="<?php echo $cart['images'][0]['link']; ?>" alt="Lind Dress">
                <div class="cart-details">
                    <p><?php echo $cart['productName']; ?></p>
                    <p>Giá: <?php echo formatCurrencyVND($cart['price']); ?></p>
                    <p>Số lượng: x<?php echo $cart['quantity']; ?></p>
                    <p class="price"><?php echo formatCurrencyVND($cart['totalPrice']); ?></p>
                </div>
                <div class="cart-actions">
                    <a
                        href="increase-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>"><button>&#43;</button></a>
                    <a
                        href="decrease-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>"><button>&#8722;</button></a>
                    <a
                        href="delete-cart?cartId=<?php echo $cart['cartId']; ?>&productId=<?php echo $cart['productId']; ?>"><button>&#128465;</button></a>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="promo-code">
            <input type="text" placeholder="Nhập mã giảm giá ">
            <button>Áp dụng</button>
        </div>

        <div class="cart-summary">
            <p><span>Giá tạm tính</span><span><?php echo formatCurrencyVND($totalCart); ?></span></p>
            <p class="total"><span>Tổng tiền</span><span><?php echo formatCurrencyVND($totalCart); ?></span></p>
            <p style="font-size: 12px;">(Đã bao gồm thuế)</p>
        </div>
        <a href="checkout"> <button class="checkout-btn">Đặt Hàng</button></a>
    <?php endif; ?>
</div>