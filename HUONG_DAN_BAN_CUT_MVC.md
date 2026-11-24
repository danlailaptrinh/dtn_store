# PhoneStore PHP MVC — bản cắt lại giao diện từ `giao_dien/`

## Trang đã chuyển sang View chính thức
- `admin/view/`: Dashboard, categories, products, orders, reviews, users, variants.
- `view/client/`: Trang chủ, sản phẩm, đăng nhập, giỏ hàng, thanh toán, tài khoản, đơn hàng.
- `employee/view/`: Dashboard và đơn hàng nhân viên.
- `view/errors/`: 403, 404.
- Layout Admin, Client, Employee tách riêng, CSS/ảnh từ `/assets/`.

## Routing
- `/index.php?route=/` và các đường dẫn client.
- `/admin/index.php?route=/admin/products` (LIVE MySQL), `/create`, `/store`.
- `/admin/index.php?route=/admin/products/edit/ID`, `/update/ID` (LIVE MySQL).
- `/admin/index.php?route=/admin/products/ID/variants` (LIVE MySQL danh sách, UI từ demo).
- `/admin/index.php?route=/admin` và các trang quản trị khác là **GIAO DIỆN MẪU** chưa kết nối xử lý.
- `/employee/index.php?route=/employee` và các trang nhân viên là **GIAO DIỆN MẪU**.

**Quan trọng:** ZIP (7) là bản code PDO đối tượng, không phải bản PDO ngắn gọn đã trao đổi; giữ file `config/pdo.php` của chính ZIP (7) để tránh làm hỏng chức năng thật. Chưa chạy kiểm thử MySQL tại máy bạn. Không import SQL lại nếu đang có dữ liệu.

Mở server từ gốc `PhoneStore_PHP_MVC` bằng `php -S localhost:3000` rồi truy cập URL Admin/Client bên trên.
Các trang mẫu dùng dữ liệu mẫu nằm ở `config/sample_data.php`; không nên hiểu là dữ liệu MySQL. Các lệnh POST của các route chưa làm sẽ trả 501.

Các file `giao_dien/` còn giữ nguyên dưới dạng nguồn đối chiếu, nhưng **Router không gọi `demo/render.php`**. Không cần hai Helper cũ với trang MVC mới; trang mẫu dùng hàm trình bày đơn giản trong `config/view_functions.php`.
