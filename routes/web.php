<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
Use App\Http\Controllers\Backend\Brand\BrandController;
Use App\Http\Controllers\Backend\Category\CategoryController;
Use App\Http\Controllers\Backend\SubCategory\SubCategoryController;
Use App\Http\Controllers\Backend\Vendor\ActiveInactiveVendorController;
Use App\Http\Controllers\Backend\Product\ProductController;
Use App\Http\Controllers\Backend\Product\VendorProductController;
use App\Http\Middleware\RedirectIfAuthenticated;
Use App\Http\Controllers\Backend\Slider\SliderController;
Use App\Http\Controllers\Backend\Banner\BannerController;
Use App\Http\Controllers\Frontend\IndexController;
Use App\Http\Controllers\Frontend\CartController;
Use App\Http\Controllers\User\WishlistController;
Use App\Http\Controllers\User\CompareController;
Use App\Http\Controllers\CuponController;
Use App\Http\Controllers\ShippingAreaController;
Use App\Http\Controllers\Frontend\CheckOutController;
Use App\Http\Controllers\StripeController;
Use App\Http\Controllers\Backend\Order\OrderController;
Use App\Http\Controllers\Backend\Return\ReturnController;
Use App\Http\Controllers\Backend\Report\ReportController;
use App\Http\Controllers\Backend\Usermanage\ActiveUserController;
use App\Http\Controllers\Backend\BlogManage\BlogController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Frontend
Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get("/vendor/details/{id}", [IndexController::class, 'VendorDetails']);
Route::get("/vendor/all/", [IndexController::class, 'AllVendor']);
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);
Route::get('/product/sub-category/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

//Blog

Route::get('/blog' , [BlogController::class, 'AllBlog']);
Route::get('/post/details/{id}/{slug}' , [BlogController::class, 'BlogDetails'] );  
Route::get('/post/category/{id}/{slug}' , [BlogController::class, 'BlogPostCategory']); 


//Product Cart
Route::get('/mycart', [CartController::class, 'MyCart']);
Route::get('/get-cart-product',[CartController::class, 'GetCartProduct'] );
Route::get('/cart-remove/{rowId}', [CartController::class, 'CartRemove']);
Route::get('/cart-decrement/{rowId}' , [CartController::class, 'CartDecrement']);
Route::get('/cart-increment/{rowId}', [CartController::class, 'CartIncrement']);

//search Route
Route::post('/product/search' , [IndexController::class, 'ProductSearch'])->name('product.search');
Route::post('/search-product' , [IndexController::class, 'SearchProduct']); //Ajax request

//Cart Route
Route::post('/product/cart', [CartController::class, 'ProductCart'])->name('product.cart'); //Ajax Request
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']); //Ajax Request
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']); //Ajax Request




/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']); //Ajax request
Route::get('/product/wishlist/count', [WishlistController::class, 'WishlistCount']); //Ajax Request

//AddToCompare

Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']); //Ajax request

//coupon-apply
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);


Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/product/wishlist/view', [WishlistController::class, 'WishlistView']);
    Route::get("/get-wishlist-product", [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}' , [WishlistController::class, 'WishlistRemove']);

    //compare product route  
   
    Route::get('/compare', [CompareController::class, 'AllCompare']);
    Route::get('/get-compare-product' ,  [CompareController::class, 'GetCompareProduct']);
    Route::get('/compare-remove/{id}', [CompareController::class, 'CompareRemove']);

    /// Frontend Coupon Option
   
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);  
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

    //End frontEend

    //checkout 
    Route::get('/checkout', [CartController::class, 'CheckoutCreate']);

    Route::get('/district-get/ajax/{division_id}' , [CheckOutController::class, 'DistrictGetAjax']);
    Route::get('/state-get/ajax/{district_id}' ,   [CheckOutController::class, 'StateGetAjax']);
    Route::post('/checkout/store' ,  [CheckOutController::class, 'CheckoutStore'] );

    //Stripe Payment
    Route::post('/stripe/order' , [StripeController::class, 'StripeOrder'] );
    Route::post('/cash/order' ,  [StripeController::class, 'CashOrder'] );

    //User Order
    Route::get('/user/dashboard', [UserController::class, 'Dashboard'])->name('dashboard');
    Route::get('/user/order/', [UserController::class, 'Order'])->name('order');
    Route::get('/user/account/details', [UserController::class, 'UserAccountDetails'])->name('accountDetails');
    Route::get('/user/password/settings', [UserController::class, 'UserPasswordSettings'])->name('passwordSettings');
    Route::get('/order/view/details/{id}', [UserController::class, 'OrderViewDetail'])->name('orderViewDetail');
    Route::get('/order/invoice_download/{order_id}' , [UserController::class, 'UserOrderInvoice'] );  
    Route::post('/return/order/{order_id}' , [OrderController::class, 'ReturnOrder']);
    Route::get('/return/order/page' ,  [OrderController::class, 'ReturnOrderPage'])->name('return.order.page');
     // Order Tracking 
    Route::get('/user/track/order' ,[UserController::class, 'UserTrackOrder'])->name('user.track.order');
    Route::post('/order/tracking' , [UserController::class, 'OrderTracking'])->name('order.tracking');

    //Review
    Route::post('/store/review' , [ReviewController::class, 'StoreReview'])->name('store.review'); 

    
});  





