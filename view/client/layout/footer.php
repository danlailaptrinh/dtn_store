

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-light pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4 pb-4 border-bottom border-secondary">
                <div class="col-md-4">
                    <h5 class="fw-bold text-white mb-3">
                        <i class="bi bi-phone-fill text-danger me-2"></i><?= viewE(APP_NAME) ?>
                    </h5>
                    <p class="text-secondary small mb-2">
                        Hệ thống bán lẻ điện thoại thông minh chính hãng với đầy đủ phiên bản RAM, dung lượng và màu sắc.
                    </p>
                    <p class="small mb-1"><i class="bi bi-geo-alt text-danger me-2"></i>66B Nguyễn Sĩ Sách, phường 15 Tân Bình</p>
                    <p class="small mb-0"><i class="bi bi-telephone text-danger me-2"></i>Hotline: <strong>1900 6868</strong> (8:00 - 21:30)</p>
                </div>

                <div class="col-6 col-md-4">
                    <h6 class="fw-bold text-white mb-3">Chính sách mua hàng & Bảo hành</h6>
                    <ul class="list-unstyled small text-secondary mb-0">
                        <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i>Chính sách giao hàng toàn quốc</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i>Chính sách thanh toán (COD & QR)</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i>Bảo hành chính hãng 12 tháng</li>
                        <li class="mb-0"><i class="bi bi-check2-circle text-danger me-2"></i>Lỗi 1 đổi 1 trong 30 ngày đầu</li>
                    </ul>
                </div>

                <div class="col-6 col-md-4">
                    <h6 class="fw-bold text-white mb-3">Thông tin liên hệ</h6>
                    <ul class="list-unstyled small text-secondary mb-0">
                        <li class="mb-2"><i class="bi bi-envelope text-danger me-2"></i>Email: vdai19122003@gmail.com</li>
                        <li class="mb-2"><i class="bi bi-clock text-danger me-2"></i>Giờ mở cửa: 08:00 - 21:30 hằng ngày</li>
                        <li class="mb-0"><i class="bi bi-shield-check text-danger me-2"></i>Cam kết 100% điện thoại nguyên seal</li>
                    </ul>
                </div>
            </div>
            <div class="pt-3 text-center small text-secondary">
                &copy; <?= date('Y') ?> <?= viewE(APP_NAME) ?> - Đồ án Website Thương Mại Điện Tử Bán Điện Thoại.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= viewAsset('js/client.js') ?>"></script>
<script src="<?= viewAsset('js/demo.js') ?>"></script>
</body>
</html>
