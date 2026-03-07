<?php include __DIR__ . '/shares/header.php'; ?>

<style>
    .cart-wrapper { min-height: 60vh; padding: 40px 0; background-color: #f8f9fa; }
    .cart-items-box { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); }
    .cart-item { border-bottom: 1px solid #f0f0f0; padding: 20px 0; display: flex; align-items: center; }
    .cart-item:last-child { border-bottom: none; padding-bottom: 0; }
    .item-img { width: 100px; height: 100px; object-fit: contain; border-radius: 8px; border: 1px solid #eee; padding: 5px; }
    .item-info { flex-grow: 1; padding: 0 20px; }
    .item-title { font-size: 1.1rem; font-weight: 600; color: #333; text-decoration: none; display: block; margin-bottom: 8px; }
    .item-title:hover { color: #d70018; }
    .item-price { font-size: 1.1rem; font-weight: 700; color: #d70018; }
    .qty-control { display: flex; align-items: center; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; width: fit-content; }
    .qty-btn { width: 35px; height: 35px; background: #f8f9fa; color: #555; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s; font-weight: bold; }
    .qty-btn:hover { background: #e9ecef; color: #000; }
    .qty-input { width: 45px; height: 35px; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; text-align: center; font-weight: 600; color: #333; outline: none; background: #fff; pointer-events: none;}
    .summary-box { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: sticky; top: 100px; }
    .summary-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 15px; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; color: #555; font-size: 0.95rem; }
    .summary-total { display: flex; justify-content: space-between; margin-top: 20px; padding-top: 15px; border-top: 1px dashed #ddd; font-weight: 700; font-size: 1.2rem; align-items: center; }
    .summary-total .total-price { color: #d70018; font-size: 1.5rem; }
    .btn-checkout { background: linear-gradient(90deg, #d70018, #ff3b30); color: #fff; border: none; padding: 14px; border-radius: 8px; font-weight: 700; font-size: 1.1rem; width: 100%; transition: all 0.3s; text-transform: uppercase; text-decoration: none; display: block; text-align: center; margin-top: 20px; }
    .btn-checkout:hover { transform: translateY(-2px); color: #fff; }
</style>

<div class="cart-wrapper">
    <div class="container">
        <h3 class="fw-bold mb-4"><i class="fas fa-shopping-cart text-danger me-2"></i>Giỏ hàng của bạn</h3>

        <?php
        $cart = $cart ?? ($_SESSION['cart'] ?? []);
        $totalAmount = 0;
        $totalItems = 0;
        ?>

        <?php if(!empty($cart)): ?>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="cart-items-box">
                        <?php foreach($cart as $item): ?>
                            <?php
                                $qty = isset($item['qty']) ? (int)$item['qty'] : 1;
                                $original_price = isset($item['price']) ? (float)$item['price'] : 0.0;
                                $discount = isset($item['discount']) ? (int)$item['discount'] : 0;
                                $sale_price = $original_price - ($original_price * ($discount / 100));
                                $sub = $sale_price * $qty;
                                $totalAmount += $sub;
                                $totalItems += $qty;
                                $img = isset($item['image']) && $item['image'] !== '' ? $item['image'] : 'https://placehold.co/100x100?text=No+Image';
                                $name = htmlspecialchars($item['name'] ?? 'Sản phẩm');
                                $id = isset($item['id']) ? urlencode($item['id']) : '';
                            ?>
                            
                            <div class="cart-item">
                                <a href="index.php?url=Product/detail/<?= $id ?>"><img src="<?= $img ?>" class="item-img"></a>
                                <div class="item-info">
                                    <a href="index.php?url=Product/detail/<?= $id ?>" class="item-title"><?= $name ?></a>
                                    <div class="item-price"><?= number_format($sale_price, 0, ',', '.') ?> đ</div>
                                    <?php if($discount > 0): ?>
                                        <div class="text-muted small text-decoration-line-through mt-1"><?= number_format($original_price, 0, ',', '.') ?> đ</div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <div class="qty-control mb-3">
                                        <a href="index.php?url=Product/decreaseCart/<?= $id ?>" class="qty-btn"><i class="fas fa-minus fs-7"></i></a>
                                        <input type="text" class="qty-input" value="<?= $qty ?>" readonly>
                                        <a href="index.php?url=Product/increaseCart/<?= $id ?>" class="qty-btn"><i class="fas fa-plus fs-7"></i></a>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2">Thành tiền: <span class="text-danger"><?= number_format($sub, 0, ',', '.') ?> đ</span></h6>
                                    <a href="index.php?url=Product/removeCart/<?= $id ?>" class="text-danger small fw-semibold text-decoration-none" onclick="return confirm('Xóa sản phẩm này?')">
                                        <i class="fas fa-trash-alt me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="index.php" class="btn btn-outline-secondary mt-4 fw-semibold rounded-pill px-4"><i class="fas fa-arrow-left me-2"></i> Tiếp tục mua sắm</a>
                </div>

                <div class="col-lg-4">
                    <div class="summary-box">
                        <h4 class="summary-title">Tóm tắt đơn hàng</h4>
                        <div class="summary-row"><span>Tạm tính (<?= $totalItems ?> sản phẩm)</span><span class="fw-semibold"><?= number_format($totalAmount, 0, ',', '.') ?> đ</span></div>
                        <div class="summary-row"><span>Phí giao hàng</span><span class="text-success fw-semibold">Miễn phí</span></div>
                        
                        <div class="summary-total"><span>Tổng cộng</span><span class="total-price"><?= number_format($totalAmount, 0, ',', '.') ?> đ</span></div>
                        
                        <a href="#" class="btn-checkout" onclick="alert('Chức năng đang phát triển!')">Tiến hành thanh toán</a>
                        <div class="mt-4 text-center">
                            <i class="fab fa-cc-visa fa-2x mx-1 text-primary"></i>
                            <i class="fab fa-cc-mastercard fa-2x mx-1 text-danger"></i>
                            <i class="fab fa-cc-paypal fa-2x mx-1 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center bg-white rounded-4 shadow-sm py-5 px-3">
                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="150" class="mb-4 opacity-75">
                <h4 class="fw-bold text-dark mb-3">Giỏ hàng của bạn đang trống</h4>
                <a href="index.php" class="btn btn-danger btn-lg rounded-pill px-5 fw-bold shadow-sm">Mua sắm ngay</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/shares/footer.php'; ?>