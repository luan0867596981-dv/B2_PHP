<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm - TechZone Admin</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --bg-body: #f1f5f9; --brand-color: #e11d48; --text-main: #334155; --border-color: #e2e8f0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-body); color: var(--text-main); padding-bottom: 50px; }
        .page-header { background: #fff; padding: 20px 0; border-bottom: 1px solid var(--border-color); box-shadow: 0 2px 10px rgba(0,0,0,0.02); margin-bottom: 30px; position: sticky; top: 0; z-index: 100; }
        .admin-card { background: #fff; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 24px; margin-bottom: 24px; }
        .admin-card-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; }
        .admin-card-title i { color: #f59e0b; margin-right: 10px; } /* Đổi màu icon sang cam cho phần Edit */
        .form-label { font-weight: 600; font-size: 0.9rem; color: #475569; margin-bottom: 8px; }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #fff; border-color: #cbd5e1; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15); }
        .input-group-text { background-color: #f8fafc; border: 2px solid #e2e8f0; border-right: none; color: #64748b; font-weight: 600; border-radius: 10px 0 0 10px; }
        .input-group .form-control { border-left: none; padding-left: 0; }
        .input-group .form-control:focus { border-left: none; box-shadow: inset 0 -2px 0 #f59e0b; }
        .img-preview-box { border: 2px dashed #cbd5e1; border-radius: 12px; height: 220px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8fafc; overflow: hidden; position: relative; margin-top: 15px; }
        .img-preview-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .preview-placeholder { color: #94a3b8; text-align: center; }
        .preview-placeholder i { font-size: 2.5rem; margin-bottom: 10px; color: #cbd5e1; }
        .btn-save { background: linear-gradient(90deg, #f59e0b, #d97706); color: #fff; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); transition: all 0.3s; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(245, 158, 11, 0.5); color: #fff; }
        .btn-back { background: #fff; border: 1px solid #cbd5e1; color: #475569; padding: 12px 24px; border-radius: 10px; font-weight: 600; transition: 0.3s; text-decoration: none; }
        .btn-back:hover { background: #f1f5f9; color: #0f172a; }
        .error-box { background-color: #fef2f2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; }
    </style>
</head>
<body>

    <div class="page-header">
        <div class="container-fluid px-4 px-lg-5 d-flex justify-content-between align-items-center">
            <div>
                <a href="index.php?url=Product/list" class="text-muted text-decoration-none small fw-bold mb-1 d-block">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại kho hàng
                </a>
                <h3 class="fw-bold text-dark mb-0">Chỉnh sửa SP: #<?= $product['id'] ?? '' ?></h3>
            </div>
            <div>
                <button type="submit" form="editProductForm" class="btn-save d-none d-md-inline-block">
                    <i class="fas fa-save me-2"></i>Cập nhật
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 px-lg-5">
        <?php if (!empty($errors)): ?>
            <div class="error-box shadow-sm">
                <i class="fas fa-exclamation-triangle me-2"></i> Lỗi: <?= implode(', ', $errors) ?>
            </div>
        <?php endif; ?>

        <form action="index.php?url=Product/edit/<?= $product['id'] ?>" method="POST" id="editProductForm">
            <div class="row g-4">
                
                <div class="col-lg-8">
                    <div class="admin-card">
                        <div class="admin-card-title">
                            <i class="fas fa-pen-square"></i> Thông tin cơ bản
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mô tả sản phẩm</label>
                            <textarea name="description" class="form-control" rows="6"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <label class="form-label">Giá gốc <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    
                                    <input type="text" id="priceDisplay" class="form-control" value="<?= number_format($product['price'] ?? 0, 0, ',', '.') ?>" required>
                                    
                                    <input type="hidden" name="price" id="priceHidden" value="<?= $product['price'] ?? 0 ?>">
                                    
                                    <span class="input-group-text bg-white border-left-0">VNĐ</span>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <label class="form-label">Giảm giá (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text text-danger"><i class="fas fa-percent"></i></span>
                                    <input type="number" name="discount" class="form-control text-danger fw-bold" min="0" max="100" value="<?= $product['discount'] ?? 0 ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="admin-card">
                        <div class="admin-card-title">
                            <i class="fas fa-folder-open"></i> Phân loại
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" required>
                                <option value="" disabled>-- Chọn danh mục --</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= (isset($product['category_id']) && $product['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="admin-card">
                        <div class="admin-card-title">
                            <i class="fas fa-image"></i> Hình ảnh
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn ảnh (URL) <span class="text-danger">*</span></label>
                            <input type="text" name="image" id="imageLink" class="form-control" value="<?= htmlspecialchars($product['image'] ?? '') ?>" required>
                        </div>
                        
                        <div class="img-preview-box">
                            <div class="preview-placeholder" id="previewPlaceholder" style="<?= !empty($product['image']) ? 'display: none;' : '' ?>">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="mb-0 fw-semibold">Xem trước hình ảnh</p>
                            </div>
                            
                            <img src="<?= htmlspecialchars($product['image'] ?? '') ?>" id="previewImg" alt="Preview" style="<?= !empty($product['image']) ? 'display: block;' : 'display: none;' ?>">
                        </div>
                    </div>

                    <div class="admin-card">
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn-save btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Cập nhật sản phẩm
                            </button>
                            <a href="index.php?url=Product/list" class="btn-back text-center">
                                Hủy & Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Xử lý giá tiền (Format dấu chấm)
        const priceDisplay = document.getElementById('priceDisplay');
        const priceHidden = document.getElementById('priceHidden');

        priceDisplay.addEventListener('input', function(e) {
            let value = this.value.replace(/[^0-9]/g, '');
            priceHidden.value = value;
            if (value !== '') {
                this.value = new Intl.NumberFormat('vi-VN').format(value);
            } else {
                this.value = '';
            }
        });

        // Xử lý Live Preview Hình ảnh
        document.getElementById('imageLink').addEventListener('input', function(e) {
            const url = e.target.value.trim();
            const previewImg = document.getElementById('previewImg');
            const placeholder = document.getElementById('previewPlaceholder');
            
            if(url !== '') {
                previewImg.src = url;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
                placeholder.style.display = 'block';
            }
            
            previewImg.onerror = function() {
                previewImg.style.display = 'none';
                placeholder.style.display = 'block';
                placeholder.innerHTML = '<i class="fas fa-broken-image text-danger"></i><p class="mb-0 fw-semibold text-danger">Lỗi tải ảnh!</p>';
            };
            previewImg.onload = function() {
                placeholder.innerHTML = '<i class="fas fa-cloud-upload-alt"></i><p class="mb-0 fw-semibold">Xem trước hình ảnh</p>';
            };
        });
    </script>
</body>
</html>