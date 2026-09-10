<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
//------------------------------- Frontend -------------------------------
use App\Http\Controllers\FrontEnd\FrontDashboardController;
use App\Http\Controllers\FrontEnd\ProductDetailController;
use App\Http\Controllers\FrontEnd\ProductTypeController;
use App\Http\Controllers\FrontEnd\PagesController;

//------------------------------- Backend --------------------------------
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ProductTypeControllerBack;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BackDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\SitemenuController;
use App\Http\Controllers\Backend\BranchController;

//------------------------------- Auth -----------------------------------
use App\Http\Controllers\Auth\BackEndLoginController;


Route::get('check-session', function(Request $request) {

    // Check if the user is authenticated and the session is still valid
    if (auth('user')->user() && $request->session()->has('activeSubMenus')) {
        // Session is still active
        return response()->json(['session_expired' => false]);
    } else {
        // Session has expired
        return response()->json(['session_expired' => true]);
    }
});

// Route Image Public Storage 
Route::get('logos/{pacth}', [SettingController::class, 'logos']);
Route::get('slider/{path}', [SliderController::class, 'slider']);
Route::get('icons/{pacth}', [ProductTypeControllerBack::class, 'icons']);
Route::get('productImages/{pacth}', [ProductController::class, 'productImages']);
Route::get('productDetails/{pacth}', [ProductController::class, 'productDetails']);

//------------------------------- Route FrontEnd -------------------------------
Route::get('/', [FrontDashboardController::class, 'index']);
Route::get('/home',[BackDashboardController::class, 'underconstration']);

// Route Products
Route::get('product-detail/{id}', [ProductDetailController::class, 'index']);
Route::get('product-type/{id}', [ProductTypeController::class, 'index']);
Route::get('product-type-detail/{id}', [ProductTypeController::class, 'getBrand']);

// Route Pages
Route::get('pages/{id}', [PagesController::class, 'index'])->middleware('decrypt.check');
Route::get('page/{id}', [PagesController::class, 'page']);

// Route By Brands
Route::get('brands/{id}', [PagesController::class, 'productBybrand']);

// Route Search
Route::post('search-product', [FrontDashboardController::class, 'search']);
//-------------------------------  End FrontEnd ------------------------------- 

//****************************** Auth Backend ********************************
Route::get('admin-login', [BackEndLoginController::class, 'index'])->name('admin-login');
Route::post('admin-login', [BackEndLoginController::class, 'login']);

// Route PageError
Route::get('session-expired', [BackDashboardController::class, 'sessionExpired'])->name('sessionExpired');
Route::get('404-error', [BackDashboardController::class, 'pageNotFound'])->name('pageNotfound');

