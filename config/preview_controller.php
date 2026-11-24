<?php
require_once __DIR__.'/view_functions.php';
function renderPreview(string $route): void {
    $root = dirname(__DIR__);
    if (!defined('APP_PATH')) define('APP_PATH', $root.'/view');
    $GLOBALS['prefix'] = '/';
    require __DIR__.'/sample_context.php';
    $file = match($area) {
        'admin' => $root.'/admin/view/'.substr($template,6),
        'employee' => $root.'/employee/view/'.substr($template,9),
        'client' => $root.'/view/client/'.substr($template,7),
        default => $root.'/view/errors/'.substr($template,7),
    };
    if (!is_file($file)) { http_response_code(404); exit('View not found'); }
    if ($area !== 'errors') {
        // Preview-only routes: prevent accidental POSTs into unimplemented actions.
        $pageTitle = 'Giao diện tham khảo | DTD STORE';
        ob_start(); require $file; $content=ob_get_clean();
        $layout=match($area) {
            'admin'=>$root.'/admin/view/layout',
            'employee'=>$root.'/employee/view/layout',
            'client'=>$root.'/view/client/layout'
        };
        require $layout.'/header.php';
        echo '<div class="alert alert-info m-3" role="note">Trang giao diện mẫu — chưa kết nối nghiệp vụ và database thật.</div>';
        echo $content;
        require $layout.'/footer.php';
    } else require $file;
}
