<?php
// Small presentation functions. No SecurityHelper/SessionHelper classes.
if (session_status() === PHP_SESSION_NONE) session_start();
if (!defined('APP_NAME')) define('APP_NAME', 'DTD STORE');
function viewE($x): string {return htmlspecialchars((string)($x??''), ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
function viewUrl(string $route='/'): string {
    $path = str_starts_with($route,'/admin') ? '/admin/index.php' : (str_starts_with($route,'/employee') ? '/employee/index.php' : '/index.php');
    return $path . '?route=' . rawurlencode($route);
}
function viewAsset(string $path): string {return '/assets/'.ltrim($path,'/');}
function viewImage(?string $path): string {
    if (!$path) return '/assets/images/no-image.svg';
    $path = ltrim($path, '/');
    if (!preg_match('~^(assets/|uploads/)[a-zA-Z0-9/_(). -]+\.(png|jpe?g|webp|gif|svg)$~i',$path)) return '/assets/images/no-image.svg';
    return file_exists(dirname(__DIR__).'/'.$path)?'/'.$path:'/assets/images/no-image.svg';
}
function viewPrice($n): string {return number_format((float)($n??0),0,',','.').'₫';}
function viewCsrfToken(): string {return $_SESSION['csrf_token']??($_SESSION['csrf_token']=bin2hex(random_bytes(32)));}
function viewCsrfField(): string {return '<input type="hidden" name="csrf_token" value="'.viewE(viewCsrfToken()).'">';}
function viewGetUser(): ?array {return $GLOBALS['currentUser']??null;}
function viewGetFlash(): ?array {return null;}
function viewCartCount(): int {return 0;}
function viewOrderStatusBadge(string $s): array {return match($s){'pending'=>['label'=>'Chờ xác nhận','class'=>'bg-warning text-dark'],'confirmed'=>['label'=>'Đã xác nhận','class'=>'bg-info text-dark'],'shipping'=>['label'=>'Đang giao','class'=>'bg-primary'],'delivered'=>['label'=>'Đã giao','class'=>'bg-success'],'cancelled'=>['label'=>'Đã hủy','class'=>'bg-danger'],default=>['label'=>$s,'class'=>'bg-secondary']};}
function viewPaymentStatusBadge(string $s): array {return ['label'=>$s,'class'=>'bg-secondary'];}