/*---Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/*-----Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});   -----*/

require __DIR__.'/auth.php';

//user Route
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/dashboard', [UserController::class,'UserDashboard']);
    Route::get('/user/logout', [UserController::class, 'UserDestroy']);
    Route::post('user/profile/store', [UserController::class, 'UserProfileStore']);
    Route::post('user/update/password', [UserController::class, 'UserUpdatePassword']);
    
});

//Admin Route

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard']);
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy']);
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile']);
    Route::post('admin/profile/store', [AdminController::class, 'AdminProfileStore']);
    Route::get('admin/change/password', [AdminController::class, 'AdminChangePassword']);
    Route::post('admin/update/password', [AdminController::class, 'AdminUpdatePassword']);

    //brand route
    Route::get('/all/brand', [BrandController::class, 'AllBrand']);
    Route::get('/add/brand', [BrandController::class, 'AddBrand']);
    Route::post('/brand/store', [BrandController::class, 'BrandStore']);
    Route::get('/edit/brand/{id}', [BrandController::class, 'EditBrand']);
    Route::post('/update/brand', [BrandController::class, 'UpdateBrand']);
    Route::get('/delete/brand/{id}', [BrandController::class, 'DeleteBrand']);
    //End Brand

    //category Route
    Route::get('/all/category', [CategoryController::class, 'AllCategory']);
    Route::get('/add/category', [CategoryController::class, 'AddCategory']);
    Route::post('/category/store', [CategoryController::class, 'CategoryStore']);
    Route::get('/edit/category/{id}', [CategoryController::class, 'EditCategory']);
    Route::post('/update/category', [CategoryController::class, 'UpdateCategory']);
    Route::get('/delete/category/{id}', [CategoryController::class, 'DeleteCategory']);
    Route::get('/category/view/{id}', [CategoryController::class, 'CategoryView']);
    //End category route 

     //subcategory Route
     Route::get('/all/sub-category', [SubCategoryController::class, 'AllSubCategory']);
     Route::get('/add/sub-category', [SubCategoryController::class, 'AddSubCategory']);
     Route::post('/subcategory/store', [SubCategoryController::class, 'StoreSubCategory']);
     Route::get('/edit/sub-category/{id}', [SubCategoryController::class, 'EditSubCategory']);
     Route::post('/update/sub-category', [SubCategoryController::class, 'UpdateSubCategory']);
     Route::get('/delete/sub-category/{id}', [SubCategoryController::class, 'DeleteSubCategory']);
     Route::get('/subcategory/ajax/{category_id}' , [SubCategoryController::class, 'GetSubCategory']); //Ajax request
     //End subcategory route 
     
     //Active Vendor Controller
     Route::get('/active/vendor', [ActiveInactiveVendorController::class, 'ActiveVendor']);
     Route::get('/inactive/vendor', [ActiveInactiveVendorController::class, 'InActiveVendor']);
     Route::get('/active/vendor/details/{id}', [ActiveInactiveVendorController::class, 'ActiveVendorDetails']);
     Route::get('/inactive/vendor/details/{id}', [ActiveInactiveVendorController::class, 'InActiveVendorDetails']);
     Route::post('/active/vendor/approve', [ActiveInactiveVendorController::class, 'ActiveVendorApprove']);
     Route::post('/inactive/vendor/approve', [ActiveInactiveVendorController::class, 'InActiveVendorApprove']); 

     //Product Controller
     Route::get('/all-product', [ProductController::class, 'AllProduct']);
     Route::get('/add-product', [ProductController::class, 'AddProduct']);
     Route::post('/store/product', [ProductController::class, 'StoreProduct']);
     Route::get('/edit/product/{id}', [ProductController::class, 'EditProduct']);
     Route::post('/update/product' , [ProductController::class, 'UpdateProduct']);
     Route::post('/update/product/thumbnail' , [ProductController::class, 'UpdateProductThumbnail']);
     Route::post('/update/product/multiimage' , [ProductController::class, 'UpdateProductMultiimage']);
     Route::get('/product/multiimg/delete/{id}' , [ProductController::class, 'MulitImageDelelte']); 
     Route::get('/product/inactive/{id}' , [ProductController::class, 'ProductInactive'] );
     Route::get('/product/active/{id}' , [ProductController::class, 'ProductActive'] );
     Route::get('/delete/product/{id}' , [ProductController::class, 'ProductDelete']);

     //Slider Controller
     Route::get('/all/slider' , [SliderController::class, 'AllSlider']);
     Route::get('/add/slider' , [SliderController::class, 'AddSlider']);
     Route::post('/store/slider' , [SliderController::class, 'StoreSlider']);
     Route::get('/edit/slider/{id}' , [SliderController::class, 'EditSlider']);
     Route::post('/update/slider' , [SliderController::class, 'UpdateSlider']);
     Route::get('/delete/slider/{id}' , [SliderController::class, 'DeleteSlider']);

     //Banner Controller 
     Route::get('/all/banner' , [BannerController::class, 'AllBanner']);
     Route::get('/add/banner' , [BannerController::class, 'AddBanner']);
     Route::post('/store/banner' , [BannerController::class, 'StoreBanner']);
     Route::get('/edit/banner/{id}' , [BannerController::class, 'EditBanner']);
     Route::post('/update/banner' , [BannerController::class, 'UpdateBanner']);
     Route::get('/delete/banner/{id}' , [BannerController::class, 'DeleteBanner'])->name('delete.banner');

     //Cupon Controller 
     Route::get('/all/coupon' , [CuponController::class, 'AllCoupon']);
     Route::get('/add/coupon' , [CuponController::class, 'AddCoupon']);
     Route::post('/coupon/store', [CuponController::class, 'StoreCoupon']);
     Route::get('/edit/coupon/{id}', [CuponController::class, 'EditCoupon']);
     Route::post('/update/coupon', [CuponController::class, 'UpdateCoupon']);
     Route::get('/delete/coupon/{id}', [CuponController::class, 'DeleteCoupon']); 

     //Shiping Controller
     Route::get('/all/division', [ShippingAreaController::class, 'AllDivision']);
     Route::get('/add/division', [ShippingAreaController::class, 'AddDivision']);
     Route::post('/store/division', [ShippingAreaController::class, 'StoreDivision']);
     Route::get('/edit/division/{id}' , [ShippingAreaController::class, 'EditDivision']);
     Route::post('/update/division' ,  [ShippingAreaController::class, 'UpdateDivision']);
     Route::get('/delete/division/{id}', [ShippingAreaController::class, 'DeleteDivision']);
     Route::get('/all/district/', [ShippingAreaController::class, 'AllDistrict']);
     Route::get('/add/district/', [ShippingAreaController::class, 'AddDistrict']);
     Route::post('/store/district/', [ShippingAreaController::class, 'StoreDistrict']);
     Route::get('/edit/district/{id}' , [ShippingAreaController::class, 'EditDistrict']);
     Route::post('/update/district/' , [ShippingAreaController::class, 'UpdateDistrict']);
     Route::get('/delete/district/{id}', [ShippingAreaController::class, 'DeleteDistrict']);
     Route::get('/all/state', [ShippingAreaController::class, 'AllState']);
     Route::get('/add/state', [ShippingAreaController::class, 'AddState']);
     Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'GetDistrict']);  //Ajax request
     Route::post('/store/state', [ShippingAreaController::class, 'StoreState']);
     Route::get('/edit/state/{id}', [ShippingAreaController::class, 'EditState']);
     Route::post('/update/state', [ShippingAreaController::class, 'UpdateState']);
     Route::get('/delete/state/{id}', [ShippingAreaController::class, 'DeleteState']); 

     //OrderController 

     Route::get('/pending-order' , [OrderController::class, 'PendingOrder']);
     Route::get('/admin/order-details/{order_id}', [OrderController::class, 'AdminOrderDetails']);
     Route::get('/admin/confirmed/order' , [OrderController::class, 'AdminConfirmedOrder']);
     Route::get('/admin/processing/order' ,  [OrderController::class, 'AdminProcessingOrder']);
     Route::get('/admin/delivered/order' ,  [OrderController::class, 'AdminDeliveredOrder']);
     Route::get('/pending/confirm/{order_id}' ,  [OrderController::class, 'PendingToConfirm']);
     Route::get('/confirm/processing/{order_id}' ,  [OrderController::class, 'ConfirmToProcess']);
     Route::get('/processing/delivered/{order_id}' , [OrderController::class, 'ProcessToDelivered']);
     Route::get('/admin/invoice/download/{order_id}' , [OrderController::class, 'AdminInvoiceDownload'] );


     //ReturnProduct 

     Route::get('/return/request' , [ReturnController::class, 'ReturnRequest']);
     Route::get('/return/request/approved/{order_id}' , [ReturnController::class, 'ReturnRequestApproved'] );
     Route::get('/complete/return/request' ,  [ReturnController::class, 'CompleteReturnRequest'] )->name('complete.return.request');

     //ReportProduct 
     Route::get('/report/view' ,   [ReportController::class, 'ReportView']);
     Route::post('/search/by/date' ,  [ReportController::class, 'SearchByDate']);
     Route::post('/search/by/month' , [ReportController::class, 'SearchByMonth']);
     Route::post('/search/by/year' ,  [ReportController::class, 'SearchByYear']);
     Route::get('/order/by/user' ,  [ReportController::class, 'OrderByUser']);
     Route::post('/search/by/user' , [ReportController::class, 'SearchByUser']);
     
     //Usermanage
     Route::get('/all/user' , [ActiveUserController::class, 'AllUser']);
     Route::get('/all/vendor' , [ActiveUserController::class, 'AllVendor']);

     //Blog Manage
     Route::get('/admin/blog/category' , [BlogController::class, 'AllBlogCateogry']); 
     Route::get('/admin/add/blog/category' , [BlogController::class, 'AddBlogCateogry']);
     Route::post('/admin/store/blog/category' , [BlogController::class, 'StoreBlogCateogry']);
     Route::get('/admin/edit/blog/category/{id}' , [BlogController::class, 'EditBlogCateogry']);
     Route::post('/admin/update/blog/category' , [BlogController::class, 'UpdateBlogCateogry']);
     Route::get('/admin/delete/blog/category/{id}' , [BlogController::class, 'DeleteBlogCateogry']);

     Route::get('/admin/blog/post' , [BlogController::class, 'AllBlogPost'])->name('admin.blog.post'); 
     Route::get('/admin/add/blog/post' , [BlogController::class, 'AddBlogPost'])->name('add.blog.post');
     Route::post('/admin/store/blog/post' , [BlogController::class, 'StoreBlogPost']);
     Route::get('/admin/edit/blog/post/{id}' , [BlogController::class, 'EditBlogPost'])->name('edit.blog.post');
     Route::post('/admin/update/blog/post' , [BlogController::class, 'UpdateBlogPost'])->name('update.blog.post');
     Route::get('/admin/delete/blog/post/{id}' , [BlogController::class, 'DeleteBlogPost'] )->name('delete.blog.post');

     //Review 
     Route::get('/pending/review' , [ReviewController::class, 'PendingReview'])->name('pending.review'); 
     Route::get('/review/approve/{id}' , [ReviewController::class, 'ReviewApprove'])->name('review.approve'); 

     Route::get('/review/approve/{id}' , [ReviewController::class, 'ReviewApprove'])->name('review.approve');
     Route::get('/publish/review' ,  [ReviewController::class, 'PublishReview'] )->name('publish.review'); 
     Route::get('/review/delete/{id}' ,  [ReviewController::class, 'ReviewDelete'])->name('review.delete');

     //SiteSetting
     Route::get('/site/setting' , [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
     Route::post('/site/setting/update' , [SiteSettingController::class, 'SiteSettingUpdate'])->name('site.setting.update');

     //Seo Setting

     Route::get('/seo/setting' , [SiteSettingController::class, 'SeoSetting'] )->name('seo.setting');
     Route::post('/seo/setting/update' , [SiteSettingController::class, 'SeoSettingUpdate'])->name('seo.setting.update');

     //Stock Manage 
     Route::get('/product/stock', [OrderController::class, 'ProductStock'])->name('product.stock');

     //Roles & Permission manage
     Route::get('/all/permission' , [RoleController::class, 'AllPermission'])->name('all.permission');
     Route::get('/add/permission' , [RoleController::class, 'AddPermission'])->name('add.permission');
     Route::post('/store/permission' , [RoleController::class, 'StorePermission'])->name('store.permission');
     Route::get('/edit/permission/{id}' , [RoleController::class, 'EditPermission'])->name('edit.permission');
     Route::post('/update/permission' , [RoleController::class, 'UpdatePermission'])->name('update.permission');
     Route::get('/delete/permission/{id}' , [RoleController::class, 'DeletePermission'])->name('delete.permission');
     Route::get('/all/roles' , [RoleController::class, 'AllRoles'])->name('all.roles');
     Route::get('/add/roles' ,  [RoleController::class, 'AddRoles'])->name('add.roles');
     Route::post('/store/roles' , [RoleController::class, 'StoreRoles'])->name('store.roles');
     Route::get('/edit/roles/{id}' , [RoleController::class, 'EditRoles'])->name('edit.roles');
     Route::post('/update/roles' , [RoleController::class, 'UpdateRoles'])->name('update.roles');
     Route::get('/delete/roles/{id}' , [RoleController::class, 'DeleteRoles'])->name('delete.roles');
     
     Route::get('/add/roles/permission' , [RoleController::class, 'AddRolesPermission']);
     Route::post('/role/permission/store' , [RoleController::class, 'RolePermissionStore'] )->name('role.permission.store');
     Route::get('/edit/roles/{id}' , [RoleController::class, 'AdminRolesEdit'])->name('admin.edit.roles');
     Route::post('/roles/update/{id}' , [RoleController::class, 'AdminRolesUpdate'])->name('admin.roles.update');
     Route::get('/all/roles/permission', [RoleController::class, 'AllRolesPermission']);
     Route::get('/admin/delete/roles/{id}' , [RoleController::class, 'AdminRolesDelete'])->name('admin.delete.roles');

     Route::get('/all/admin' , [AdminController::class, 'AllAdmin'])->name('all.admin');
     Route::get('/add/admin' , [AdminController::class, 'AddAdmin']);

     Route::post('/admin/user/store' , [AdminController::class, 'AdminUserStore'])->name('admin.user.store');
     Route::get('/edit/admin/role/{id}' , [AdminController::class, 'EditAdminRole'] )->name('edit.admin.role');
     Route::post('/admin/user/update/{id}' , [AdminController::class, 'AdminUserUpdate'] )->name('admin.user.update');
     Route::get('/delete/admin/role/{id}' ,  [AdminController::class, 'DeleteAdminRole'])->name('delete.admin.role');

     

});  


