<?php include __DIR__ . '/../shares/header.php'; ?>

<style>
    body { background-color: #f4f6f9; }
    .detail-wrapper { padding-bottom: 60px; }
    
    /* Breadcrumb */
    .breadcrumb-box { padding: 15px 0; font-size: 0.9rem; font-weight: 500; }
    .breadcrumb-box a { color: #0d6efd; text-decoration: none; transition: 0.2s; }
    .breadcrumb-box a:hover { color: #d70018; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; line-height: 1; }
    
    /* Khối Ảnh Sản Phẩm */
    .product-gallery { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); position: sticky; top: 100px; text-align: center; border: 1px solid #f0f0f0;}
    .main-img { width: 100%; max-height: 450px; object-fit: contain; transition: transform 0.5s ease; }
    .main-img:hover { transform: scale(1.05); }
    .badge-tragop { position: absolute; top: 20px; left: 20px; background: linear-gradient(90deg, #ffc107, #ff9800); color: #000; font-weight: 800; padding: 6px 15px; border-radius: 20px; font-size: 0.8rem; z-index: 10; box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);}

    /* Khối Thông tin chính */
    .product-info { background: #fff; border-radius: 16px; padding: 35px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); border: 1px solid #f0f0f0;}
    .product-title { font-size: 1.8rem; font-weight: 800; color: #111; line-height: 1.4; margin-bottom: 15px; }
    .product-meta { font-size: 0.95rem; color: #555; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee; display: flex; align-items: center; flex-wrap: wrap; gap: 15px;}
    .product-meta i { color: #ffc107; }

    /* Khối Giá */
    .price-box { display: flex; align-items: flex-end; gap: 15px; margin-bottom: 25px; background: linear-gradient(to right, #fef2f2, #fff); padding: 20px 25px; border-radius: 12px; border-left: 5px solid #d70018; }
    .current-price { font-size: 2.2rem; font-weight: 800; color: #d70018; line-height: 1; margin: 0; }
    .old-price { font-size: 1.2rem; color: #999; text-decoration: line-through; margin-bottom: 4px; font-weight: 500;}
    .discount-tag { background: #d70018; color: #fff; font-size: 0.85rem; font-weight: 700; padding: 4px 10px; border-radius: 6px; margin-bottom: 6px; box-shadow: 0 3px 8px rgba(215,0,24,0.3);}

    /* Khối Khuyến mãi */
    .promo-box { border: 1px solid #fce4e4; border-radius: 12px; overflow: hidden; margin-bottom: 25px; background: #fff; }
    .promo-header { background: #fdf2f2; padding: 12px 20px; border-bottom: 1px solid #fce4e4; font-weight: 700; color: #d70018; display: flex; align-items: center; font-size: 1.05rem;}
    .promo-header i { font-size: 1.3rem; margin-right: 10px; }
    .promo-list { padding: 20px; list-style: none; margin: 0; font-size: 0.95rem; color: #444;}
    .promo-list li { margin-bottom: 12px; display: flex; align-items: flex-start; }
    .promo-list li i { color: #10b981; margin-top: 4px; margin-right: 12px; font-size: 1rem; }
    .promo-list li:last-child { margin-bottom: 0; }

    /* Nút Hành động */
    .action-buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px; }
    .btn-buy-now { grid-column: 1 / -1; background: linear-gradient(90deg, #d70018, #ff3b30); color: #fff; border: none; padding: 16px; border-radius: 10px; text-align: center; text-decoration: none; transition: 0.3s; box-shadow: 0 6px 20px rgba(215,0,24,0.3); display: flex; flex-direction: column; justify-content: center;}
    .btn-buy-now:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(215,0,24,0.5); color: #fff; }
    .btn-buy-now strong { font-size: 1.3rem; text-transform: uppercase; letter-spacing: 0.5px;}
    .btn-buy-now span { font-size: 0.9rem; opacity: 0.9; margin-top: 2px;}
    
    .btn-add-cart { background: #eff6ff; border: 2px solid #3b82f6; color: #1d4ed8; padding: 14px; border-radius: 10px; text-align: center; font-weight: 700; text-decoration: none; transition: 0.3s; display: flex; flex-direction: column; align-items: center; justify-content: center;}
    .btn-add-cart:hover { background: #3b82f6; color: #fff; box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);}
    .btn-add-cart i { font-size: 1.4rem; margin-bottom: 6px; }

    .btn-admin-edit { background: #f8fafc; border: 2px dashed #94a3b8; color: #475569; padding: 14px; border-radius: 10px; text-align: center; font-weight: 700; text-decoration: none; transition: 0.3s; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .btn-admin-edit:hover { background: #fef3c7; border-color: #f59e0b; color: #d97706; }
    .btn-admin-edit i { font-size: 1.4rem; margin-bottom: 6px; }

    /* =========================================================
       CSS MỚI CHO PHẦN DƯỚI (MÔ TẢ & BÊN PHẢI)
       ========================================================= */
    
    /* Khối Mô Tả Trái */
    .content-box { background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); border: 1px solid #f0f0f0; margin-top: 25px; min-height: 100%;}
    .section-title { font-size: 1.4rem; font-weight: 800; margin-bottom: 25px; color: #111; display: flex; align-items: center; text-transform: uppercase;}
    .section-title i { color: #d70018; margin-right: 12px; font-size: 1.6rem;}
    
    .article-content { font-size: 1.05rem; line-height: 1.8; color: #444; }
    
    /* Bảng thông số kỹ thuật */
    .spec-table { width: 100%; border-collapse: collapse; margin-top: 30px; border-radius: 8px; overflow: hidden; border: 1px solid #eee;}
    .spec-table th, .spec-table td { padding: 15px; border-bottom: 1px solid #eee; font-size: 0.95rem;}
    .spec-table th { background-color: #f8fafc; width: 35%; color: #555; font-weight: 600;}
    .spec-table td { color: #222; font-weight: 500;}
    .spec-table tr:last-child th, .spec-table tr:last-child td { border-bottom: none; }

    /* Widget Cột Phải mới thay cho ảnh đen */
    .gaming-widget { background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%); border-radius: 16px; padding: 35px 25px; color: #fff; position: sticky; top: 100px; margin-top: 25px; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.2); overflow: hidden;}
    /* Hiệu ứng tia chớp chéo khối widget */
    .gaming-widget::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0) 100%); transform: rotate(45deg); animation: shine 6s infinite; }
    @keyframes shine { 0% { transform: translateX(-100%) rotate(45deg); } 20%, 100% { transform: translateX(100%) rotate(45deg); } }
    
    .widget-title { text-align: center; font-size: 1.3rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 30px; }
    .widget-title span { color: #f43f5e; }
    
    .feature-item { display: flex; align-items: flex-start; margin-bottom: 25px; position: relative; z-index: 1;}
    .feature-icon { width: 50px; height: 50px; border-radius: 12px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #f43f5e; margin-right: 15px; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.05);}
    .feature-text h5 { font-size: 1.05rem; font-weight: 700; margin-bottom: 5px; color: #f8fafc;}
    .feature-text p { font-size: 0.85rem; color: #94a3b8; margin: 0; line-height: 1.5;}

</style>

<div class="detail-wrapper">
    <div class="container">
        
        <nav aria-label="breadcrumb" class="breadcrumb-box">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Danh mục sản phẩm</a></li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 400px; color: #555;">
                    <?= htmlspecialchars($product['name'] ?? 'Chi tiết sản phẩm') ?>
                </li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="product-gallery">
                    <span class="badge-tragop"><i class="fas fa-credit-card me-1"></i> Trả góp 0%</span>
                    <img src="<?= $product['image'] ?? 'https://placehold.co/600x600?text=No+Image' ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>" class="main-img">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="product-info">
                    <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                    
                    <div class="product-meta">
                        <span><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <a href="#" class="text-primary text-decoration-none ms-1">(15 đánh giá)</a></span>
                        <span class="border-start ps-3"><i class="fas fa-box-open text-success me-1"></i> Tình trạng: <span class="text-success fw-bold">Còn hàng</span></span>
                        <span class="border-start ps-3 text-muted"><i class="fas fa-barcode me-1"></i> Mã SP: #<?= $product['id'] ?></span>
                    </div>

                    <div class="price-box">
                        <?php 
                            $discount = $product['discount'] ?? 0;
                            $original_price = $product['price'] ?? 0;
                            $sale_price = $original_price - ($original_price * ($discount / 100));
                        ?>
                        <p class="current-price"><?= number_format($sale_price, 0, ',', '.') ?> đ</p>
                        <?php if($discount > 0): ?>
                            <p class="old-price ms-3 mb-1"><?= number_format($original_price, 0, ',', '.') ?> đ</p>
                            <span class="discount-tag ms-3 mb-1">-<?= $discount ?>%</span>
                        <?php endif; ?>
                    </div>

                    <div class="promo-box">
                        <div class="promo-header"><i class="fas fa-gift"></i> Nhận ngay Ưu đãi Đặc biệt</div>
                        <ul class="promo-list">
                            <li><i class="fas fa-check-circle"></i> Tặng ngay Balo TechZone hoặc Lót chuột RGB cho đơn hàng trên 5 triệu.</li>
                            <li><i class="fas fa-check-circle"></i> Giảm thêm 5% (tối đa 500.000đ) khi thanh toán qua VNPay/MoMo.</li>
                            <li><i class="fas fa-check-circle"></i> Hỗ trợ trả góp 0% qua thẻ tín dụng Visa/Mastercard (Duyệt 15 phút).</li>
                        </ul>
                    </div>

                    <div class="action-buttons">
                        <a href="index.php?url=Product/addToCart/<?= $product['id'] ?>" class="btn-buy-now">
                            <strong>MUA NGAY CHỐT DEAL</strong>
                            <span>Giao hàng tận nơi nội thành trong 2 giờ</span>
                        </a>
                        <a href="index.php?url=Product/addToCart/<?= $product['id'] ?>" class="btn-add-cart">
                            <i class="fas fa-cart-plus"></i>
                            <span>Thêm Giỏ Hàng</span>
                        </a>
                        <a href="index.php?url=Product/edit/<?= $product['id'] ?>" class="btn-admin-edit">
                            <i class="fas fa-pencil-alt"></i>
                            <span>Sửa Thông Tin</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="content-box">
                    <h3 class="section-title"><i class="fas fa-gem"></i> Đặc điểm nổi bật</h3>
                    
                    <div class="article-content">
                        <?= nl2br(htmlspecialchars($product['description'] ?? 'Đang cập nhật thông tin chi tiết...')) ?>
                    </div>

                    <h4 class="mt-5 mb-3 fw-bold fs-5 text-dark"><i class="fas fa-sliders-h text-secondary me-2"></i> Thông số kỹ thuật</h4>
                    <table class="spec-table">
                        <tbody>
                            <tr><th>Mã sản phẩm</th><td>TZ-<?= str_pad($product['id'] ?? 0, 5, '0', STR_PAD_LEFT) ?></td></tr>
                            <tr><th>Tình trạng</th><td>Mới 100% - Fullbox nguyên seal</td></tr>
                            <tr><th>Bảo hành</th><td>24 tháng chính hãng (1 đổi 1 trong 30 ngày đầu)</td></tr>
                            <tr><th>Vận chuyển</th><td>Miễn phí giao hàng toàn quốc</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="gaming-widget">
                    <div class="widget-title">TECHZONE <span>PREMIUM</span></div>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="feature-text">
                            <h5>Hàng Chính Hãng 100%</h5>
                            <p>Đầy đủ giấy tờ, hóa đơn VAT. Bồi thường 200% nếu phát hiện hàng giả.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                        <div class="feature-text">
                            <h5>Giao Hàng Hỏa Tốc</h5>
                            <p>Nhận hàng ngay trong 2 giờ tại nội thành. Đóng gói chống sốc an toàn.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-headset"></i></div>
                        <div class="feature-text">
                            <h5>Hỗ Trợ Kỹ Thuật 24/7</h5>
                            <p>Đội ngũ chuyên gia luôn sẵn sàng giải đáp và xử lý sự cố trọn đời.</p>
                        </div>
                    </div>

                    <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-50">
                        <img src="https://cdn-icons-png.flaticon.com/512/3276/3276898.png" alt="Gaming" width="80" class="opacity-50">
                    </div>
                </div>
            </div>

        </div> </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>