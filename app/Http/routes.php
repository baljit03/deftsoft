<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
//////////////////Admin Routes///////////////////////////
/* * *
 * all Post or Ajax Urls
 */
Route::post('admin/login-check', 'loginController@doLogin');
Route::post('/admin/access-management', 'AdminController@accessManagement')->middleware('admin');
Route::post('admin/mange-pages-details', 'AdminController@managePagePostDetails')->middleware('admin');
Route::post('admin/mange-post-details', 'AdminController@managePostDetails')->middleware('admin');
Route::post('admin/add-pages-details', 'AdminController@addPageDetails')->middleware('admin');
Route::post('admin/add-post-details', 'AdminController@addPostDetails')->middleware('admin');
Route::post('admin/delete-page', 'AdminController@deletePost')->middleware('admin');
Route::post('admin/delete-users', 'AdminController@deleteUser')->middleware('admin');
Route::post('admin/custom_url_check', 'AdminController@customUrlCheck')->middleware('admin');
Route::post('admin/save-maintaince-mode', 'AdminController@updateMaintaniceMode');
Route::post('admin/update-password', 'AdminController@changePasswordData');
Route::post('admin/add-new-testimonial-data', 'AdminController@addNewTestinomialData');
Route::post('admin/edit-new-testimonial-data', 'AdminController@editTestinomialDetails')->middleware('admin');
Route::post('admin/delete-testimonial', 'AdminController@deleteTestinomial')->middleware('admin');
Route::post('admin/add-portfolio-form', 'AdminController@addNewPortfolioForm')->middleware('admin');
Route::post('/admin/edit-portfolio-form', 'AdminController@updatePortfolioDetails')->middleware('admin');
Route::post('/admin/add-blog-details', 'AdminController@addBlogData')->middleware('admin');
Route::post('/admin/edit-blog-details', 'AdminController@editBlogDataDetails')->middleware('admin');
Route::post('/admin/delete-blog', 'AdminController@deleteBlog')->middleware('admin');
Route::post('/admin/delete-contact-record', 'AdminController@deleteContactusRecord')->middleware('admin');
Route::post('/admin/delete-partner-record', 'AdminController@deletePartnerRecord')->middleware('admin');
Route::post('/admin/delete-portfolio-record', 'AdminController@deletePortfolioRecord')->middleware('admin');
Route::post('admin/add-job-details', 'AdminController@addJobDetails')->middleware('admin');
Route::post('/admin/edit-job-details', 'AdminController@editJobDetails')->middleware('admin');
Route::post('/admin/delete-job-record', 'AdminController@deleteJobRecord')->middleware('admin');
Route::post('/admin/update-jobapplication', 'AdminController@updateJobApplicationData')->middleware('admin');
Route::post('/admin/delete-application-record', 'AdminController@deleteApplicationRecord')->middleware('admin');
Route::post('admin/edit-header-menu-detail', 'AdminController@EditHeaderMenuDetail')->middleware('admin');
Route::post('admin/edit-footer-menu-detail', 'AdminController@EditFooterMenuDetail')->middleware('admin');
Route::post('admin/add-header-menu-detail', 'AdminController@addHeaderMenuDetail')->middleware('admin');
Route::post('admin/delete-header-menu', 'AdminController@deleteHeaderMenuRecord')->middleware('admin');
Route::post('admin/delete-footer-menu', 'AdminController@deleteFooterMenuRecord')->middleware('admin');
Route::post('admin/add-footer-menu-detail', 'AdminController@addFooterMenuDetail')->middleware('admin');
/* * *
 * All Http get requests
 */


Route::get('admin/access-denied', 'AdminController@accessDenied');
Route::get('/admin', 'loginController@showLogin');
Route::get('/admin/login', 'loginController@showLogin');
Route::get('/admin/logout', 'loginController@logout');