//Vendor route
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard']);
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy']);
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile']);
    Route::post('vendor/profile/store', [VendorController::class, 'VendorProfileStore']);
    Route::get('vendor/change/password', [VendorController::class, 'VendorChangePassword']);
    Route::post('vendor/update/password', [VendorController::class, 'VendorUpdatePassword']);

     //Vendor Product Controller
    Route::get('/vendor/all-product', [VendorProductController::class, 'AllProduct']);
    Route::get('/vendor/add-product', [VendorProductController::class, 'AddProduct']);
    Route::post('/vendor/store/product', [VendorProductController::class, 'StoreProduct']);
    Route::get('/vendor/edit/product/{id}', [VendorProductController::class, 'EditProduct']);
    Route::post('/vendor/update/product' , [VendorProductController::class, 'UpdateProduct']);
    Route::post('/vendor/update/product/thumbnail' , [VendorProductController::class, 'UpdateProductThumbnail']);
    Route::post('/vendor/update/product/multiimage' , [VendorProductController::class, 'UpdateProductMultiimage']);
    Route::get('/vendor/product/inactive/{id}' , [VendorProductController::class, 'ProductInactive'] );
    Route::get('/vendor/product/active/{id}' , [VendorProductController::class, 'ProductActive'] );
    Route::get('/vendor/delete/product/{id}' , [VendorProductController::class, 'ProductDelete']);
    Route::get('/vendor/product/multiimg/delete/{id}' , [VendorProductController::class, 'MulitImageDelelte']); 
    Route::get('/vendor/subcategory/ajax/{category_id}' , [SubCategoryController::class, 'GetSubCategory']); //Ajax request

    //Vendor order 

    Route::get('/vendor-order' ,  [OrderController::class, 'VendorOrder']);
    Route::get('/vendor/return/order' , [OrderController::class, 'VendorReturnOrder']);
    Route::get('/vendor/complete/return/order' , [OrderController::class, 'VendorCompleteReturnOrder']);
    Route::get('/vendor/order/details/{order_id}' ,  [OrderController::class, 'VendorOrderDetails']);
    
    //Review
    Route::get('/vendor/all/review' , [ReviewController::class, 'VendorAllReview'])->name('vendor.all.review');


});



Route::get('admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);;
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->middleware(RedirectIfAuthenticated::class);;
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor']);
Route::post('/vendor/register', [VendorController::class, 'VendorRegister']); 