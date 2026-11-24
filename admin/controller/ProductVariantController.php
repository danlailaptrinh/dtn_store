<?php
require_once __DIR__.'/../model/Product.php';
require_once __DIR__.'/../model/ProductVariant.php';
class ProductVariantController {
    private Product $products;
    private ProductVariant $variants;
    public function __construct(PDO $pdo){$this->products=new Product($pdo);$this->variants=new ProductVariant($pdo);}
    public function index(int $id): void {
        $product=$this->products->getById($id);
        if (!$product){http_response_code(404);exit('Không tìm thấy sản phẩm');}
        $variants=$this->variants->getByProductId($id);
        $activeMenu='products';$pageTitle='Quản lý biến thể | DTD STORE';
        require __DIR__.'/../view/layout/header.php';
        require __DIR__.'/../view/variants/index.php';
        require __DIR__.'/../view/layout/footer.php';
    }
}
