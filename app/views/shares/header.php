<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>TechZone - Laptop, Đồ chơi công nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .bg-gradient-brand { background: linear-gradient(90deg, #d70018, #ff3b30); } 
        
        .top-bar { font-size: 0.85rem; background: #111; color: #ccc; padding: 6px 0; }
        .sticky-header { position: sticky; top: 0; z-index: 1030; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .search-input { border-radius: 8px 0 0 8px; border: none; padding-left: 15px; font-size: 0.95rem; }
        .search-btn { border-radius: 0 8px 8px 0; background-color: #333; color: white; border: none; padding: 8px 25px; transition: 0.3s; }
        .search-btn:hover { background-color: #000; }
        
        .cart-badge { position: absolute; top: -8px; right: -12px; background-color: #ffc107; color: #000; font-size: 0.75rem; padding: 3px 7px; border-radius: 50%; font-weight: bold; border: 2px solid #e30019; }

        .btn-hamburger { background: transparent; border: 1px solid rgba(255,255,255,0.5); color: white; padding: 8px 15px; border-radius: 8px; font-size: 1.2rem; cursor: pointer; transition: 0.3s; }
        .btn-hamburger:hover { background: rgba(255,255,255,0.2); border-color: white; }

        /* CHUYỂN CSS CỦA SIDEBAR SANG ĐÂY */
        .offcanvas { border-right: none; box-shadow: 5px 0 25px rgba(0,0,0,0.1); width: 300px; }
        .offcanvas-header { background: #111; color: white; }
        .offcanvas-link { display: block; padding: 12px 15px; color: #333; font-weight: 600; text-decoration: none; border-bottom: 1px solid #f1f1f1; transition: 0.2s; }
        .offcanvas-link i { width: 25px; color: #888; }
        .offcanvas-link:hover { color: #d70018; background: #f8f9fa; padding-left: 20px; }
        .offcanvas-link:hover i { color: #d70018; }
    </style>
</head>
<body>

<div class="top-bar d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-headset me-1 text-danger"></i> Hotline mua hàng: <strong class="text-white">1900 6868</strong>
        </div>
        <div>
            <a href="index.php?url=Product/list" class="text-secondary text-decoration-none me-3 hover-white">
                <i class="fas fa-user-shield me-1"></i> Quản trị viên
            </a>
        </div>
    </div>
</div>

<nav class="navbar bg-gradient-brand py-3 sticky-header">
    <div class="container d-flex align-items-center justify-content-between">
        
        <div class="d-flex align-items-center">
            <button class="btn-hamburger me-3 d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#mainSidebar">
                <i class="fas fa-bars me-2"></i> <span class="fs-6 fw-bold d-none d-md-inline">Danh mục</span>
            </button>
            
            <a class="navbar-brand text-white fw-bold fs-3 mb-0" href="index.php" style="letter-spacing: -1px;">
                <i class="fas fa-laptop-code me-1"></i>TechZone
            </a>
        </div>

        <form class="d-flex flex-grow-1 mx-4" method="GET" action="index.php" style="max-width: 500px;">
            <input type="hidden" name="url" value="Product/search">
            <input class="form-control search-input shadow-none" type="search" name="keyword" placeholder="Bạn cần tìm linh kiện gì...">
            <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div class="d-flex align-items-center">
            <?php 
                $cartCount = 0;
                if(isset($_SESSION['cart'])){ foreach($_SESSION['cart'] as $item){ $cartCount += $item['qty'] ?? 1; } }
            ?>
            <a href="index.php?url=Product/cart" class="text-white text-decoration-none position-relative fs-5 d-flex align-items-center">
                <i class="fas fa-shopping-cart fs-4"></i> 
                <span class="ms-2 fw-semibold d-none d-lg-block fs-6">Giỏ hàng</span>
                <?php if($cartCount > 0): ?>
                    <span class="cart-badge shadow-sm"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</nav>

<div class="bg-dark text-center py-2 shadow-sm mb-4">
    <a href="#" class="text-warning fw-bold text-decoration-none letter-spacing-1">
        <i class="fas fa-fire me-1"></i> KHUYẾN MÃI HOT - GIẢM GIÁ LÊN ĐẾN 50% <i class="fas fa-fire ms-1"></i>
    </a>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mainSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold"><i class="fas fa-layer-group text-danger me-2"></i> DANH MỤC</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <a href="index.php?url=Product/category/Laptop" class="offcanvas-link"><i class="fas fa-laptop"></i> Laptop</a>
        <a href="index.php?url=Product/category/PC" class="offcanvas-link"><i class="fas fa-desktop"></i> PC - Máy tính để bàn</a>
        <a href="index.php?url=Product/category/Chuột" class="offcanvas-link"><i class="fas fa-mouse"></i> Chuột</a>
        <a href="index.php?url=Product/category/Bàn phím" class="offcanvas-link"><i class="fas fa-keyboard"></i> Bàn phím</a>
        <a href="index.php?url=Product/category/Màn hình" class="offcanvas-link"><i class="fas fa-tv"></i> Màn hình</a>

        <div class="p-4 bg-light mt-3 border-top">
            <h6 class="fw-bold mb-3"><i class="fas fa-filter text-secondary me-2"></i> LỌC THEO GIÁ</h6>
            <form action="index.php" method="GET">
                <input type="hidden" name="url" value="Product/filterPrice">
                <div class="form-check mb-2"><input class="form-check-input" type="radio" name="price_range" value="under_5" id="p1" required><label class="form-check-label text-secondary fw-semibold" for="p1">Dưới 5 triệu</label></div>
                <div class="form-check mb-2"><input class="form-check-input" type="radio" name="price_range" value="5_to_15" id="p2"><label class="form-check-label text-secondary fw-semibold" for="p2">5 - 15 triệu</label></div>
                <div class="form-check mb-2"><input class="form-check-input" type="radio" name="price_range" value="15_to_30" id="p3"><label class="form-check-label text-secondary fw-semibold" for="p3">15 - 30 triệu</label></div>
                <div class="form-check mb-3"><input class="form-check-input" type="radio" name="price_range" value="over_30" id="p4"><label class="form-check-label text-secondary fw-semibold" for="p4">Trên 30 triệu</label></div>
                <button type="submit" class="btn btn-danger w-100 fw-bold">Áp dụng lọc</button>
            </form>
        </div>
    </div>
</div>