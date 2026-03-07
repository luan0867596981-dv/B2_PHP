<style>
    /* =========================================
       CSS CHO ICON MẠNG XÃ HỘI BÊN DƯỚI FOOTER
       ========================================= */
    .social-icons-box .btn {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Hiệu ứng nảy lên nhẹ khi hover vào tất cả các icon */
    .social-icons-box .btn:hover {
        transform: translateY(-5px);
    }

    /* FACEBOOK - Màu Xanh dương */
    .social-icons-box .social-fb:hover {
        background-color: #1877F2 !important;
        border-color: #1877F2 !important;
        color: #fff !important;
        box-shadow: 0 5px 15px rgba(24, 119, 242, 0.4);
    }

    /* YOUTUBE - Màu Đỏ */
    .social-icons-box .social-yt:hover {
        background-color: #FF0000 !important;
        border-color: #FF0000 !important;
        color: #fff !important;
        box-shadow: 0 5px 15px rgba(255, 0, 0, 0.4);
    }

    /* TIKTOK - Màu Đen & Đổ bóng Neon */
    .social-icons-box .social-tt:hover {
        background-color: #000000 !important;
        border-color: #000000 !important;
        color: #fff !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        /* Hiệu ứng bóng chữ xanh-đỏ đặc trưng của TikTok */
        text-shadow: 1px 1px 0px #00f2fe, -1px -1px 0px #fe0979; 
    }

    /* INSTAGRAM - Màu Gradient loang */
    .social-icons-box .social-ig:hover {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%) !important;
        border-color: transparent !important;
        color: #fff !important;
        box-shadow: 0 5px 15px rgba(220, 39, 67, 0.4);
    }
</style>

<footer class="bg-dark text-light py-5 mt-5 border-top border-secondary border-opacity-25">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-md-4">
                <h5 class="fw-bold mb-3 text-white"><i class="fas fa-laptop-code text-danger me-2"></i>TechZone</h5>
                <p class="text-secondary small lh-lg">Hệ thống phân phối Laptop, PC và Đồ chơi công nghệ chính hãng hàng đầu Việt Nam. Cam kết giá tốt nhất, dịch vụ hậu mãi chuẩn 5 sao.</p>
            </div>
            
            <div class="col-md-4">
                <h6 class="text-uppercase fw-bold mb-3 text-white">Chính sách</h6>
                <ul class="list-unstyled text-secondary small lh-lg">
                    <li><a href="#" class="text-secondary text-decoration-none hover-white transition-02"><i class="fas fa-angle-right me-1 text-danger"></i> Chính sách bảo hành</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none hover-white transition-02"><i class="fas fa-angle-right me-1 text-danger"></i> Chính sách đổi trả</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none hover-white transition-02"><i class="fas fa-angle-right me-1 text-danger"></i> Giao hàng & Lắp đặt</a></li>
                </ul>
            </div>
            
            <div class="col-md-4">
                <h6 class="text-uppercase fw-bold mb-3 text-white">Kết nối với chúng tôi</h6>
                
                <div class="d-flex gap-3 social-icons-box">
                    <a href="#" class="btn btn-outline-light rounded-circle social-fb"><i class="fab fa-facebook-f fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle social-yt"><i class="fab fa-youtube fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle social-tt"><i class="fab fa-tiktok fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle social-ig"><i class="fab fa-instagram fs-5"></i></a>
                </div>
                
                
            </div>

        </div>
        
        <div class="text-center text-secondary small mt-5 pt-3 border-top border-secondary border-opacity-25">
            &copy; 2024 TechZone. All rights reserved. Designed for Pro Gamers.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>