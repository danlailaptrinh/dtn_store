<?php
class ProductVariant {
    private PDO $pdo;
    public function __construct(PDO $pdo) {$this->pdo=$pdo;}
    public function getByProductId(int $id): array {
        $s=$this->pdo->prepare('SELECT * FROM product_variants WHERE product_id=? ORDER BY variant_id DESC');
        $s->execute([$id]); return $s->fetchAll(PDO::FETCH_ASSOC);
    }
}
