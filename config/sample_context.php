<?php
// Data solely for pages whose actual Controller/Model has not yet been connected.
// All sample-data screens should be treated as previews, not live records.
$d=require __DIR__.'/sample_data.php'; extract($d);
function findrow($rows,$id){foreach($rows as $r)if($r['id']==$id)return $r;return $rows[0];}
function by($rows,$key,$val){return array_values(array_filter($rows,fn($r)=>($r[$key]??null)==$val));}
foreach($users as &$u){$u['role_name']=findrow($roles,$u['role_id'])['name'];}unset($u);
foreach($categories as &$c){$c['product_count']=count(by($products,'category_id',$c['id']));}unset($c);
foreach($reviews as &$r){$u=findrow($users,$r['user_id']);$p=findrow($products,$r['product_id']);$r+=['full_name'=>$u['full_name'],'user_name'=>$u['full_name'],'user_email'=>$u['email'],'product_name'=>$p['name'],'product_slug'=>$p['slug'],'product_status'=>$p['status']];}unset($r);
foreach($products as &$p){$c=findrow($categories,$p['category_id']);$vs=by($product_variants,'product_id',$p['id']);usort($vs,fn($a,$b)=>($a['sale_price']??$a['price'])<=>($b['sale_price']??$b['price']));$v=$vs[0];$rs=by($reviews,'product_id',$p['id']);$prices=array_map(fn($v)=>$v['sale_price']??$v['price'],$vs);$p+=['category_name'=>$c['name'],'category_slug'=>$c['slug'],'primary_image'=>by($product_images,'product_id',$p['id'])[0]['image_path'],'display_original_price'=>$v['price'],'display_sale_price'=>$v['sale_price'],'min_effective_price'=>min($prices),'min_price'=>min($prices),'max_price'=>max($prices),'variant_count'=>count($vs),'avg_rating'=>$rs?array_sum(array_column($rs,'rating'))/count($rs):null,'review_count'=>count($rs)];}unset($p);
foreach($orders as &$o){$pay=by($payments,'order_id',$o['id'])[0];$u=findrow($users,$o['user_id']);$a=array_values(array_filter(by($order_assignments,'order_id',$o['id']),fn($x)=>$x['is_active']))[0]??[];$emp=$a?findrow($users,$a['employee_id']):[];$o+=['customer_name'=>$u['full_name'],'customer_email'=>$u['email'],'active_employee_id'=>$emp['id']??null,'active_employee_name'=>$emp['full_name']??null,'active_employee_email'=>$emp['email']??null,'employee_name'=>$emp['full_name']??null,'assigned_at'=>$a['assigned_at']??null,'assigned_by_name'=>'Nguyễn Quản Trị','assignment_note'=>$a['note']??null,'payment_amount'=>$pay['amount'],'payment_confirmed_at'=>$pay['confirmed_at'],'payment_note'=>$pay['note']]+$pay;}unset($o);
foreach($order_details as &$it){$v=findrow($product_variants,$it['variant_id']);$it['product_slug']=findrow($products,$v['product_id'])['slug'];$it['primary_image']=$it['product_image'];}unset($it);
$routes = require __DIR__.'/view_routes.php';
$template = $routes[$route] ?? null;
// Resolve dynamic route patterns for all items, not only demo IDs.
if ($template === null) {
    $patterns = [
      '~^/admin/categories/edit/\d+$~'=>'admin/categories/edit.php',
      '~^/admin/users/(?:detail|edit)/\d+$~'=>'admin/users/detail.php',
      '~^/admin/orders/\d+$~'=>'admin/orders/detail.php',
      '~^/employee/orders/\d+$~'=>'employee/orders/detail.php',
      '~^/admin/variants/edit/\d+$~'=>'admin/variants/edit.php',
      '~^/admin/products/\d+/images$~'=>'admin/products/images.php',
      '~^/admin/products/\d+/variants$~'=>'admin/variants/index.php',
      '~^/product/[a-z0-9-]+$~'=>'client/products/detail.php',
      '~^/category/[a-z0-9-]+$~'=>'client/products/index.php',
      '~^/orders/\d+$~'=>'client/orders/detail.php',
    ];
    foreach ($patterns as $pattern=>$view) if (preg_match($pattern,$route)){ $template=$view; break; }
}
$template ??= 'errors/404.php';$area=explode('/',$template)[0];$id=(int)preg_replace('/\D/','',$route);$last=basename($route);$currentUser=findrow($users,$area==='admin'?1:($area==='employee'?2:4));$GLOBALS['currentUser']=$currentUser;$user=$currentUser;$targetUser=findrow($users,$id?:4);$navCategories=$categories;$activeCategory=null;$selectedCatId=0;$categoryId=0;$keyword=$priceRange=$roleFilter='';$sort='newest';$currentPage=$totalPages=1;$filters=['keyword'=>'','status'=>'','payment_status'=>'','assignment'=>'','rating'=>''];
$category=findrow($categories,$id?:1);if(str_starts_with($route,'/category/')){foreach($categories as $c)if($c['slug']===$last)$activeCategory=$c;$selectedCatId=$activeCategory['id']??0;}
$product=findrow($products,$id?:1);if(str_starts_with($route,'/product/'))foreach($products as $p)if($p['slug']===$last)$product=$p;
$variant=findrow($product_variants,$id?:1);if(str_contains($route,'/variants/edit/'))$product=findrow($products,$variant['product_id']);$images=by($product_images,'product_id',$product['id']);$variants=by($product_variants,'product_id',$product['id']);$ramOptions=array_values(array_unique(array_column($variants,'ram')));$storageOptions=array_values(array_unique(array_column($variants,'storage')));$colorOptions=array_values(array_unique(array_column($variants,'color')));$specsList=[];foreach(explode('|',$product['specifications']) as $line){$pair=explode(':',$line,2);$specsList[]=['label'=>$pair[0],'value'=>trim($pair[1]??'')];}
$relatedProducts=array_slice(array_values(array_filter($products,fn($p)=>$p['id']!==$product['id'])),0,4);$featuredProducts=array_slice(by($products,'is_featured',1),0,4);$newestProducts=array_slice(array_reverse($products),0,4);$bestSellingProducts=array_slice($products,0,4);$promoProducts=array_slice(array_values(array_filter($products,fn($p)=>$p['display_sale_price']!==null)),0,4);$isLoggedIn=true;$canReview=false;$userReview=null;
$order=findrow($orders,$id?:1);$details=by($order_details,'order_id',$order['id']);$employees=by($users,'role_name','employee');$assignmentHistory=by($order_assignments,'order_id',$order['id']);foreach($assignmentHistory as &$a){$e=findrow($users,$a['employee_id']);$a+=['employee_name'=>$e['full_name'],'employee_email'=>$e['email'],'assigned_by_name'=>findrow($users,$a['assigned_by'])['full_name']];}unset($a);$cartItems=$items=[$order_details[0]];$grandTotal=$totalAmount=$items[0]['subtotal'];$latestOrders=$recentOrders=$orders;
$stats=['total_revenue'=>36990000,'total_products'=>count($products),'total_categories'=>count($categories),'total_customers'=>3,'total_employees'=>2,'total_orders'=>count($orders),'total_assigned'=>2,'pending_count'=>1,'confirmed_count'=>1,'shipping_count'=>1,'delivered_count'=>1];$revenueChart=[['order_date'=>'2026-11-15','daily_revenue'=>36990000]];
if($template==='client/products/detail.php'){$reviews=by($reviews,'product_id',$product['id']);$userReview=by($reviews,'user_id',4)[0]??null;$canReview=false;}
if($activeCategory)$products=by($products,'category_id',$selectedCatId);
if($area==='employee')$orders=by($orders,'active_employee_id',2);
if($template==='client/orders/history.php')$orders=by($orders,'user_id',4);
$totalItems=count(match(true){str_contains($template,'categories')=>$categories,str_contains($template,'users')=>$users,str_contains($template,'orders')=>$orders,str_contains($template,'reviews')=>$reviews,default=>$products});
$activeMenu=explode('/',$template)[1];if($activeMenu==='dashboard.php')$activeMenu='dashboard';$message='Trang minh họa lỗi 403';$pageTitle=APP_NAME.' | Demo';
