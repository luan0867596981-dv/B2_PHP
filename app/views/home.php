<?php include __DIR__ . '/shares/header.php'; ?>

<style>
    .promo-banner-bg { background: radial-gradient(circle at 70% 50%, #1a1a1a 0%, #000 100%); height: 380px; overflow: hidden; position: relative; border-radius: 12px;}
    .carousel-item { transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.6s ease-in-out !important; }
    .banner-text-content { opacity: 0; transform: translateY(30px); transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1); transition-delay: 0.1s; }
    .carousel-item.active .banner-text-content { opacity: 1; transform: translateY(0); }
    .banner-img-podium { width: 280px; height: 280px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 50px rgba(227, 0, 25, 0.3), inset 0 0 20px rgba(0,0,0,0.05); opacity: 0; transform: scale(0.8); transition: all 0.7s; transition-delay: 0.2s; position: relative; z-index: 2; }
    .carousel-item.active .banner-img-podium { opacity: 1; transform: scale(1); }
    .promo-banner-img { max-height: 200px; max-width: 200px; object-fit: contain; filter: drop-shadow(0 15px 15px rgba(0,0,0,0.2)); }
    .btn-banner { background: linear-gradient(90deg, #e30019, #ff3b30); border: none; color: white; transition: 0.3s; box-shadow: 0 4px 15px rgba(227,0,25,0.4); text-transform: uppercase; text-decoration: none;}
    .btn-banner:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(227,0,25,0.6); color: white; }

    .product-card { background: #fff; border: 1px solid #f0f0f0; border-radius: 12px; transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden; display: flex; flex-direction: column; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important; border-color: #d70018; z-index: 1; }
    .badge-sale { position: absolute; top: 12px; left: 12px; background: #ff3945; color: white; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 0.8rem; z-index: 2; }
    .product-img-wrapper { position: relative; padding: 20px; text-align: center; }
    .product-img { height: 180px; object-fit: contain; transition: transform 0.4s ease; }
    .product-card:hover .product-img { transform: scale(1.08); }
    .product-title { font-size: 0.95rem; font-weight: 600; color: #333; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px; margin-bottom: 8px; line-height: 1.4; }
    .product-title:hover { color: #d70018; }
    .product-price { font-size: 1.25rem; font-weight: 800; color: #d70018; margin-bottom: 15px; }
    .btn-cart { background: transparent; border: 1.5px solid #d70018; color: #d70018; border-radius: 8px; font-weight: 600; padding: 8px 0; transition: all 0.3s; display: block; text-align: center; text-decoration: none;}
    .btn-cart:hover { background: linear-gradient(90deg, #d70018, #ff3b30); color: #fff; border-color: transparent; box-shadow: 0 4px 10px rgba(215, 0, 24, 0.3); }
</style>

<div class="container mb-5 mt-4">
    <div id="promoBanner" class="carousel slide carousel-fade mb-5 shadow-sm rounded-4" data-bs-ride="carousel" data-bs-interval="4000">
        <?php $bannerProducts = !empty($products) ? array_slice($products, 0, 3) : []; ?>
        <div class="carousel-inner rounded-4">
            <?php if (!empty($bannerProducts)): foreach ($bannerProducts as $index => $bp): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="d-flex align-items-center w-100 promo-banner-bg">
                        <div class="p-4 p-lg-5 w-50 banner-text-content ms-md-4">
                            <span class="badge bg-danger px-3 py-2 mb-3 fs-6 rounded-pill"><i class="fas fa-bolt text-warning me-1"></i> DEAL HOT</span>
                            <h2 class="text-white fw-bold lh-base" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 2.2rem;">
                                <?= htmlspecialchars($bp['name']) ?>
                            </h2>
                            <h3 class="text-warning fw-bold mt-2" style="font-size: 1.8rem;">
                                <?= number_format($bp['price'] - ($bp['price'] * ($bp['discount'] ?? 0) / 100), 0, ',', '.') ?> <span class="fs-6">đ</span>
                            </h3>
                            <a href="index.php?url=Product/detail/<?= $bp['id'] ?>" class="btn btn-banner mt-3 rounded-pill px-4 py-2 fw-bold">Mua ngay kẻo lỡ</a>
                        </div>
                        <div class="w-50 h-100 d-flex justify-content-center align-items-center p-3">
                            <div class="banner-img-podium">
                                <img src="<?= $bp['image'] ?>" class="promo-banner-img">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoBanner" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoBanner" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h4 class="fw-bold mb-0 text-uppercase d-flex align-items-center">
            <div class="bg-danger text-white rounded p-2 me-2 shadow-sm d-flex"><i class="fas fa-star"></i></div>
            Sản phẩm công nghệ
        </h4>
    </div>

    <div class="row g-3">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $p): ?>
                <?php 
                    $discount = $p['discount'] ?? 0;
                    $original_price = $p['price'] ?? 0;
                    $sale_price = $original_price - ($original_price * ($discount / 100));
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card shadow-sm">
                        <?php if($discount > 0): ?>
                            <div class="badge-sale">-<?= $discount ?>%</div>
                        <?php endif; ?>
                        <div class="product-img-wrapper">
                            <a href="index.php?url=Product/detail/<?= $p['id'] ?>">
                                <img src="<?= $p['image'] ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($p['name']) ?>">
                            </a>
                        </div>
                        <div class="card-body p-3 d-flex flex-column">
                            <a href="index.php?url=Product/detail/<?= $p['id'] ?>" class="product-title"><?= htmlspecialchars($p['name']) ?></a>
                            <div class="text-warning small mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="text-muted ms-1">Đã bán <?= rand(10, 200) ?></span></div>
                            
                            <div class="product-price mt-auto">
                                <?= number_format($sale_price, 0, ',', '.') ?> <u>đ</u>
                                <?php if($discount > 0): ?>
                                    <div class="text-muted small text-decoration-line-through mt-1" style="font-size: 0.85rem; font-weight: 500;">
                                        <?= number_format($original_price, 0, ',', '.') ?> đ
                                    </div>
                                <?php endif; ?>
                            </div>

                            <a href="index.php?url=Product/addToCart/<?= $p['id'] ?>" class="btn btn-cart w-100 mt-2"><i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Không tìm thấy sản phẩm nào phù hợp!</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/shares/footer.php'; ?>