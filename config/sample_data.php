<?php
return ['roles' => [
['id' => 1, 'name' => 'admin', 'description' => 'Quản trị viên toàn quyền hệ thống DTD STORE'],
['id' => 2, 'name' => 'employee', 'description' => 'Nhân viên xử lý đơn hàng được phân công'],
['id' => 3, 'name' => 'customer', 'description' => 'Khách hàng mua sắm']
], 'users' => [
['id' => 1, 'role_id' => 1, 'full_name' => 'Nguyễn Quản Trị', 'email' => 'admin@dtdstore.vn', 'phone' => '0901000001', 'address' => '123 Nguyễn Văn Cừ, Quận 5, TP.HCM', 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 2, 'role_id' => 2, 'full_name' => 'Trần Nhân Viên A', 'email' => 'nv1@dtdstore.vn', 'phone' => '0902000001', 'address' => '45 Lê Lợi, Quận 1, TP.HCM', 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 3, 'role_id' => 2, 'full_name' => 'Lê Nhân Viên B', 'email' => 'nv2@dtdstore.vn', 'phone' => '0902000002', 'address' => '78 Cách Mạng Tháng 8, Quận 3, TP.HCM', 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 4, 'role_id' => 3, 'full_name' => 'Phạm Minh Tuấn', 'email' => 'khach1@gmail.com', 'phone' => '0911111111', 'address' => '102 Lý Thường Kiệt, Quận 10, TP.HCM', 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 5, 'role_id' => 3, 'full_name' => 'Hoàng Thảo Vy', 'email' => 'khach2@gmail.com', 'phone' => '0922222222', 'address' => '56 Võ Văn Ngân, TP. Thủ Đức, TP.HCM', 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 6, 'role_id' => 3, 'full_name' => 'Đặng Quốc Bảo', 'email' => 'khach3@gmail.com', 'phone' => '0933333333', 'address' => '19 Hai Bà Trưng, Quận Hoàn Kiếm, Hà Nội', 'status' => 1, 'created_at' => '2026-11-15 09:30:00']
], 'categories' => [
['id' => 1, 'name' => 'iPhone', 'slug' => 'iphone', 'description' => 'Điện thoại thông minh Apple iPhone chính hãng VN/A', 'status' => 1],
['id' => 2, 'name' => 'Samsung', 'slug' => 'samsung', 'description' => 'Điện thoại Samsung Galaxy chính hãng', 'status' => 1],
['id' => 3, 'name' => 'Xiaomi', 'slug' => 'xiaomi', 'description' => 'Điện thoại Xiaomi hiệu năng cao, camera Leica', 'status' => 1],
['id' => 4, 'name' => 'OPPO', 'slug' => 'oppo', 'description' => 'Điện thoại OPPO thiết kế mỏng nhẹ, camera chân dung', 'status' => 1],
['id' => 5, 'name' => 'Vivo', 'slug' => 'vivo', 'description' => 'Điện thoại Vivo chụp ảnh chuyên nghiệp ZEISS', 'status' => 1],
['id' => 6, 'name' => 'Realme', 'slug' => 'realme', 'description' => 'Điện thoại Realme cấu hình mạnh, giá tốt', 'status' => 1]
], 'products' => [
['id' => 1, 'category_id' => 1, 'name' => 'iPhone 17 Pro Max', 'slug' => 'iphone-17-pro-max', 'description' => 'iPhone 17 Pro Max sở hữu khung nhôm nguyên khối rèn nhiệt thế hệ mới, chip A19 Pro siêu mạnh mẽ và hệ thống camera Pro Fusion 48MP zoom quang học 8x.', 'specifications' => 'Màn hình: 6.9 inch Super Retina XDR OLED 120Hz|Chip: Apple A19 Pro|Camera sau: 3 x 48MP Pro Fusion|Camera trước: 18MP Center Stage|Pin & Sạc: Cả ngày, USB-C sạc nhanh|Hệ điều hành: iOS', 'is_featured' => 1, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 2, 'category_id' => 1, 'name' => 'iPhone 16 Pro', 'slug' => 'iphone-16-pro', 'description' => 'iPhone 16 Pro thiết kế Titan bền bỉ, nút Điều khiển Camera chuyên dụng, quay video 4K 120fps Dolby Vision và hiệu năng đỉnh cao với chip A18 Pro.', 'specifications' => 'Màn hình: 6.3 inch Super Retina XDR OLED 120Hz|Chip: Apple A18 Pro|Camera sau: 48MP + 48MP + 12MP|Camera trước: 12MP|Pin & Sạc: Sạc nhanh 25W MagSafe, USB-C|Hệ điều hành: iOS', 'is_featured' => 1, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 3, 'category_id' => 2, 'name' => 'Samsung Galaxy S25 Ultra', 'slug' => 'samsung-galaxy-s25-ultra', 'description' => 'Flagship cao cấp nhất của Samsung tích hợp Galaxy AI toàn diện, bút S Pen tiện lợi, khung viền Titanium và chip Snapdragon 8 Elite for Galaxy.', 'specifications' => 'Màn hình: 6.9 inch Dynamic AMOLED 2X QHD+ 120Hz|Chip: Snapdragon 8 Elite for Galaxy|Camera sau: 200MP + 50MP + 50MP + 10MP|Camera trước: 12MP|Pin & Sạc: 5000mAh, sạc nhanh 45W|Hệ điều hành: Android 15 (One UI 7)', 'is_featured' => 1, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 4, 'category_id' => 2, 'name' => 'Samsung Galaxy S25', 'slug' => 'samsung-galaxy-s25', 'description' => 'Samsung Galaxy S25 nhỏ gọn, sang trọng, màn hình 120Hz siêu sáng, 12GB RAM mặc định tối ưu mượt mà cho các tác vụ Galaxy AI.', 'specifications' => 'Màn hình: 6.2 inch Dynamic AMOLED 2X FHD+ 120Hz|Chip: Snapdragon 8 Elite for Galaxy|Camera sau: 50MP + 12MP + 10MP|Camera trước: 12MP|Pin & Sạc: 4000mAh, sạc nhanh 25W|Hệ điều hành: Android 15 (One UI 7)', 'is_featured' => 0, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 5, 'category_id' => 3, 'name' => 'Xiaomi 15 Pro', 'slug' => 'xiaomi-15-pro', 'description' => 'Xiaomi 15 Pro hợp tác cùng Leica mang đến chất ảnh nghệ thuật, viên pin silicon-carbon dung lượng lớn 6100mAh và màn hình LTPO 2K sắc nét.', 'specifications' => 'Màn hình: 6.73 inch AMOLED LTPO 2K 120Hz|Chip: Snapdragon 8 Elite|Camera sau: 3 x 50MP Leica Summilux|Camera trước: 32MP|Pin & Sạc: 6100mAh, sạc nhanh 90W|Hệ điều hành: HyperOS 2', 'is_featured' => 1, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 6, 'category_id' => 4, 'name' => 'OPPO Find X8 Pro', 'slug' => 'oppo-find-x8-pro', 'description' => 'OPPO Find X8 Pro nổi bật với hệ thống camera tele kép Hasselblad, thiết kế mặt lưng kính cong tinh tế và thời lượng pin ấn tượng.', 'specifications' => 'Màn hình: 6.78 inch AMOLED LTPO 120Hz|Chip: Dimensity 9400|Camera sau: 4 x 50MP Hasselblad|Camera trước: 32MP|Pin & Sạc: 5910mAh, sạc nhanh SuperVOOC 80W|Hệ điều hành: ColorOS 15', 'is_featured' => 0, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 7, 'category_id' => 5, 'name' => 'Vivo X200 Pro', 'slug' => 'vivo-x200-pro', 'description' => 'Vivo X200 Pro trang bị ống kính tele ZEISS APO 200MP cho khả năng chụp chân dung và zoom xa vượt trội trong mọi điều kiện ánh sáng.', 'specifications' => 'Màn hình: 6.78 inch AMOLED 120Hz|Chip: Dimensity 9400|Camera sau: 50MP + 200MP ZEISS APO + 50MP|Camera trước: 32MP|Pin & Sạc: 6000mAh, sạc nhanh 90W|Hệ điều hành: Funtouch OS 15', 'is_featured' => 0, 'status' => 1, 'created_at' => '2026-11-15 09:30:00'],
['id' => 8, 'category_id' => 6, 'name' => 'Realme GT 7 Pro', 'slug' => 'realme-gt-7-pro', 'description' => 'Realme GT 7 Pro chiến game đỉnh cao với Snapdragon 8 Elite, hệ thống tản nhiệt buồng hơi kép và pin Titan 6500mAh sạc siêu nhanh 120W.', 'specifications' => 'Màn hình: 6.78 inch Eco2 OLED Plus 120Hz|Chip: Snapdragon 8 Elite|Camera sau: 50MP + 50MP + 8MP|Camera trước: 16MP|Pin & Sạc: 6500mAh, sạc nhanh 120W|Hệ điều hành: realme UI 6.0', 'is_featured' => 0, 'status' => 1, 'created_at' => '2026-11-15 09:30:00']
], 'product_images' => [
['product_id' => 1, 'image_path' => 'assets/images/products/iphone-17-pro-max-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 1],
['product_id' => 1, 'image_path' => 'assets/images/products/iphone-17-pro-max-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 2],
['product_id' => 2, 'image_path' => 'assets/images/products/iphone-16-pro-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 3],
['product_id' => 2, 'image_path' => 'assets/images/products/iphone-16-pro-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 4],
['product_id' => 3, 'image_path' => 'assets/images/products/galaxy-s25-ultra-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 5],
['product_id' => 3, 'image_path' => 'assets/images/products/galaxy-s25-ultra-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 6],
['product_id' => 4, 'image_path' => 'assets/images/products/galaxy-s25-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 7],
['product_id' => 4, 'image_path' => 'assets/images/products/galaxy-s25-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 8],
['product_id' => 5, 'image_path' => 'assets/images/products/xiaomi-15-pro-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 9],
['product_id' => 5, 'image_path' => 'assets/images/products/xiaomi-15-pro-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 10],
['product_id' => 6, 'image_path' => 'assets/images/products/oppo-find-x8-pro-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 11],
['product_id' => 6, 'image_path' => 'assets/images/products/oppo-find-x8-pro-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 12],
['product_id' => 7, 'image_path' => 'assets/images/products/vivo-x200-pro-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 13],
['product_id' => 7, 'image_path' => 'assets/images/products/vivo-x200-pro-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 14],
['product_id' => 8, 'image_path' => 'assets/images/products/realme-gt-7-pro-1.jpg', 'is_primary' => 1, 'sort_order' => 1, 'id' => 15],
['product_id' => 8, 'image_path' => 'assets/images/products/realme-gt-7-pro-2.jpg', 'is_primary' => 0, 'sort_order' => 2, 'id' => 16]
], 'product_variants' => [
['id' => 1, 'product_id' => 1, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Cam Vũ Trụ', 'price' => 37990000, 'sale_price' => 36990000, 'status' => 1],
['id' => 2, 'product_id' => 1, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Bạc', 'price' => 37990000, 'sale_price' => 36990000, 'status' => 1],
['id' => 3, 'product_id' => 1, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Cam Vũ Trụ', 'price' => 44490000, 'sale_price' => 43490000, 'status' => 1],
['id' => 4, 'product_id' => 1, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Bạc', 'price' => 44490000, 'sale_price' => 43490000, 'status' => 1],
['id' => 5, 'product_id' => 1, 'ram' => '12GB', 'storage' => '1TB', 'color' => 'Cam Vũ Trụ', 'price' => 50990000, 'sale_price' => null, 'status' => 1],
['id' => 6, 'product_id' => 2, 'ram' => '8GB', 'storage' => '128GB', 'color' => 'Titan Sa Mạc', 'price' => 28990000, 'sale_price' => 26490000, 'status' => 1],
['id' => 7, 'product_id' => 2, 'ram' => '8GB', 'storage' => '128GB', 'color' => 'Titan Đen', 'price' => 28990000, 'sale_price' => 26490000, 'status' => 1],
['id' => 8, 'product_id' => 2, 'ram' => '8GB', 'storage' => '256GB', 'color' => 'Titan Sa Mạc', 'price' => 31990000, 'sale_price' => 29490000, 'status' => 1],
['id' => 9, 'product_id' => 2, 'ram' => '8GB', 'storage' => '256GB', 'color' => 'Titan Trắng', 'price' => 31990000, 'sale_price' => 29490000, 'status' => 1],
['id' => 10, 'product_id' => 3, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Xám Titan', 'price' => 33990000, 'sale_price' => 30990000, 'status' => 1],
['id' => 11, 'product_id' => 3, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Đen Titan', 'price' => 33990000, 'sale_price' => 30990000, 'status' => 1],
['id' => 12, 'product_id' => 3, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Xám Titan', 'price' => 37490000, 'sale_price' => 34490000, 'status' => 1],
['id' => 13, 'product_id' => 3, 'ram' => '12GB', 'storage' => '1TB', 'color' => 'Đen Titan', 'price' => 44790000, 'sale_price' => null, 'status' => 1],
['id' => 14, 'product_id' => 4, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Đen', 'price' => 22990000, 'sale_price' => 20990000, 'status' => 1],
['id' => 15, 'product_id' => 4, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Xanh', 'price' => 22990000, 'sale_price' => 20990000, 'status' => 1],
['id' => 16, 'product_id' => 4, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Đen', 'price' => 26490000, 'sale_price' => null, 'status' => 1],
['id' => 17, 'product_id' => 4, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Xanh', 'price' => 26490000, 'sale_price' => null, 'status' => 1],
['id' => 18, 'product_id' => 5, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Đen', 'price' => 22990000, 'sale_price' => 21490000, 'status' => 1],
['id' => 19, 'product_id' => 5, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Xanh', 'price' => 22990000, 'sale_price' => 21490000, 'status' => 1],
['id' => 20, 'product_id' => 5, 'ram' => '16GB', 'storage' => '512GB', 'color' => 'Bạc', 'price' => 25990000, 'sale_price' => 24490000, 'status' => 1],
['id' => 21, 'product_id' => 6, 'ram' => '16GB', 'storage' => '512GB', 'color' => 'Đen', 'price' => 29990000, 'sale_price' => 27990000, 'status' => 1],
['id' => 22, 'product_id' => 6, 'ram' => '16GB', 'storage' => '512GB', 'color' => 'Trắng', 'price' => 29990000, 'sale_price' => 27990000, 'status' => 1],
['id' => 23, 'product_id' => 7, 'ram' => '16GB', 'storage' => '512GB', 'color' => 'Xanh', 'price' => 28990000, 'sale_price' => null, 'status' => 1],
['id' => 24, 'product_id' => 7, 'ram' => '16GB', 'storage' => '512GB', 'color' => 'Xám', 'price' => 28990000, 'sale_price' => null, 'status' => 1],
['id' => 25, 'product_id' => 8, 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Cam', 'price' => 19990000, 'sale_price' => 18490000, 'status' => 1],
['id' => 26, 'product_id' => 8, 'ram' => '12GB', 'storage' => '512GB', 'color' => 'Xám', 'price' => 21990000, 'sale_price' => 20490000, 'status' => 1]
], 'orders' => [
['id' => 1, 'order_code' => 'DTD2026111501', 'user_id' => 4, 'receiver_name' => 'Phạm Minh Tuấn', 'receiver_phone' => '0911111111', 'shipping_address' => '102 Lý Thường Kiệt, Quận 10, TP.HCM', 'note' => 'Giao giờ hành chính', 'total_amount' => 36990000, 'status' => 'delivered', 'created_at' => '2026-11-15 09:30:00'],
['id' => 2, 'order_code' => 'DTD2026111601', 'user_id' => 5, 'receiver_name' => 'Hoàng Thảo Vy', 'receiver_phone' => '0922222222', 'shipping_address' => '56 Võ Văn Ngân, TP. Thủ Đức, TP.HCM', 'note' => 'Gọi trước khi giao 15 phút', 'total_amount' => 51980000, 'status' => 'shipping', 'created_at' => '2026-11-16 14:15:00'],
['id' => 3, 'order_code' => 'DTD2026111701', 'user_id' => 4, 'receiver_name' => 'Phạm Minh Tuấn', 'receiver_phone' => '0911111111', 'shipping_address' => '102 Lý Thường Kiệt, Quận 10, TP.HCM', 'note' => 'Kiểm tra nguyên seal khi nhận', 'total_amount' => 21490000, 'status' => 'confirmed', 'created_at' => '2026-11-17 10:05:00'],
['id' => 4, 'order_code' => 'DTD2026111702', 'user_id' => 6, 'receiver_name' => 'Đặng Quốc Bảo', 'receiver_phone' => '0933333333', 'shipping_address' => '19 Hai Bà Trưng, Quận Hoàn Kiếm, Hà Nội', 'note' => null, 'total_amount' => 18490000, 'status' => 'pending', 'created_at' => '2026-11-17 16:40:00']
], 'order_details' => [
['order_id' => 1, 'variant_id' => 1, 'product_name' => 'iPhone 17 Pro Max', 'category_name' => 'iPhone', 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Cam Vũ Trụ', 'product_image' => 'assets/images/products/iphone-17-pro-max-1.jpg', 'unit_price' => 36990000, 'quantity' => 1, 'subtotal' => 36990000, 'id' => 1],
['order_id' => 2, 'variant_id' => 10, 'product_name' => 'Samsung Galaxy S25 Ultra', 'category_name' => 'Samsung', 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Xám Titan', 'product_image' => 'assets/images/products/galaxy-s25-ultra-1.jpg', 'unit_price' => 30990000, 'quantity' => 1, 'subtotal' => 30990000, 'id' => 2],
['order_id' => 2, 'variant_id' => 14, 'product_name' => 'Samsung Galaxy S25', 'category_name' => 'Samsung', 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Đen', 'product_image' => 'assets/images/products/galaxy-s25-1.jpg', 'unit_price' => 20990000, 'quantity' => 1, 'subtotal' => 20990000, 'id' => 3],
['order_id' => 3, 'variant_id' => 18, 'product_name' => 'Xiaomi 15 Pro', 'category_name' => 'Xiaomi', 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Đen', 'product_image' => 'assets/images/products/xiaomi-15-pro-1.jpg', 'unit_price' => 21490000, 'quantity' => 1, 'subtotal' => 21490000, 'id' => 4],
['order_id' => 4, 'variant_id' => 25, 'product_name' => 'Realme GT 7 Pro', 'category_name' => 'Realme', 'ram' => '12GB', 'storage' => '256GB', 'color' => 'Cam', 'product_image' => 'assets/images/products/realme-gt-7-pro-1.jpg', 'unit_price' => 18490000, 'quantity' => 1, 'subtotal' => 18490000, 'id' => 5]
], 'order_assignments' => [
['order_id' => 1, 'employee_id' => 2, 'assigned_by' => 1, 'is_active' => 1, 'note' => 'Giao nhân viên A xử lý', 'assigned_at' => '2026-11-15 10:00:00', 'unassigned_at' => null, 'id' => 1],
['order_id' => 2, 'employee_id' => 2, 'assigned_by' => 1, 'is_active' => null, 'note' => 'Phân công ban đầu cho nhân viên A', 'assigned_at' => '2026-11-16 14:30:00', 'unassigned_at' => '2026-11-16 15:00:00', 'id' => 2],
['order_id' => 2, 'employee_id' => 3, 'assigned_by' => 1, 'is_active' => 1, 'note' => 'Chuyển sang nhân viên B phụ trách khu Thủ Đức', 'assigned_at' => '2026-11-16 15:00:00', 'unassigned_at' => null, 'id' => 3],
['order_id' => 3, 'employee_id' => 2, 'assigned_by' => 1, 'is_active' => 1, 'note' => 'Giao nhân viên A phụ trách', 'assigned_at' => '2026-11-17 10:20:00', 'unassigned_at' => null, 'id' => 4]
], 'payments' => [
['order_id' => 1, 'payment_method' => 'cod', 'payment_status' => 'paid', 'amount' => 36990000, 'transfer_content' => null, 'is_simulated' => 0, 'confirmed_at' => '2026-11-15 16:20:00', 'note' => 'Khách đã thanh toán tiền mặt khi nhận hàng', 'id' => 1],
['order_id' => 2, 'payment_method' => 'qr_simulation', 'payment_status' => 'simulated_confirmed', 'amount' => 51980000, 'transfer_content' => 'DTDSTORE DTD2026111601', 'is_simulated' => 1, 'confirmed_at' => '2026-11-16 14:18:00', 'note' => 'Khách đã bấm xác nhận thanh toán QR mô phỏng', 'id' => 2],
['order_id' => 3, 'payment_method' => 'cod', 'payment_status' => 'unpaid', 'amount' => 21490000, 'transfer_content' => null, 'is_simulated' => 0, 'confirmed_at' => null, 'note' => 'Thanh toán khi nhận hàng (chưa thu tiền)', 'id' => 3],
['order_id' => 4, 'payment_method' => 'qr_simulation', 'payment_status' => 'unpaid', 'amount' => 18490000, 'transfer_content' => 'DTDSTORE DTD2026111702', 'is_simulated' => 1, 'confirmed_at' => null, 'note' => 'Đơn QR mô phỏng mới tạo, khách chưa xác nhận', 'id' => 4]
], 'reviews' => [
['product_id' => 1, 'user_id' => 4, 'rating' => 5, 'comment' => 'Máy iPhone 17 Pro Max màu Cam Vũ Trụ rất đẹp, giao hàng nhanh và đóng gói cẩn thận.', 'status' => 1, 'id' => 1, 'created_at' => '2026-11-15 09:30:00']
]];
