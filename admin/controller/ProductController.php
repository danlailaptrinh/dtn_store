<?php
require_once __DIR__ . '/../model/Product.php';

class ProductController
{
    private $productModel;

    public function __construct($pdo)
    {
        $this->productModel = new Product($pdo);
    }

    //Lấy dữ liệu cho trang danh sách sản phẩm

    public function listData()
    {
        // Lấy từ khóa tìm kiếm
        $keyword = $_GET['keyword'] ?? '';

        if (!is_string($keyword)) {
            $keyword = '';
        }

        $keyword = trim($keyword);

        // Lấy id danh mục
        $categoryId = filter_var(
            $_GET['category_id'] ?? 0,
            FILTER_VALIDATE_INT
        );

        $categoryId = max(0, (int) $categoryId);

        // Gọi model lấy dữ liệu
        $products = $this->productModel->getProductList(
            $keyword,
            $categoryId
        );

        $categories = $this->productModel->getCategories();

        // Xử lý hình ảnh sản phẩm
        foreach ($products as &$product) {

            $images = json_decode(
                $product['image_list'] ?? '[]',
                true
            );

            $imageList = [];

            if (is_array($images)) {
                $imageList = $images['anh_san_pham'] ?? $images;
            }

            $image = is_array($imageList)
                ? (string) ($imageList[0] ?? '')
                : '';

            // Nếu chỉ lưu tên file thì thêm đường dẫn
            if ($image !== '' && !str_contains($image, '/')) {
                $image = 'assets/images/products/' . $image;
            }

            $product['primary_image'] = $image;
        }

        unset($product);

        // Phân trang
        $perPage = 10;

        $totalItems = count($products);

        $totalPages = max(
            1,
            (int) ceil($totalItems / $perPage)
        );

        $currentPage = filter_var(
            $_GET['page'] ?? 1,
            FILTER_VALIDATE_INT
        );

        $currentPage = ($currentPage !== false && $currentPage > 0)
            ? $currentPage
            : 1;

        $currentPage = min($currentPage, $totalPages);

        // Tính vị trí bắt đầu
        $offset = ($currentPage - 1) * $perPage;

        // Cắt danh sách sản phẩm theo trang
        $products = array_slice(
            $products,
            $offset,
            $perPage
        );

        return compact(
            'products',
            'categories',
            'keyword',
            'categoryId',
            'totalItems',
            'totalPages',
            'currentPage'
        );
    }

    // Hàm kiểm tra Controller
    public function index()
    {
        //Lấy dữ liệu từ model
        $data = $this->listData();

        // Tạo các biến dùng trong View
        extract($data, EXTR_SKIP);

        // Thông tin giao diện Admin
        $pageTitle = 'Quản lý sản phẩm | DTD STORE';
        $activeMenu = 'products';

        // Lấy thông tin người dùng hiện tại
        $currentUser =
            viewGetUser();

        // Nạp Layout
        require __DIR__ . '/../view/layout/header.php';

        // Nạp View danh sách sản phẩm
        require __DIR__ . '/../view/product/index.php';

        // Nạp Footer
        require __DIR__ . '/../view/layout/footer.php';
    }

    //Thêm mới sản phẩm
    public function create()
    {
        // Lấy danh mục từ database thật
        $categories = $this->productModel->getCategories();

        // Thông tin giao diện
        $pageTitle = 'Thêm sản phẩm | DTD STORE';
        $activeMenu = 'products';

        // Thông tin người dùng hiện tại
        $currentUser =
            viewGetUser();

        // Nạp layout chính thức
        require __DIR__ . '/../view/layout/header.php';

        // Nạp giao diện thêm sản phẩm
        require __DIR__ . '/../view/product/create.php';

        // Nạp footer
        require __DIR__ . '/../view/layout/footer.php';
    }


    public function store()
    {
        // Chỉ chấp nhận phương thức POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Phương thức không hợp lệ');
        }