Route::get('/admin/index', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@home',
    'acessModule' => ['superadmin', 'admin', 'others']
]);
Route::get('/admin/home', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@home',
    'roles' => ['superadmin', 'admin', 'others']
]);
Route::get('/admin/dashboard', [
    'middleware' => ['role_check'],
    'uses' => 'AdminController@home',
    'roles' => ['superadmin', 'admin', 'others']
]);
Route::get('/admin/manage-users', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@manageUsers',
    'roles' => ['superadmin']
]);
Route::get('/admin/access-control', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@accessControl',
    'roles' => ['superadmin']
]);
Route::get('/admin/edit-profile', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@editUser',
    'roles' => ['superadmin']
]);
Route::get('/admin/manage-pages', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@managePages',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/manage-posts', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@managePosts',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/add-new-post', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@addNewPost',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/edit-page-posts/{id?}', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@editPagesPostDetails',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/edit-posts/{id?}', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@editPostDetails',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/add-new-page', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@addNewPagePost',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/change-password', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@changePassword',
]);
Route::get('admin/manage-testimonial', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@manageTestinomialList',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/add-new-blog', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@addNewBlog',
]);
Route::get('admin/add-new-testimonial', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@addNewTestinomial',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/manage-testimonial-detail/{id}', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@manageTestinomialDetails',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/manage-blog', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@manageBlog',
]);
Route::get('admin/manage-portfolio', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@managePortfolio',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/add-new-portfolio', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@addNewPortfolio',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/edit-portfolio/{id?}', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@editPortfolioDetails',
    'roles' => ['superadmin', 'admin']
]);
Route::get('/admin/edit-blog/{id}', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@editBlogData',
]);
Route::get('/admin/contact-us-records', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@contactUsRecords',
]);
Route::get('/admin/business-partner-records', [
    'middleware' => ['admin', 'role_check'],
    'uses' => 'AdminController@businessPartnerRecords',
    'roles' => ['superadmin', 'admin']
]);
Route::get('admin/add-job-vacancy', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@AddJobVacancy',
]);
Route::get('admin/manage-jobs', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@manageJobList',
]);
Route::get('/admin/edit-job/{id}', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@editJobData',
]);
Route::get('/admin/manage-job-applications', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@manageJobApplicaitonsRecords',
]);
Route::get('/admin/view-application-details/{id}', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@ViewJobApplicationDetails',
]);
Route::get('admin/manage-header-menu', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@manageHeaderMenu',
]);
Route::get('admin/manage-footer-menu', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@manageFooterMenu',
]);
Route::get('admin/edit-header-menu/{id?}', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@EditHeaderMenu',
]);
Route::get('admin/edit-footer-menu/{id?}', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@EditFooterMenu',
]);
Route::get('admin/add-new-header-menu', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@addNewHeaderMenu',
]);
Route::get('admin/add-new-footer-menu', [
    'middleware' => ['admin'],
    'uses' => 'AdminController@addNewFooterMenu',
]);

Route::match(['get', 'post'], '/admin/manage-user-detail/{id?}', 'AdminController@manageUserDetailBySlug')->middleware('admin');
Route::match(['get', 'post'], '/admin/add-new-user', 'AdminController@addNewUser')->middleware('admin');

Route::match(['get', 'post'], '/admin/check-email-exsit', 'AdminController@checkEmailExists')->middleware('admin');
Route::match(['get', 'post'], 'admin/system-setting', 'AdminController@systemSetting')->middleware('admin');
Route::match(['get', 'post'], 'admin/updateSetting/{id}', 'AdminController@manageSystemSetting')->middleware('admin');
Route::match(['get', 'post'], 'admin/mange-system-setting', 'AdminController@updateSystemSetting')->middleware('admin');

//////////////////Admin Routes///////////////////////////
//////////////////Front End Routes///////////////////////
Route::get('/', 'HomeController@index')->middleware('CheckMaintenance');
Route::get('/home', 'HomeController@index')->middleware('CheckMaintenance');
Route::get('/index', 'HomeController@index')->middleware('CheckMaintenance');
Route::get('/', 'HomeController@index')->middleware('CheckMaintenance');
Route::post('contact-us-submit', 'HomeController@submitContactUs')->middleware('CheckMaintenance');
Route::post('save-business-partner-details', 'HomeController@submitBusinessPartner')->middleware('CheckMaintenance');
Route::post('blog-filter', 'HomeController@blogFilter')->middleware('CheckMaintenance');
Route::get('maintenance-mode', 'HomeController@maintenanceMode')->middleware('CheckMaintenanceModeEnable');
Route::get('404-page', 'HomeController@pageNotFound');
Route::post('blog-filter-session', 'HomeController@blogFilterSession');
Route::post('blog-keyword-search-session', 'HomeController@blogKeywordSearchSession');
Route::post('job-application', 'HomeController@jobApplication');
Route::get('/{segment1}', 'HomeController@render')->middleware('CheckMaintenance');
Route::get('/{segment1}/{segment2}', 'HomeController@renderSubPart')->middleware('CheckMaintenance');
