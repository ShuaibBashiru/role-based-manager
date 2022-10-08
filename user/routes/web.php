<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageAccessController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccessGroupController;
use App\Http\Controllers\AdminMenuGroupController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\RolePermissionsController;
use App\Http\Controllers\AccessGroupsController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\AdminAccessController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\UserPassportController;
use App\Http\Controllers\AdminPassportController;
use App\Http\Controllers\AccountPassportController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesItemsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// pages
Route::group(['middleware'=>['revalidate']], function(){
    // Home controller
    Route::get('', [HomeController::class, 'index'])->name('home');
    // Route::get('/verifyemail', [TokenForEmailVerifyController::class, 'mailing'])->name('verifyemail');
    // Route::get('/verify_email', [TokenForEmailVerifyController::class, 'index'])->name('verify_email');
    //Auth Controller
    Route::post('/login', [AuthController::class, 'login'])->name('login_request');
    Route::get('/forgotpassword', [PasswordResetController::class, 'forgotpassword'])->name('forgotpassword');
    Route::get('/password/new/{id}/{userid}', [PasswordResetController::class, 'newPasswordLink'])->name('newPasswordLink');
    Route::post('/password_reset', [PasswordResetController::class, 'mailing'])->name('account_password_reset');
    Route::post('/password/change', [PasswordResetController::class, 'changePassword'])->name('account_change_password');

    // Session Controller
    Route::get('/app/logout', [SessionController::class, 'logout'])->name('logout');
    // Sign up Controller
    });

// End of signup groups
Route::group(['middleware'=>['revalidate']], function(){
    Route::get('/signup-guide', [SignupController::class, 'index'])->name('signup_guide');
    Route::get('/signup', [SignupController::class, 'signup'])->name('signup');
    Route::get('/signup-verify', [SignupController::class, 'signup'])->name('signup_verify');
});

Route::group(['middleware'=>['revalidate', 'confirmReLogIn']], function(){
    Route::get('/signin', [AuthController::class, 'index'])->name('signin');
});
// End of check if session active

Route::middleware(['revalidate'])->group(function(){

// Status controller
Route::get('/status/list', [StatusController::class, 'list_items'])->name('list_status');

// Gender Controller
Route::get('/genders/list', [GendersController::class, 'gender_list'])->name('list_genders');

// Country Controller
Route::get('/country/list', [CountryController::class, 'list_items'])->name('list_country');

// State Countroller
Route::get('/state/list', [StateController::class, 'list_items'])->name('list_state');

// City Controller
Route::get('/city/list', [CitiesController::class, 'list_items'])->name('list_city');
});