        // Kiểm tra CSRF
        if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], (string)($_POST['csrf_token'] ?? ''))) {
            http_response_code(403);
            exit('CSRF Token không hợp lệ');
        }

        // Lấy dữ liệu sản phẩm
        $productName = trim($_POST['product_name'] ?? '');
        $categoryId = filter_var(
            $_POST['category_id'] ?? null,
            FILTER_VALIDATE_INT
        );
        $brand = trim($_POST['brand'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $screen = trim($_POST['screen'] ?? '');
        $chip = trim($_POST['chip'] ?? '');
        $promotionLabel = trim($_POST['promotion_label'] ?? '');

        $status = $_POST['status'] ?? 'dang_ban';

        $listPrice = $_POST['list_price'] ?? '';
        $oldPrice = $_POST['old_price'] ?? '';

        // Lấy dữ liệu biến thể
        $sku = trim($_POST['init_sku'] ?? '');
        $color = trim($_POST['init_color'] ?? '');

        $ram = filter_var(
            $_POST['init_ram'] ?? null,
            FILTER_VALIDATE_INT
        );

        $storage = filter_var(
            $_POST['init_storage'] ?? null,
            FILTER_VALIDATE_INT
        );

        $stock = filter_var(
            $_POST['init_stock'] ?? null,
            FILTER_VALIDATE_INT
        );

        $salePrice = $_POST['init_sale_price'] ?? '';

        // Kiểm tra dữ liệu bắt buộc
        if (
            $productName === '' ||
            $categoryId === false ||
            $categoryId <= 0 ||
            $brand === '' ||
            $sku === '' ||
            $color === '' ||
            $ram === false ||
            $ram < 0 ||
            $storage === false ||
            $storage <= 0 ||
            $stock === false ||
            $stock < 0 ||
            $salePrice === '' ||
            !is_numeric($salePrice) ||
            (float)$salePrice < 0
        ) {
            http_response_code(400);
            exit('Vui lòng nhập đầy đủ thông tin sản phẩm và biến thể hợp lệ');
        }

        // Kiểm tra giá
        foreach ([$listPrice, $oldPrice] as $price) {
            if (
                $price !== '' &&
                (!is_numeric($price) || (float)$price < 0)
            ) {
                http_response_code(400);
                exit('Giá sản phẩm không hợp lệ');
            }
        }

        // Kiểm tra trạng thái
        if (!in_array(
            $status,
            ['dang_ban', 'ngung_ban'],
            true
        )) {
            http_response_code(400);
            exit('Trạng thái không hợp lệ');
        }

        // Kiểm tra danh mục có tồn tại
        $categories = $this->productModel->getCategories();
        $validIds = array_map(
            'intval',
            array_column($categories, 'id')
        );

        if (!in_array($categoryId, $validIds, true)) {
            http_response_code(400);
            exit('Danh mục không tồn tại');
        }

        // Chuẩn bị dữ liệu bảng products
        $product = [
            'category_id' => $categoryId,
            'product_name' => $productName,
            'brand' => $brand,
            'description' => $description,

            // Ảnh sẽ xử lý ở bước tiếp theo
            'image_list' => json_encode([]),

            'status' => $status,
            'list_price' => $listPrice === ''
                ? null : $listPrice,
            'old_price' => $oldPrice === ''
                ? null : $oldPrice,
            'screen' => $screen,
            'chip' => $chip,
            'promotion_label' => $promotionLabel
        ];

        // Chuẩn bị dữ liệu bảng product_variants
        $variant = [
            'sku' => $sku,
            'ram' => $ram,
            'storage' => $storage,
            'color' => $color,
            'sale_price' => $salePrice,
            'stock_quantity' => $stock
        ];


        $savedImages = [];

        try {
            // Upload ảnh sản phẩm
            $savedImages = $this->uploadProductImages();

            // Lưu đường dẫn ảnh dưới dạng JSON
            $product['image_list'] = json_encode(
                $savedImages,
                JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            );

            // Lưu sản phẩm và biến thể
            $productId = $this->productModel
                ->createWithVariant($product, $variant);

            // Chuyển về danh sách
            header(
                'Location: /admin/index.php?route=/admin/products&success=created',
                true,
                303
            );
            exit;

            exit;
        } catch (\Throwable $e) {

            // Xóa ảnh nếu lưu database thất bại
            foreach ($savedImages as $path) {
                $fullPath = dirname(__DIR__, 2) . '/' . $path;

                if (is_file($fullPath)) {
                    unlink($fullPath);
                }
            }

            error_log($e->getMessage());

            http_response_code(500);
            exit('Không thể lưu sản phẩm. Kiểm tra dữ liệu hoặc file ảnh.');
        }
    }




    private function uploadProductImages(): array
    {
        $savedPaths = [];

        if (!isset($_FILES['images'])) {
            return [];
        }

        $files = $_FILES['images'];

        if (!is_array($files['error'])) {
            throw new \RuntimeException('Dữ liệu upload không hợp lệ');
        }

        $uploadDir = dirname(__DIR__, 2)
            . '/assets/uploads/products/';

        if (
            !is_dir($uploadDir) &&
            !mkdir($uploadDir, 0755, true) &&
            !is_dir($uploadDir)
        ) {
            throw new \RuntimeException('Không tạo được thư mục ảnh');
        }

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
        ];

        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        try {
            foreach ($files['error'] as $i => $error) {

                if ($error === UPLOAD_ERR_NO_FILE) {
                    continue;
                }

                if ($error !== UPLOAD_ERR_OK) {
                    throw new \RuntimeException('Lỗi upload ảnh');
                }

                $tmpName = $files['tmp_name'][$i];
                $size = $files['size'][$i];

                if ($size <= 0 || $size > 5 * 1024 * 1024) {
                    throw new \RuntimeException('Ảnh tối đa 5MB');
                }

                if (!is_uploaded_file($tmpName)) {
                    throw new \RuntimeException('File không hợp lệ');
                }

                $mime = $finfo->file($tmpName);

                if (!isset($allowedTypes[$mime])) {
                    throw new \RuntimeException('Định dạng ảnh không hỗ trợ');
                }

                $fileName = bin2hex(random_bytes(16))
                    . '.' . $allowedTypes[$mime];

                $destination = $uploadDir . $fileName;

                if (!move_uploaded_file($tmpName, $destination)) {
                    throw new \RuntimeException('Không lưu được ảnh');
                }

                $savedPaths[] = 'assets/uploads/products/' . $fileName;
            }

            return $savedPaths;
        } catch (\Throwable $e) {
            foreach ($savedPaths as $path) {
                $fullPath = dirname(__DIR__, 2) . '/' . $path;

                if (is_file($fullPath)) {
                    unlink($fullPath);
                }
            }

            throw $e;
        }
    }

    public function edit(int $id): void {
        $product=$this->productModel->getById($id);
        if (!$product) { http_response_code(404); exit('Không tìm thấy sản phẩm'); }
        $categories=$this->productModel->getCategories();
        $images=json_decode($product['image_list']??'[]',true);
        $images=is_array($images)?($images['anh_san_pham']??$images):[];
        $pageTitle='Sửa sản phẩm | DTD STORE'; $activeMenu='products';
        require __DIR__.'/../view/layout/header.php';
        require __DIR__.'/../view/product/edit.php';
        require __DIR__.'/../view/layout/footer.php';
    }
    public function update(int $id): void {
        if ($_SERVER['REQUEST_METHOD']!=='POST') {http_response_code(405);exit('Chỉ cho phép POST');}
        if (!hash_equals($_SESSION['csrf_token']??'',(string)($_POST['csrf_token']??'')) || empty($_SESSION['csrf_token'])) {http_response_code(403);exit('CSRF không hợp lệ');}
        $old=$this->productModel->getById($id);
        if (!$old) {http_response_code(404);exit('Không tìm thấy sản phẩm');}
        $data=[];
        foreach (['product_name','brand','description','screen','chip','promotion_label','status'] as $field) $data[$field]=trim((string)($_POST[$field]??''));
        $data['category_id']=filter_var($_POST['category_id']??null,FILTER_VALIDATE_INT);
        $data['list_price']=($_POST['list_price']??'')===''?null:$_POST['list_price'];
        $data['old_price']=($_POST['old_price']??'')===''?null:$_POST['old_price'];
        if (!$data['product_name'] || !$data['brand'] || !$data['category_id'] || !in_array($data['status'],['dang_ban','ngung_ban'],true)) {http_response_code(400);exit('Thông tin không hợp lệ');}
        foreach(['list_price','old_price'] as $field) if ($data[$field]!==null && (!is_numeric($data[$field]) || (float)$data[$field]<0)){http_response_code(400);exit('Giá không hợp lệ');}
        $catIds=array_map('intval',array_column($this->productModel->getCategories(),'id'));
        if(!in_array((int)$data['category_id'],$catIds,true)){http_response_code(400);exit('Danh mục không hợp lệ');}
        $oldImages=json_decode($old['image_list']??'[]',true);
        $oldImages=is_array($oldImages)?($oldImages['anh_san_pham']??$oldImages):[];
        $remove=$_POST['delete_images']??[]; if(!is_array($remove))$remove=[];
        $remove=array_values(array_intersect($oldImages,$remove));
        $added=[];
        try {
            $added=$this->uploadProductImages();
            $remaining=array_values(array_diff($oldImages,$remove));
            $data['image_list']=json_encode(array_merge($remaining,$added),JSON_UNESCAPED_SLASHES|JSON_THROW_ON_ERROR);
            $this->productModel->update($id,$data);
            // Do not delete files physically here: another product may share a path.
            header('Location: /admin/index.php?route=/admin/products&success=updated',true,303);exit;
        } catch (Throwable $e) {
            foreach ($added as $path) { $file=dirname(__DIR__,2).'/'.$path; if (is_file($file))unlink($file); }
            error_log($e->getMessage()); http_response_code(500);exit('Không cập nhật được sản phẩm');
        }
    }
}
