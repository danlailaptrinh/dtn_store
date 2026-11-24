<?php
require_once __DIR__.'/../config/view_functions.php';
$route=$_GET['route']??'/admin';
if(!is_string($route)){http_response_code(400);exit('Route không hợp lệ');}
if (preg_match('~^/admin/products(?:$|/(?:create|store|edit/[1-9][0-9]*|update/[1-9][0-9]*|[1-9][0-9]*/variants)$)~',$route)) {
    require_once __DIR__.'/../config/pdo.php';
    require_once __DIR__.'/controller/ProductController.php';
    $controller=new ProductController($pdo);
    if($route==='/admin/products') $controller->index();
    elseif($route==='/admin/products/create') $controller->create();
    elseif($route==='/admin/products/store') $controller->store();
    elseif(preg_match('~^/admin/products/edit/(\d+)$~',$route,$m)) $controller->edit((int)$m[1]);
    elseif(preg_match('~^/admin/products/update/(\d+)$~',$route,$m)) $controller->update((int)$m[1]);
    elseif(preg_match('~^/admin/products/(\d+)/variants$~',$route,$m)) {
        require_once __DIR__.'/controller/ProductVariantController.php';
        (new ProductVariantController($pdo))->index((int)$m[1]);
    }
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'GET') { http_response_code(501);exit('Chức năng đang phát triển'); }
require __DIR__.'/../config/preview_controller.php';
renderPreview($route);