Route::group(['middleware'=>'user'], function(){
    
    // Route Dashboard
    Route::get('admin-unc', [BackDashboardController::class, 'index']);

    // Route Logout
    Route::get('logout', [BackEndLoginController::class, 'logout']);
   
    // Route Users
    Route::get('users', [UserController::class, 'userList']);
    Route::get('create-users', [UserController::class, 'formCreateUser']);
    Route::post('add-users', [UserController::class, 'addUsers']);
    Route::get('edit-users/{id}', [UserController::class, 'editUsers']);
    Route::post('update-users/{id}', [UserController::class, 'updateUsers']);
    Route::get('userProfile/{pacth}', [UserController::class, 'userProfile']);
    Route::get('delete-users/{id}', [UserController::class, 'destroyUser']);

    // Route UsersRole
    Route::get('user-role', [UserRoleController::class, 'listUserRole']);
    Route::get('create-roles', [UserRoleController::class, 'addRole']);
    Route::post('add-roles', [UserRoleController::class, 'createRole']);
    Route::get('edit-role/{id}', [UserRoleController::class, 'editRole']);
    Route::post('update-role/{id}', [UserRoleController::class, 'updateRole']);
    Route::get('delete-role/{id}', [UserRoleController::class, 'destroyRole']);

    // Route Slider
    Route::get('slider', [SliderController::class, 'index']);
    Route::get('create-slide', [SliderController::class, 'addSlider']);
    Route::post('add-slide', [SliderController::class, 'createSlide']);
    Route::get('edit-slide/{id}', [SliderController::class, 'editSlide']);
    Route::post('update-slide/{id}', [SliderController::class, 'updateSlide']);
    Route::get('delete-slide/{id}', [SliderController::class, 'destroySlide']);
    Route::get('sliderStatus', [SliderController::class, 'statusSlider']);

    // Route Site Menus
    Route::get('site-menus', [SitemenuController::class, 'index']);
    Route::get('create-sitemenu', [SitemenuController::class, 'createMenu']);
    Route::post('add-sitemenus', [SitemenuController::class, 'addSitemenu']);
    Route::get('edit-sitemenus/{id}', [SitemenuController::class, 'editSitemenu']);
    Route::post('update-sitemenus/{id}', [SitemenuController::class, 'updateSitemenu']);
    Route::get('changeStatus', [SitemenuController::class, 'isActive']);
    Route::get('delete-site/{id}', [SitemenuController::class, 'destroySite']);
    
    Route::post('uploadSitemenu', [SitemenuController::class, 'uploadSitemenu']);

    Route::get('site-products', [SitemenuController::class, 'siteProduct']);
    Route::get('create-siteproduct', [SitemenuController::class, 'createSiteProduct']);
    Route::post('add-siteproducts', [SitemenuController::class, 'addSitemenuProduct']);
    Route::get('edit-siteproduct/{id}', [SitemenuController::class, 'editSiteProduct']);

    // Route ProductType
    Route::get('product-type', [ProductTypeControllerBack::class, 'index'])->name('search.product-type');
    Route::get('create-product-type', [ProductTypeControllerBack::class, 'addProductType']);
    Route::post('add-product-type', [ProductTypeControllerBack::class, 'createProductType']);
    Route::get('edit-product-type/{id}', [ProductTypeControllerBack::class, 'editProductType']);
    Route::post('update-profuct-type/{id}', [ProductTypeControllerBack::class, 'updateProductType']);
    Route::get('delete-product-type/{id}', [ProductTypeControllerBack::class, 'destroyProductType']);

    // Route Branch
    Route::get('brand', [BranchController::class, 'index']);
    Route::get('create-brand', [BranchController::class, 'addBrand']);
    Route::post('add-brand', [BranchController::class, 'createBrand']);
    Route::get('edit-brand/{id}', [BranchController::class, 'editBrand']);
    Route::post('update-brand/{id}', [BranchController::class, 'updateBrand']);
    Route::get('delete-brand/{id}', [BranchController::class, 'destroyBrand']);

    // Route Products
    Route::get('view-product', [ProductController::class, 'index'])->name('search.product');
    Route::get('add-product', [ProductController::class, 'addProduct']);
    Route::post('create-product', [ProductController::class, 'create']);
    Route::post('get-brands', [ProductController::class, 'getBrands']);
    Route::post('get-images-detail', [ProductController::class, 'getImageDetail']);
    Route::post('image-upload', [ProductController::class, 'upload']);
    Route::get('edit-product/{id}', [ProductController::class, 'editProduct']);
    Route::post('update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::get('delete-imagedetail/{id}', [ProductController::class, 'deleteImageDetail']);
    Route::get('delete-product/{id}', [ProductController::class, 'destroyProduct']);
    
    // Route Product (New Arrival)
    Route::get('product-NewArrival', [ProductController::class, 'productNewArrival']);
    Route::get('delete-NewArrival/{id}', [ProductController::class, 'destroyNewArrival']);

    // Route Product (Hot Sale)
    Route::get('product-HotSale', [ProductController::class, 'productHotSale']);
    Route::get('delete-HotSale/{id}', [ProductController::class, 'destroyHotSale']);

    // Route Settings ---------------------------------------------
    Route::get('settings', [SettingController::class, 'index']);

    // Route Settings Header
    Route::get('update-logo/{id}', [SettingController::class, 'uploadLogo']);
    Route::post('update-logo/{id}', [SettingController::class, 'updateLogo']);

    Route::get('update-sites', [SettingController::class, 'uploadSites']);
    Route::post('update-site-icon/{id}', [SettingController::class, 'updateSiteIcon']);
    Route::post('update-site-name/{id}', [SettingController::class, 'updateSiteName']);

    Route::get('update-phone-mail', [SettingController::class, 'updatePhoneMails']);
    Route::post('update-number/{id}', [SettingController::class, 'updatePhonenumber']);
    Route::post('update-mail/{id}', [SettingController::class, 'updateMail']);

    // Route Others
    Route::get('update-color-code', [SettingController::class, 'colorCode']);
    Route::post('update-color/{id}', [SettingController::class, 'updateColorCode']);
    Route::post('update-text-footer/{id}', [SettingController::class, 'updateTextfooter']);

    Route::get('update-link-chat', [SettingController::class, 'linkChat']);
    Route::post('update-linkchat/{id}', [SettingController::class, 'updateLinkChat']);
    Route::post('update-linktelegram/{id}', [SettingController::class, 'updateLinkTelegram']);

    // Route EasyLinks
    Route::get('easy-links', [SettingController::class, 'easyLinks']);
    Route::post('insert-easylinks', [SettingController::class, 'insertEasylink']);
    Route::get('delete-easyLinks/{id}', [SettingController::class, 'destroyEasaLink']);

    // Route Contact Us 
    Route::get('contact-us', [SettingController::class, 'contactUs']);
    Route::post('update-locations/{id}', [SettingController::class, 'updatedLocations']);
    Route::post('updated-emails/{id}', [SettingController::class, 'updatedEmail']);
    Route::post('update-numberphone/{id}', [SettingController::class, 'updatedNumberPhone']);

    // Route Payment Accepet
    Route::get('img-payment', [SettingController::class, 'paymentAccepet']);
    Route::post('upload-imgPayment', [SettingController::class, 'uploadImagePayment']);
    Route::get('delete-imagePayment/{id}', [SettingController::class, 'destroyImagePayment']);

    // Route Follow Us
    Route::get('img-followUs', [SettingController::class, 'indexFollowUs']);
    Route::post('upload-followUs', [SettingController::class, 'uploadFollowUs']);
    Route::get('delete-followUs/{id}', [SettingController::class, 'destroyFollowUs']);

    // End Route Settings ---------------------------------------------
});
// -------------------- End BackEnd ----------------------------//


