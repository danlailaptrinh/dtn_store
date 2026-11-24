<?php
require_once __DIR__.'/../config/preview_controller.php';
$route=$_GET['route']??'/employee';
if(!is_string($route)){http_response_code(400);exit('Route không hợp lệ');}
if($_SERVER['REQUEST_METHOD']!=='GET'){http_response_code(501);exit('Chức năng chưa kết nối');}
renderPreview($route);
