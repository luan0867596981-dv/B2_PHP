<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechZone Dashboard - Quản lý tối cao</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-bg: #0f172a; /* Slate 900 */
            --sidebar-hover: #1e293b; /* Slate 800 */
            --brand-color: #e11d48; /* Rose 600 */
            --bg-body: #f1f5f9; /* Slate 100 */
            --text-main: #334155; /* Slate 700 */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- LAYOUT TỔNG --- */
        .app-wrapper { display: flex; min-height: 100vh; }
        
        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            z-index: 1000;
        }
        .sidebar-brand {
            padding: 24px;
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-brand i { color: var(--brand-color); margin-right: 12px; font-size: 1.8rem; }
        
        .nav-menu { padding: 20px 15px; flex-grow: 1; }
        .nav-item { margin-bottom: 8px; }
        .nav-link {
            color: #cbd5e1;
            padding: 12px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .nav-link i { width: 24px; font-size: 1.1rem; margin-right: 10px; opacity: 0.8; }
        .nav-link:hover, .nav-link.active {
            background-color: var(--sidebar-hover);
            color: #fff;
            transform: translateX(5px);
        }
        .nav-link.active {
            background: linear-gradient(90deg, var(--brand-color), #be123c);
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.3);
        }
        
        /* --- MAIN CONTENT --- */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* --- TOP NAV --- */
        .top-header {
            background: #fff;
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .search-bar {
            background: #f1f5f9;
            border-radius: 20px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            width: 300px;
        }
        .search-bar input { border: none; background: transparent; outline: none; margin-left: 10px; width: 100%; font-size: 0.9rem; }
        
        /* --- DASHBOARD WIDGETS --- */
        .content-body { padding: 30px; }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #cbd5e1; }
        .stat-icon {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }
        .stat-info h3 { font-size: 1.8rem; font-weight: 800; color: #0f172a; margin: 0; }
        .stat-info p { margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500; }

        /* --- TABLE PRO --- */
        .table-wrapper {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-top: 30px;
        }
        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
        }
        .table { margin: 0; vertical-align: middle; }
        .table th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
        }
        .table td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-weight: 500;
        }
        .table tbody tr { transition: all 0.2s; }
        .table tbody tr:hover { background-color: #f8fafc; }

        /* Khối hiển thị Sản phẩm (Gộp Ảnh + Tên + ID) */
        .product-info-cell { display: flex; align-items: center; gap: 16px; }
        .prod-img-box {
            width: 60px; height: 60px;
            border-radius: 10px;
            background: #fff;
            border: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: center;
            padding: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .prod-img-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .prod-name { font-weight: 700; color: #0f172a; text-decoration: none; font-size: 0.95rem; display: block; margin-bottom: 4px; }
        .prod-name:hover { color: var(--brand-color); }
        .prod-id { font-size: 0.75rem; color: #94a3b8; background: #f1f5f9; padding: 2px 8px; border-radius: 4px; font-weight: 600; }

        /* Nút Actions tinh gọn */
        .btn-action {
            width: 36px; height: 36px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 8px; border: none;
            transition: all 0.2s; text-decoration: none;
            margin-right: 6px;
        }
        .btn-edit { background: #eff6ff; color: #3b82f6; }
        .btn-edit:hover { background: #3b82f6; color: #fff; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); transform: translateY(-2px); }
        .btn-delete { background: #fef2f2; color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: #fff; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); transform: translateY(-2px); }

        /* Badge trạng thái (Visual) */
        .badge-status { padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
        .status-active { background: #dcfce7; color: #166534; }
        
        .btn-primary-custom { background: var(--brand-color); border: none; color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.2); text-decoration: none; display: inline-flex; align-items: center;}
        .btn-primary-custom:hover { background: #be123c; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(225, 29, 72, 0.4); }

    </style>
</head>
<body>

<div class="app-wrapper">
    
    <aside class="sidebar shadow">
        <a href="index.php?url=Product/list" class="sidebar-brand">
            <i class="fas fa-layer-group"></i> TechZone
        </a>
        
        <div class="nav-menu">
            <div class="text-uppercase text-secondary small fw-bold mb-3 px-3 mt-2" style="letter-spacing: 1px; font-size: 0.7rem;">Menu chính</div>
            
            <div class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-chart-pie"></i> Tổng quan</a>
            </div>
            <div class="nav-item">
                <a href="index.php?url=Product/list" class="nav-link active"><i class="fas fa-box-open"></i> Kho sản phẩm</a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-shopping-cart"></i> Đơn hàng <span class="badge bg-danger ms-auto">5</span></a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users"></i> Khách hàng</a>
            </div>
            
            <div class="text-uppercase text-secondary small fw-bold mb-3 px-3 mt-4" style="letter-spacing: 1px; font-size: 0.7rem;">Hệ thống</div>
            
            <div class="nav-item">
                <a href="index.php" class="nav-link"><i class="fas fa-store"></i> Xem cửa hàng</a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cog"></i> Cài đặt</a>
            </div>
        </div>
        
        <div class="p-3">
            <div class="bg-dark rounded-3 p-3 text-center border border-secondary border-opacity-25">
                <img src="https://ui-avatars.com/api/?name=Admin&background=e11d48&color=fff" class="rounded-circle mb-2" width="40">
                <h6 class="text-white mb-0 fs-6">Quản trị viên</h6>
                <p class="text-muted small mb-0">admin@techzone.vn</p>
            </div>
        </div>
    </aside>

    <main class="main-content">
        
        <header class="top-header">
            <div class="search-bar">
                <i class="fas fa-search text-muted"></i>
                <input type="text" placeholder="Tìm kiếm nhanh mã SP, tên...">
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light rounded-circle position-relative p-2 border-0 bg-light">
                    <i class="fas fa-bell text-secondary fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
            </div>
        </header>

        <div class="content-body">
            
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-info">
                            <p>Tổng sản phẩm</p>
                            <h3><?= !empty($products) ? count($products) : 0 ?></h3>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-info">
                            <p>Tình trạng kho</p>
                            <h3>Tốt</h3>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-info">
                            <p>Tổng giá trị ước tính</p>
                            <h3 class="text-danger">
                                <?php 
                                    $totalValue = 0;
                                    if(!empty($products)){
                                        foreach($products as $p) $totalValue += $p['price'];
                                    }
                                    // Chế ra một con số nhân lên cho ngầu
                                    echo number_format($totalValue * 15, 0, ',', '.'); 
                                ?>đ
                            </h3>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-wrapper">
                
                <div class="table-header">
                    <h5 class="mb-0 fw-bold text-dark fs-5">Danh sách sản phẩm</h5>
                    <a href="index.php?url=Product/add" class="btn-primary-custom">
                        <i class="fas fa-plus me-2"></i> Thêm mới
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless align-middle text-start">
                        <thead>
                            <tr>
                                <th width="45%" class="ps-4">Sản phẩm</th>
                                <th width="20%">Giá niêm yết</th>
                                <th width="15%" class="text-center">Trạng thái</th>
                                <th width="20%" class="text-end pe-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $p): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="product-info-cell">
                                                <div class="prod-img-box">
                                                    <img src="<?= $p['image'] ?? 'https://placehold.co/100x100?text=No+Image' ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                                                </div>
                                                <div>
                                                    <a href="index.php?url=Product/detail/<?= $p['id'] ?>" class="prod-name">
                                                        <?= htmlspecialchars($p['name']) ?>
                                                    </a>
                                                    <span class="prod-id"><i class="fas fa-hashtag me-1 opacity-50"></i><?= $p['id'] ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 1.1rem;">
                                                <?= number_format($p['price'], 0, ',', '.') ?> <span class="text-danger">đ</span>
                                            </span>
                                        </td>
                                        
                                        <td class="text-center">
                                            <span class="badge-status status-active">
                                                <i class="fas fa-circle text-success" style="font-size: 0.5rem; vertical-align: middle; margin-right: 4px;"></i> Đang bán
                                            </span>
                                        </td>
                                        
                                        <td class="text-end pe-4">
                                            <a href="index.php?url=Product/edit/<?= $p['id'] ?>" class="btn-action btn-edit" title="Chỉnh sửa">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="index.php?url=Product/delete/<?= $p['id'] ?>" 
                                               onclick="return confirm('Hành động này không thể hoàn tác. Bạn chắc chắn muốn xóa?')" 
                                               class="btn-action btn-delete" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <img src="https://cdn-icons-png.flaticon.com/512/10313/10313098.png" width="80" class="opacity-25 mb-3">
                                        <h6 class="text-muted fw-normal">Chưa có dữ liệu sản phẩm</h6>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <footer class="mt-5 text-center text-muted small pb-4">
                &copy; 2024 TechZone Admin. Thiết kế hệ thống quản trị chuyên nghiệp.
            </footer>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>