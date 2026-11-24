<?php
class Product
{
    private $pdo;

    // Nhận kết nối database từ bên ngoài
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Lấy tất cả sản phẩm
    public function getAll()
    {
        $sql = "SELECT
            p.*,
            c.category_name
        FROM products p
        LEFT JOIN categories c
            ON p.category_id = c.category_id
        ORDER BY p.product_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một sản phẩm theo ID
    public function getById($id)
    {
        $sql = "SELECT *
                FROM products
                WHERE product_id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm

    public function getProductList($keyword = "", $categoryId = 0)
    {
        $sql = "SELECT
        p.product_id AS id,
        p.product_name AS name,
        p.brand,
        p.category_id,
        c.category_name,
        p.image_list,
0 AS is_featured,
CASE
    WHEN p.status = 'dang_ban'
    THEN 1 ELSE 0
END AS status,
        COUNT(v.variant_id) AS variant_count,
        MIN(v.sale_price) AS min_price,
        MAX(v.sale_price) AS max_price
    FROM products p
    LEFT JOIN categories c
        ON p.category_id = c.category_id
    LEFT JOIN product_variants v
        ON p.product_id = v.product_id
    WHERE 1 = 1";

        $params = [];

        if ($keyword !== '') {
            $sql .= " AND p.product_name LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }

        if ($categoryId > 0) {
            $sql .= " AND p.category_id = :category_id";
            $params['category_id'] = $categoryId;
        }

        $sql .= " GROUP BY p.product_id, c.category_name
                  ORDER BY p.product_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Lấy danh sách danh mục
    public function getCategories()
    {
        $sql = "SELECT
        category_id AS id,
        category_name AS name
        FROM categories ORDER BY category_name ASC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createWithVariant($product, $variant)
    {
        try {
            // Bắt đầu transaction
            $this->pdo->beginTransaction();

            // 1. Thêm sản phẩm
            $sql = "INSERT INTO products (
                    category_id,
                    product_name,
                    brand,
                    description,
                    image_list,
                    status,
                    list_price,
                    old_price,
                    screen,
                    chip,
                    promotion_label
                ) VALUES (
                    :category_id,
                    :product_name,
                    :brand,
                    :description,
                    :image_list,
                    :status,
                    :list_price,
                    :old_price,
                    :screen,
                    :chip,
                    :promotion_label
                )";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($product);

            // Lấy ID sản phẩm vừa thêm
            $productId = (int) $this->pdo->lastInsertId();

            // 2. Thêm biến thể đầu tiên
            $sqlVariant = "INSERT INTO product_variants (
                            product_id,
                            sku,
                            ram,
                            storage,
                            color,
                            sale_price,
                            stock_quantity,
                            is_on_sale
                       ) VALUES (
                            :product_id,
                            :sku,
                            :ram,
                            :storage,
                            :color,
                            :sale_price,
                            :stock_quantity,
                            :is_on_sale
                       )";

            $stmtVariant = $this->pdo->prepare($sqlVariant);

            $stmtVariant->execute([
                'product_id' => $productId,
                'sku' => $variant['sku'],
                'ram' => $variant['ram'],
                'storage' => $variant['storage'],
                'color' => $variant['color'],
                'sale_price' => $variant['sale_price'],
                'stock_quantity' => $variant['stock_quantity'],
                'is_on_sale' => 1
            ]);

            // Lưu cả sản phẩm và biến thể
            $this->pdo->commit();

            return $productId;
        } catch (Throwable $e) {

            // Nếu xảy ra lỗi, hủy các thay đổi
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $e;
        }
    }

    public function update($id, array $data): void {
        $sql = "UPDATE products SET product_name=?, category_id=?, brand=?, description=?, screen=?, chip=?, list_price=?, old_price=?, promotion_label=?, status=?, image_list=? WHERE product_id=?";
        $s=$this->pdo->prepare($sql);
        $s->execute([$data['product_name'],$data['category_id'],$data['brand'],$data['description'],$data['screen'],$data['chip'],$data['list_price'],$data['old_price'],$data['promotion_label'],$data['status'],$data['image_list'],$id]);
    }
    public function getVariants($productId): array {
        $s=$this->pdo->prepare('SELECT * FROM product_variants WHERE product_id=? ORDER BY variant_id DESC');
        $s->execute([$productId]); return $s->fetchAll(PDO::FETCH_ASSOC);
    }
}