// Authentication and Security // ? Revalidate: This take care of browser from cathing protected routes
Route::middleware(['revalidate', 'customAuthentication'])->group(function(){

// Dashboard controller
Route::get('/app/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Passport Controller
Route::post('/user/passport', [UserPassportController::class, 'passport'])->name('upload_user_passport');
Route::post('/admin/passport', [AdminPassportController::class, 'passport'])->name('upload_admin_passport');
Route::post('/account/passport', [AccountPassportController::class, 'passport'])->name('upload_account_passport');

// Charts Controller
Route::get('/user/chart', [ChartsController::class, 'users'])->name('list_user_chart');

// Users Controller
Route::get('/app/user/list', [UserController::class, 'list'])->name('list_user');
Route::get('/app/user/profile/{id}', [UserController::class, 'profile'])->name('user_profile');
Route::get('/app/user/create', [UserController::class, 'createRecord'])->name('create_user');
Route::get('/app/user/upload', [UserController::class, 'uploadBatch'])->name('upload_user');
Route::get('/app/user/manage/{id}', [UserController::class, 'manage'])->name('manage_user');
Route::get('/app/user/edit/name/{id}', [UserController::class, 'edit_name'])->name('edit_user_name');
Route::get('/app/user/edit/dob/{id}', [UserController::class, 'edit_dob'])->name('edit_user_dob');
Route::get('/app/user/edit/gender/{id}', [UserController::class, 'edit_gender'])->name('edit_user_gender');
Route::get('/app/user/edit/contactaddress/{id}', [UserController::class, 'edit_contact_address'])->name('edit_user_contact_addr');
Route::get('/app/user/edit/phone/{id}', [UserController::class, 'edit_phone'])->name('edit_user_phone');
Route::get('/app/user/edit/email/{id}', [UserController::class, 'edit_email'])->name('edit_user_email');
Route::get('/app/user/edit/password/{id}', [UserController::class, 'edit_password'])->name('edit_user_password');
Route::post('/user/upload', [UserController::class, 'upload'])->name('upload_user_request');
Route::post('/user/create', [UserController::class, 'create'])->name('create_user_request');
Route::post('/user/name/update', [UserController::class, 'update_name'])->name('update_user_name_request');
Route::post('/user/dob/update', [UserController::class, 'update_dob'])->name('update_user_dob_request');
Route::post('/user/gender/update', [UserController::class, 'update_gender'])->name('update_user_gender_request');
Route::post('/user/contactaddress/update', [UserController::class, 'update_contact_address'])->name('update_user_contact_request');
Route::post('/user/phone/update', [UserController::class, 'update_phone'])->name('update_user_phone_request');
Route::post('/user/email/update', [UserController::class, 'update_email'])->name('update_user_email_request');
Route::get('/user/list', [UserController::class, 'listAll'])->name('list_user_request');
Route::get('/user/status/updatebatch', [UserController::class, 'status_update_batch'])->name('update_user_status_request');
Route::get('/user/manage/status', [UserController::class, 'manage_status'])->name('manage_user_status');
Route::delete('/user/trash', [UserController::class, 'trash'])->name('trash_user_request');
Route::get('/app/user/profile/pdf/{id}', [UserController::class, 'profilePdf'])->name('pdf_user_profile');
Route::get('/app/user/savings/pdf/{id}', [SavingsController::class, 'savingsPdf'])->name('pdf_savings');

// Admin
Route::get('/app/admin/list', [AdminController::class, 'list'])->name('list_admin');
Route::get('/app/admin/profile/{id}', [AdminController::class, 'profile'])->name('admin_profile');
Route::get('/app/admin/create', [AdminController::class, 'createRecord'])->name('create_admin');
Route::get('/app/admin/upload', [AdminController::class, 'uploadBatch'])->name('upload_admin');
Route::get('/app/admin/manage/{id}', [AdminController::class, 'manage'])->name('manage_admin');
Route::get('/app/admin/edit/name/{id}', [AdminController::class, 'edit_name'])->name('edit_admin_name');
Route::get('/app/admin/edit/dob/{id}', [AdminController::class, 'edit_dob'])->name('edit_admin_dob');
Route::get('/app/admin/edit/gender/{id}', [AdminController::class, 'edit_gender'])->name('edit_admin_gender');
Route::get('/app/admin/edit/contactaddress/{id}', [AdminController::class, 'edit_contact_address'])->name('edit_admin_contact_addr');
Route::get('/app/admin/edit/phone/{id}', [AdminController::class, 'edit_phone'])->name('edit_admin_phone');
Route::get('/app/admin/edit/email/{id}', [AdminController::class, 'edit_email'])->name('edit_admin_email');
Route::get('/app/admin/edit/password/{id}', [AdminController::class, 'edit_password'])->name('edit_admin_password');
Route::post('/admin/upload', [AdminController::class, 'upload'])->name('upload_admin_request');
Route::post('/admin/create', [AdminController::class, 'create'])->name('create_admin_request');
Route::post('/admin/name/update', [AdminController::class, 'update_name'])->name('update_admin_name_request');
Route::post('/admin/dob/update', [AdminController::class, 'update_dob'])->name('update_admin_dob_request');
Route::post('/admin/gender/update', [AdminController::class, 'update_gender'])->name('update_admin_gender_request');
Route::post('/admin/contactaddress/update', [AdminController::class, 'update_contact_address'])->name('update_admin_contact_request');
Route::post('/admin/phone/update', [AdminController::class, 'update_phone'])->name('update_admin_phone_request');
Route::post('/admin/email/update', [AdminController::class, 'update_email'])->name('update_admin_email_request');
Route::get('/admin/list', [AdminController::class, 'listAll'])->name('list_admin_request');
Route::get('/admin/status/updatebatch', [AdminController::class, 'status_update_batch'])->name('update_admin_status_request');
Route::get('/admin/manage/status', [AdminController::class, 'manage_status'])->name('manage_admin_status');
Route::delete('/admin/trash', [AdminController::class, 'trash'])->name('trash_admin_request');
Route::get('/admin/role/update', [AdminController::class, 'update_role'])->name('update_admin_role');
Route::get('/app/admin/profile/pdf/{id}', [AdminController::class, 'profilePdf'])->name('pdf_admin_profile');


// Account controller
Route::get('/app/account/create', [AccountController::class, 'createRecord'])->name('create_account');
Route::get('/app/account/manage/{id}', [AccountController::class, 'manage'])->name('manage_account');
Route::get('/app/account/profile', [AccountController::class, 'profile'])->name('account_profile');
Route::get('/app/account/edit/name/{id}', [AccountController::class, 'edit_name'])->name('edit_account_name');
Route::get('/app/account/edit/dob/{id}', [AccountController::class, 'edit_dob'])->name('edit_account_dob');
Route::get('/app/account/edit/gender/{id}', [AccountController::class, 'edit_gender'])->name('edit_account_gender');
Route::get('/app/account/edit/contactaddress/{id}', [AccountController::class, 'edit_contact_address'])->name('edit_account_contact_addr');
Route::get('/app/account/edit/phone/{id}', [AccountController::class, 'edit_phone'])->name('edit_account_phone');
Route::get('/app/account/edit/email/{id}', [AccountController::class, 'edit_email'])->name('edit_account_email');
Route::get('/app/account/edit/password/{id}', [AccountController::class, 'edit_password'])->name('edit_account_password');
Route::post('/account/create', [AccountController::class, 'create'])->name('create_account_request');
Route::post('/account/name/update', [AccountController::class, 'update_name'])->name('update_account_name_request');
Route::post('/account/dob/update', [AccountController::class, 'update_dob'])->name('update_account_dob_request');
Route::post('/account/gender/update', [AccountController::class, 'update_gender'])->name('update_account_gender_request');
Route::post('/account/contactaddress/update', [AccountController::class, 'update_contact_address'])->name('update_account_contact_request');
Route::post('/account/phone/update', [AccountController::class, 'update_phone'])->name('update_account_phone_request');
Route::post('/account/email/update', [AccountController::class, 'update_email'])->name('update_account_email_request');
Route::get('/account/list', [AccountController::class, 'listAll'])->name('list_account_request');
Route::get('/account/status/updatebatch', [AccountController::class, 'status_update_batch'])->name('update_account_status_request');
Route::get('/account/manage/status', [AccountController::class, 'manage_status'])->name('manage_account_status');
Route::delete('/account/trash', [AccountController::class, 'trash'])->name('trash_account_request');
Route::get('/app/account/profile/pdf/{id}', [AccountController::class, 'profilePdf'])->name('pdf_account_profile');



// Role
Route::get('/app/role/list', [RoleController::class, 'list'])->name('list_role');
Route::get('/app/role/manage/{id}', [RoleController::class, 'manage'])->name('manage_role');
Route::get('/role/list', [RoleController::class, 'listAll'])->name('list_role_request');
Route::post('/role/create', [RoleController::class, 'create'])->name('create_role_request');
Route::get('/role/status/updatebatch', [RoleController::class, 'status_update_batch'])->name('update_role_status_request');
Route::delete('/role/trash', [RoleController::class, 'trash'])->name('trash_role_request');
Route::post('/role/update', [RoleController::class, 'update_record'])->name('update_role_request');
Route::get('/role/manage/status', [RoleController::class, 'manage_status'])->name('manage_role_status');

// Permission group
Route::get('/app/accessgroup/list', [AccessGroupController::class, 'list'])->name('list_accessgroup');
Route::get('/app/accessgroup/manage/{id}', [AccessGroupController::class, 'manage'])->name('manage_accessgroup');
Route::get('/accessgroup/list', [AccessGroupController::class, 'listAll'])->name('list_accessgroup_request');
Route::post('/accessgroup/create', [AccessGroupController::class, 'create'])->name('create_accessgroup_request');
Route::get('/accessgroup/status/updatebatch', [AccessGroupController::class, 'status_update_batch'])->name('update_accessgroup_status_request');
Route::post('/accessgroup/update', [AccessGroupController::class, 'update_record'])->name('update_accessgroup_request');
Route::get('/accessgroup/manage/status', [AccessGroupController::class, 'manage_status'])->name('manage_accessgroup_status_request');
Route::delete('/accessgroup/trash', [AccessGroupController::class, 'trash'])->name('trash_accessgroup_request');


// Access
Route::get('/app/access/upload', [AccessController::class, 'uploadBatch'])->name('upload_access');
Route::get('/app/access/list', [AccessController::class, 'list'])->name('list_access');
Route::get('/app/access/manage/{id}', [AccessController::class, 'manage'])->name('manage_access');
Route::get('/access/list', [AccessController::class, 'listAll'])->name('list_access_request');
Route::post('/access/create', [AccessController::class, 'create'])->name('create_access_request');
Route::post('/access/upload', [AccessController::class, 'upload'])->name('upload_access_request');
Route::get('/access/status/updatebatch', [AccessController::class, 'status_update_batch'])->name('update_status_access_request');
Route::post('/access/update', [AccessController::class, 'update_record'])->name('update_access_request');
Route::get('/access/manage/status', [AccessController::class, 'manage_status'])->name('manage_status_access_request');
Route::delete('/access/trash', [AccessController::class, 'trash'])->name('trash_access_request');

Route::get('/app/rolepermission/{id}', [RolePermissionsController::class, 'list'])->name('list_rolepermission');
Route::get('/app/rolepermission/manage/{id}', [RolePermissionsController::class, 'manage'])->name('manage_rolepermission');
Route::post('/rolepermission/sethomepage', [RolePermissionsController::class, 'assignHomePage'])->name('sethomepage_request');
Route::post('/rolepermission/assign', [RolePermissionsController::class, 'assign'])->name('assign_rolepermission_request');
Route::post('/rolepermission/remove', [RolePermissionsController::class, 'remove'])->name('remove_rolepermission_request');
Route::get('/rolepermission/list', [RolePermissionsController::class, 'listAll'])->name('list_rolepermission_request');
Route::post('/rolepermission/update', [RolePermissionsController::class, 'update_record'])->name('update_rolepermission_request');
Route::get('/rolepermission/manage/status', [RolePermissionsController::class, 'manage_status'])->name('manage_status_rolepermission_request');
Route::get('/rolepermission/status/updatebatch', [RolePermissionsController::class, 'status_update_batch'])->name('update_status_rolepermission_request');
Route::delete('/rolepermission/trash', [RolePermissionsController::class, 'trash'])->name('trash_rolepermission_request');

// Admin Menu group
Route::get('/app/adminmenugroup/list', [AdminMenuGroupController::class, 'list'])->name('list_adminmenugroup');
Route::get('/app/adminmenugroup/manage/{id}', [AdminMenuGroupController::class, 'manage'])->name('manage_adminmenugroup');
Route::get('/adminmenugroup/list', [AdminMenuGroupController::class, 'listAll'])->name('list_adminmenu_group_request');
Route::post('/adminmenugroup/create', [AdminMenuGroupController::class, 'create'])->name('create_adminmenu_group_request');
Route::get('/adminmenugroup/status/updatebatch', [AdminMenuGroupController::class, 'status_update_batch'])->name('update_status_adminmenu_group_request');
Route::post('/adminmenugroup/update', [AdminMenuGroupController::class, 'update_record'])->name('update_adminmenu_group_request');
Route::get('/adminmenugroup/manage/status', [AdminMenuGroupController::class, 'manage_status'])->name('manage_update_adminmenu_group_request');
Route::delete('/adminmenugroup/trash', [AdminMenuGroupController::class, 'trash'])->name('trash_adminmenu_group_request');

//Admin Menu
Route::get('/app/adminmenu/list', [AdminMenuController::class, 'list'])->name('list_adminmenu');
Route::get('/app/adminmenu/manage/{id}', [AdminMenuController::class, 'manage'])->name('manage_adminmenu');
Route::get('/adminmenu/list', [AdminMenuController::class, 'listAll'])->name('list_adminmenu_request');
Route::get('/adminmenu/menulist', [AdminMenuController::class, 'menuList'])->name('menulist_adminmenu_request');
Route::post('/adminmenu/create', [AdminMenuController::class, 'create'])->name('create_adminmenu_request');
Route::get('/adminmenu/status/updatebatch', [AdminMenuController::class, 'status_update_batch'])->name('update_status_adminmenu_request');
Route::post('/adminmenu/update', [AdminMenuController::class, 'update_record'])->name('update_adminmenu_request');
Route::get('/adminmenu/manage/status', [AdminMenuController::class, 'manage_status'])->name('manage_status_adminmenu_request');
Route::delete('/adminmenu/trash', [AdminMenuController::class, 'trash'])->name('trash_adminmenu_request');

// Pos
Route::get('/app/pos/portal', [PosController::class, 'portal'])->name('pos_portal');
Route::get('/app/pos/invoices', [PosController::class, 'list'])->name('pos_invoices');
Route::get('/app/pos/printinvoice', [PosController::class, 'invoice'])->name('pos_print_invoices');
Route::post('/pos/create', [PosController::class, 'create'])->name('pos_create_request');
Route::get('/pos/invoices', [PosController::class, 'listAll'])->name('pos_invoices_request');
Route::get('/pos/sales', [PosController::class, 'listAllSales'])->name('pos_sales_request');
Route::get('/pos/invoice', [PosController::class, 'get_invoice'])->name('pos_getinvoice_request');
Route::get('/pos/printinvoice', [PosController::class, 'printinvoice'])->name('pos_print_invoices_request');

// Sales items
Route::get('/app/salesitems/upload', [SalesItemsController::class, 'uploadBatch'])->name('upload_salesitems');
Route::get('/app/salesitems/list', [SalesItemsController::class, 'list'])->name('list_salesitems');
Route::get('/app/salesitems/manage/{id}', [SalesItemsController::class, 'manage'])->name('manage_salesitems');
Route::get('/salesitems/status/updatebatch', [SalesItemsController::class, 'status_update_batch'])->name('update_status_salesitems_request');
Route::post('/salesitems/upload', [SalesItemsController::class, 'upload'])->name('upload_salesitems_request');
Route::post('/salesitems/create', [SalesItemsController::class, 'create'])->name('create_salesitems_request');
Route::get('/salesitems/list', [SalesItemsController::class, 'listAll'])->name('list_salesitems_request');
Route::post('/salesitems/update', [SalesItemsController::class, 'update_record'])->name('update_salesitems_request');
Route::get('/salesitems/manage/status', [SalesItemsController::class, 'manage_status'])->name('manage_status_salesitems_request');
Route::delete('/salesitems/trash', [SalesItemsController::class, 'trash'])->name('trash_salesitems_request');


});
Route::get('/getroutes', [PageAccessController::class, 'getRoutes'])->name('get_all_routes');
Route::get('/pagenotfound', [PageAccessController::class, 'pageNotFound'])->name('pageNotFound');
Route::get('/noaccess', [PageAccessController::class, 'NoAccess'])->name('NoAccess');
