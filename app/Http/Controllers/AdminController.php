<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\postModel;
use App\User;
use App\clientTestimonial;
use App\Blog;
use App\contactUsModel;
use App\BlogCategories;
use App\portfolio;
use App\businessPartner;
use App\jobApplications;
use App\systemSettingModel;
use App\AccessControl;
use App\jobCategories;
use App\headerMenuModel;
use App\footerMenuModel;
use App\jobs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Input;
use File;
use DB;
use Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class AdminController extends parentController {

    public function __construct() {
        
    }

    /*     * **
     * Redirect to login 
     */

    public function index() {
        
        return view('admin.login');
    }

    /*     * **
     * Home page
     */

    public function home() {
     
        /*         * *
         * Get portfolio categories
         * UserInfo
         */
        $pages = count($this->getPosts("page", 0));
        $adminRole = count($this->getUserParticularTypeUsers("admin"));
        $otherRole = count($this->getUserParticularTypeUsers("others"));
        /*         * *
         * get count info.
         */
        $userCount = User::where("usertype", "!=", "superadmin")->count();
        $postCount = postModel::where("post_type", "!=", "page")->count();
        $blogs = Blog::all()->count();
        $textTestimonial = $this->getClientTestimonial(0, 'text');
        $videoTestimonial = $this->getClientTestimonial(0, 'video');
        $videoTestimonial = $this->getClientTestimonial(0, 'video');
        $jobApplications = jobApplications::where("status", "active")->count();
        $contactUsRecords = contactUsModel::all()->count();

        $dataCount = array(
            "userCount" => $userCount,
            "pages" => $pages,
            "postCount" => $postCount,
            "blogs" => $blogs,
            "textTestimonial" => count($textTestimonial),
            "videoTestimonial" => count($videoTestimonial),
            "contactRecords" => $contactUsRecords,
            "jobApplications" => $jobApplications,
        );

        $dataArray = array("pages" => $pages, "dataCount" => $dataCount, "adminRole" => $adminRole, "otherRole" => $otherRole);
        return view('admin.home', ["dataArray" => $dataArray]);
    }

    /*     * *
     * manage pages
     */

    public function managePages() {
        /*         * *
         * Get portfolio categories
         * UserInfo
         */
        $managePagesData = $this->getPosts("page", 0, 'yes');

        $dataArray = array("managePagesData" => $managePagesData);
        return view('admin.manage-pages', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Public function
     */

    public function editPagesPostDetails($slug = '') {
        $postDetails = $this->getPostDetailBySlug($slug);
        $dataArray = array("postDetails" => $postDetails);
        return view('admin.manage-pages-details', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Public function
     */

    public function editPostDetails($slug = '') {
        $ServiceData = $this->getPosts("service");

        $postDetails = $this->getPostDetailBySlug($slug);
        $dataArray = array("postDetails" => $postDetails, "ServiceData" => $ServiceData);
        return view('admin.manage-post-details', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Manage Users
     */

    public function manageUsers() {
        $userList = $this->getUserList();
        $dataArray = array("userList" => $userList);
        return view('admin.manage-users', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Manage Posts
     */

    public function managePosts() {
        $postList = $this->getPostList();
        $dataArray = array("managePostData" => $postList);
        return view('admin.manage-posts', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Manage USer
     */

    public function manageUserDetailBySlug(Request $request, $slug = '') {
        $method = $request->method();

        if ($request->isMethod('post')) {
            $userId = $_POST["userId"];

            /*             * **
             * Check image is updated or not
             */
            $profie_image = '';

            if (isset($_FILES["profie_image"]) && !empty($_FILES["profie_image"]["name"])) {

                $image = $_FILES["profie_image"];
                $filename1 = "150x150_" . time() . $_FILES["profie_image"]["name"];
                $filename2 = "250x250_" . time() . $_FILES["profie_image"]["name"];
                $filename3 = "640x640_" . time() . $_FILES["profie_image"]["name"];
                $profie_image = time() . $_FILES["profie_image"]["name"];
                $path1 = public_path('uploads/userProfile/' . $filename1);
                $path2 = public_path('uploads/userProfile/' . $filename2);
                $path3 = public_path('uploads/userProfile/' . $filename3);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(150, 150)->save($path1);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(250, 250)->save($path2);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(640, 640)->save($path3);
            } else if (isset($_POST["prev_profie_image"]) && !empty($_POST["prev_profie_image"])) {
                $profie_image = $_POST["prev_profie_image"];
            } else {
                $profie_image = 'default-img.png';
            }
            $userData = User::find($userId);
            $userData->firstname = $_POST["first_name"];
            $userData->lastname = $_POST["last_name"];
            $userData->country = $_POST["country"];
            $userData->state = $_POST["state"];
            $userData->city = $_POST["city"];
            $userData->zipcode = $_POST["zipcode"];
            $userData->address1 = $_POST["address1"];
            $userData->address2 = $_POST["address2"];
            $userData->timezone = $_POST["timezone"];
            $userData->profie_image = $profie_image;
            $userData->status = $_POST["status"];
            $userData->gender = $_POST["gender"];
            $userData->updated_at = date("Y-m-d H:i:s");
            $userData->save();
            Session::flash('message', "User update successfully saved");
            return Redirect('admin/manage-user-detail/' . $_POST["userslug"]);
        } else {
            $userData = $this->getUserDetailBySlug($slug);
            $dataArray = array("userData" => $userData);
            return view('admin.manage-user-details', ["dataArray" => $dataArray]);
        }
    }

    /*     * *
     * Add new user
     */

    public function addNewUser(Request $request) {
        $method = $request->method();

        if ($request->isMethod('post')) {
            /*             * **
             * Check image is updated or not
             */
            $profie_image = '';

            if (isset($_FILES["profie_image"]) && !empty($_FILES["profie_image"]["name"])) {

                $image = $_FILES["profie_image"];
                $filename1 = "150x150_" . time() . $_FILES["profie_image"]["name"];
                $filename2 = "250x250_" . time() . $_FILES["profie_image"]["name"];
                $filename3 = "640x640_" . time() . $_FILES["profie_image"]["name"];
                $profie_image = time() . $_FILES["profie_image"]["name"];
                $path1 = public_path('uploads/userProfile/' . $filename1);
                $path2 = public_path('uploads/userProfile/' . $filename2);
                $path3 = public_path('uploads/userProfile/' . $filename3);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(150, 150)->save($path1);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(250, 250)->save($path2);
                Image::make($_FILES["profie_image"]["tmp_name"])->resize(640, 640)->save($path3);
            } else if (isset($_POST["prev_profie_image"]) && !empty($_POST["prev_profie_image"])) {
                $profie_image = $_POST["prev_profie_image"];
            } else {
                $profie_image = 'default-img.png';
            }
            /*             * **
             * Create User Slug
             */

            $user_slug = $this->createUserSlug($_POST["first_name"], $_POST["last_name"]);


            $userData = new User;
            $userData->firstname = $_POST["first_name"];
            $userData->lastname = $_POST["last_name"];
            $userData->name = $_POST["first_name"] . " " . $_POST["last_name"];
            $userData->email = $_POST["email"];
            $userData->password = bcrypt($_POST["email"]);
            $userData->country = $_POST["country"];
            $userData->state = $_POST["state"];
            $userData->city = $_POST["city"];
            $userData->zipcode = $_POST["zipcode"];
            $userData->address1 = $_POST["address1"];
            $userData->address2 = $_POST["address2"];
            $userData->timezone = $_POST["timezone"];
            $userData->profie_image = $profie_image;
            $userData->status = $_POST["status"];
            $userData->gender = $_POST["gender"];
            $userData->user_slug = $user_slug;
            $userData->usertype = $_POST["usertype"];
            $userData->created_at = date("Y-m-d H:i:s");
            $userData->save();
            Session::flash('message', "User added successfully saved");
            return Redirect('admin/manage-users');
        } else {
            return view('admin.add-new-user');
        }
    }

    /*     * **
     * Check Email is Exists
     */

    public function checkEmailExists() {
        $email = $_POST["email"];
        $count = $emailData = User::where("email", $email)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    /*     * **
     * Edit User Profile
     */

    public function editUser() {
        $user_slug = Auth::user()->user_slug;
        $userData = $this->getUserDetailBySlug($user_slug);
        $dataArray = array("userData" => $userData);
        return view('admin.edit-profile', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Function to create User Slug
     */

    public function createUserSlug($firstname = 'test', $lastname = 'test') {
        return $firstname . "-" . $lastname . "-" . time();
    }

    /*     * *
     * Function for Access Control
     */

    public function accessControl() {
        $userData = $this->getUserPermissions('');
        $adminArray = array();
        $userArray = array();
        if (isset($userData["admin"]) && !empty($userData["admin"])) {
            $adminArray = $userData["admin"];
        }
        if (isset($userData["users"]) && !empty($userData["users"])) {
            $userArray = $userData["users"];
        }

        $dataArray = array("userData" => $userArray, "adminData" => $adminArray);
        return view('admin.access-control', ["dataArray" => $dataArray]);
    }

    /*     * **
     *  Function for access control
     */

    public function accessManagement() {
        $admin_array = array();
        $user_array = array();

        if (isset($_POST["blog_admin"]) && $_POST["blog_admin"] == 1) {
            $admin_array[] = 'blog';
        }
        if (isset($_POST["page_admin"]) && $_POST["page_admin"] == 1) {
            $admin_array[] = 'pages';
        }
        if (isset($_POST["user_admin"]) && $_POST["user_admin"] == 1) {
            $admin_array[] = 'users';
        }
        if (isset($_POST["blog_other"]) && $_POST["blog_other"] == 1) {
            $user_array[] = 'blog';
        }
        if (isset($_POST["page_other"]) && $_POST["page_other"] == 1) {
            $user_array[] = 'pages';
        }
        if (isset($_POST["user_other"]) && $_POST["user_other"] == 1) {
            $user_array[] = 'users';
        }

        /*         * *
         * update the user 
         */
        AccessControl::truncate();

        $AccessControlAdminData = new AccessControl;
        $AccessControlAdminData->user_type = 'admin';
        $AccessControlAdminData->permissions = json_encode($admin_array);
        $AccessControlAdminData->created_at = date("Y-m-d H:i:s");
        $AccessControlAdminData->save();

        $AccessControlUserData = new AccessControl;
        $AccessControlUserData->user_type = 'others';
        $AccessControlUserData->permissions = json_encode($user_array);
        $AccessControlUserData->created_at = date("Y-m-d H:i:s");
        $AccessControlUserData->save();
        Session::flash('message', "Permissions saved successfully");
        return Redirect('admin/access-control');
    }

    /*     * *
     * Get Permission records
     */

    public function getUserPermissions() {
        $data = AccessControl::all();
        $user_data = array();
        foreach ($data as $key => $val) {
            if ($val->user_type == 'admin') {
                $user_data["admin"] = json_decode($val->permissions);
            } else {
                $user_data["users"] = json_decode($val->permissions);
            }
        }
        return $user_data;
    }

    /*     * *
     * Check user Authorties
     */

    public function getPermissions($userRole = '') {
        $data = AccessControl::where("user_type", $userRole)->get();
        return json_decode($data->permissions);
    }

    /*     * *
     * Function to update the page type post detais
     */

    public function managePagePostDetails() {

        $banner_image = '';
        $postId = $_POST["postId"];
        if (isset($_FILES["post_bannerimg"]) && !empty($_FILES["post_bannerimg"]["name"])) {

            $image = $_FILES["post_bannerimg"];
            $filename1 = "1600x654_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename4 = "1600x548_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename2 = "250x250_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename3 = "640x640_" . time() . $_FILES["post_bannerimg"]["name"];
            $banner_image = time() . $_FILES["post_bannerimg"]["name"];
            $path1 = public_path('uploads/bannerImg/' . $filename1);
            $path2 = public_path('uploads/bannerImg/' . $filename2);
            $path3 = public_path('uploads/bannerImg/' . $filename3);
            $path4 = public_path('uploads/bannerImg/' . $filename4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 654)->save($path1);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 548)->save($path4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(250, 250)->save($path2);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(640, 640)->save($path3);
        } else if (isset($_POST["prev_feature_img"]) && !empty($_POST["prev_feature_img"])) {
            $banner_image = $_POST["prev_feature_img"];
        } else {
            $banner_image = 'default-img.jpg';
        }
        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';
        $data_array = array(
            "title" => $_POST["post_title"],
            "content" => trim($_POST["post_content"]),
            "banner" => $banner_image,
            "title1" => $_POST["post_title1"],
            "title2" => $_POST["post_title2"],
            "title3" => $_POST["post_title3"],
            "tagline" => $_POST["post_tagline"],
            "custom_slug" => $customSlug,
            "short_description" => trim($_POST["post_short_desc"]),
            "meta_title" => $_POST["post_meta_title"],
            "meta_keywords" => $_POST["post_meta_keywords"],
            "meta_description" => $_POST["post_meta_description"],
            "long_description" => trim($_POST["post_long_description"]),
            "updated_at" => date("Y-m-d H:i:s"),
            "status" => $_POST["post_status"],
        );
        $slug = $_POST["slug"];

        $result = $this->upatePostData($slug, $data_array);
        /*         * **
         * Delete the existing post meta values
         */
        $this->deletePostMetaData($postId);
//        /*         * **
//         * Setup Post meta data
//         */
        if (isset($_POST["meta_key"]) && !empty($_POST["meta_key"])) {
            foreach ($_POST["meta_key"] as $key => $val) {
                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $_POST["meta_val"][$key],
                    "postmeta_type" => 'text'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }

        if (isset($_POST["meta_file_key"]) && !empty($_POST["meta_file_key"])) {
            foreach ($_POST["meta_file_key"] as $key => $val) {

                if (isset($_FILES["meta_file_val"]["name"][$key]) && !empty($_FILES["meta_file_val"]["name"][$key])) {
                    $filename1 = "48x48_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $filename2 = "250x250_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $filename3 = "555x339_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $imageInfo = time() . $_FILES["meta_file_val"]["name"][$key];
                    $path1 = public_path('uploads/postmetaImg/' . $filename1);
                    $path2 = public_path('uploads/postmetaImg/' . $filename2);
                    $path3 = public_path('uploads/postmetaImg/' . $filename3);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(48, 48)->save($path1);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(250, 250)->save($path2);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(555, 339)->save($path3);
                } else {
                    $imageInfo = $_POST["meta_file_prev_val_" . $val];
                }

                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $imageInfo,
                    "postmeta_type" => 'image'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }

        Session::flash('message', "Data saved successfully");
        return Redirect('admin/edit-page-posts/' . $slug);
    }

    /*     * *
     * Function to update the page type post detais
     */

    public function managePostDetails() {

        $banner_image = '';
        $postId = $_POST["postId"];
        if (isset($_FILES["post_bannerimg"]) && !empty($_FILES["post_bannerimg"]["name"])) {

            $image = $_FILES["post_bannerimg"];
            $filename1 = "1600x654_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename4 = "1600x548_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename2 = "250x250_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename3 = "640x640_" . time() . $_FILES["post_bannerimg"]["name"];
            $banner_image = time() . $_FILES["post_bannerimg"]["name"];
            $path1 = public_path('uploads/bannerImg/' . $filename1);
            $path2 = public_path('uploads/bannerImg/' . $filename2);
            $path3 = public_path('uploads/bannerImg/' . $filename3);
            $path4 = public_path('uploads/bannerImg/' . $filename4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 654)->save($path1);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 548)->save($path4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(250, 250)->save($path2);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(640, 640)->save($path3);
        } else if (isset($_POST["prev_feature_img"]) && !empty($_POST["prev_feature_img"])) {
            $banner_image = $_POST["prev_feature_img"];
        } else {
            $banner_image = 'default-img.jpg';
        }
        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';
        $data_array = array(
            "title" => $_POST["post_title"],
            "content" => trim($_POST["post_content"]),
            "banner" => $banner_image,
            "custom_slug" => $customSlug,
            "post_type" => $_POST["post_category"],
            "title1" => $_POST["post_title1"],
            "title2" => $_POST["post_title2"],
            "title3" => $_POST["post_title3"],
            "tagline" => $_POST["post_tagline"],
            "short_description" => trim($_POST["post_short_desc"]),
            "meta_title" => $_POST["post_meta_title"],
            "meta_keywords" => $_POST["post_meta_keywords"],
            "meta_description" => $_POST["post_meta_description"],
            "long_description" => trim($_POST["post_long_description"]),
            "updated_at" => date("Y-m-d H:i:s"),
            "status" => $_POST["post_status"],
        );
        if (!empty($_POST["parent_service"])) {
            $data_array["parent_id"] = $_POST["parent_service"];
        }
        $slug = $_POST["slug"];

        $result = $this->upatePostData($slug, $data_array);
        /*         * **
         * Delete the existing post meta values
         */
        $this->deletePostMetaData($postId);
//        /*         * **
//         * Setup Post meta data
//         */
        if (isset($_POST["meta_key"]) && !empty($_POST["meta_key"])) {
            foreach ($_POST["meta_key"] as $key => $val) {
                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $_POST["meta_val"][$key],
                    "postmeta_type" => 'text'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }

        if (isset($_POST["meta_file_key"]) && !empty($_POST["meta_file_key"])) {
            foreach ($_POST["meta_file_key"] as $key => $val) {

                if (isset($_FILES["meta_file_val"]["name"][$key]) && !empty($_FILES["meta_file_val"]["name"][$key])) {
                    $filename1 = "48x48_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $filename2 = "250x250_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $filename3 = "555x339_" . time() . $_FILES["meta_file_val"]["name"][$key];
                    $imageInfo = time() . $_FILES["meta_file_val"]["name"][$key];
                    $path1 = public_path('uploads/postmetaImg/' . $filename1);
                    $path2 = public_path('uploads/postmetaImg/' . $filename2);
                    $path3 = public_path('uploads/postmetaImg/' . $filename3);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(48, 48)->save($path1);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(250, 250)->save($path2);
                    Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(555, 339)->save($path3);
                } else {
                    $imageInfo = $_POST["meta_file_prev_val_" . $val];
                }

                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $imageInfo,
                    "postmeta_type" => 'image'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }

        Session::flash('message', "Data saved successfully");
        return Redirect('admin/edit-posts/' . $slug);
    }

    /*     * **
     * Function to delete post
     */

    public function deletePost() {
        $postId = $_POST["post_id"];
        $result = $this->deletePostData($postId);
        return "sucess";
    }

    /*     * **
     * Function to delete user
     */

    public function deleteUser() {
        $userId = $_POST["user_id"];
        $data_array = array(
            "status" => "deleted",
            'updated_at' => date("Y-m-d H:i:s")
        );
        $result = $this->updateUserInfo($userId, $data_array);
        return "sucess";
    }

    /*     * **
     * Add New Page
     */

    public function addNewPagePost() {
        return view('admin.add-new-page');
    }

    /*     * **
     * Add New Post
     */

    public function addNewPost() {
        $ServiceData = $this->getPosts("service");

        $dataArray = array("ServiceData" => $ServiceData);

        return view('admin.add-new-post', array("dataArray" => $dataArray));
    }

    /*     * **
     * Add New Page
     */

    public function addPageDetails() {
        /*         * *
         * Set up Post Related data
         */

        $banner_image = '';
        if (isset($_FILES["post_bannerimg"]) && !empty($_FILES["post_bannerimg"]["name"])) {

            $image = $_FILES["post_bannerimg"];
            $filename1 = "1600x654_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename4 = "1600x548_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename2 = "250x250_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename3 = "640x640_" . time() . $_FILES["post_bannerimg"]["name"];
            $banner_image = time() . $_FILES["post_bannerimg"]["name"];
            $path4 = public_path('uploads/bannerImg/' . $filename4);
            $path1 = public_path('uploads/bannerImg/' . $filename1);
            $path2 = public_path('uploads/bannerImg/' . $filename2);
            $path3 = public_path('uploads/bannerImg/' . $filename3);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 548)->save($path4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 654)->save($path1);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(250, 250)->save($path2);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(640, 640)->save($path3);
        } else {
            $banner_image = 'default-img.jpg';
        }
        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';
        $postSlug = $this->customPostSlug($_POST["post_title"]);
        $postData = array(
            "user_id" => Auth::user()->id,
            "parent_id" => $_POST["post_title"],
            "content" => trim($_POST["post_content"]),
            "title" => $_POST["post_title"],
            "post_slug" => $postSlug,
            "custom_slug" => $customSlug,
            "post_type" => "page",
            "banner" => $banner_image,
            "title1" => $_POST["post_title1"],
            "title2" => $_POST["post_title2"],
            "title3" => $_POST["post_title3"],
            "tagline" => $_POST["post_tagline"],
            "short_description" => trim($_POST["post_short_desc"]),
            "long_description" => trim($_POST["post_long_description"]),
            "meta_title" => $_POST["post_meta_title"],
            "meta_keywords" => $_POST["post_meta_keywords"],
            "meta_description" => $_POST["post_meta_description"],
            "status" => $_POST["post_status"],
            "created_at" => date("Y-m-d H:i:s")
        );
        $postId = $this->savePost($postData);

        /*         * **
         * Setup Post meta data
         */
        if (isset($_POST["meta_key"]) && !empty($_POST["meta_key"])) {
            foreach ($_POST["meta_key"] as $key => $val) {
                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $_POST["meta_val"][$key],
                    "postmeta_type" => 'text'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }
        if (isset($_POST["meta_file_key"]) && !empty($_POST["meta_file_key"])) {
            foreach ($_POST["meta_file_key"] as $key => $val) {

                $filename1 = "48x48_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $filename2 = "250x250_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $filename3 = "555x339_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $imageInfo = time() . $_FILES["meta_file_val"]["name"][$key];
                $path1 = public_path('uploads/postmetaImg/' . $filename1);
                $path2 = public_path('uploads/postmetaImg/' . $filename2);
                $path3 = public_path('uploads/postmetaImg/' . $filename3);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(48, 48)->save($path1);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(250, 250)->save($path2);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(555, 339)->save($path3);



                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $imageInfo,
                    "postmeta_type" => 'image'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }
        Session::flash('message', "Post saved successfully!");
        return Redirect('/admin/manage-pages');
    }

    /*     * **
     * Add New Post
     */

    public function addPostDetails() {
        /*         * *
         * Set up Post Related data
         */

        $banner_image = '';
        if (isset($_FILES["post_bannerimg"]) && !empty($_FILES["post_bannerimg"]["name"])) {

            $image = $_FILES["post_bannerimg"];
            $filename1 = "1600x654_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename4 = "1600x548_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename2 = "250x250_" . time() . $_FILES["post_bannerimg"]["name"];
            $filename3 = "640x640_" . time() . $_FILES["post_bannerimg"]["name"];
            $banner_image = time() . $_FILES["post_bannerimg"]["name"];
            $path1 = public_path('uploads/bannerImg/' . $filename1);
            $path2 = public_path('uploads/bannerImg/' . $filename2);
            $path4 = public_path('uploads/bannerImg/' . $filename4);
            $path3 = public_path('uploads/bannerImg/' . $filename3);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 548)->save($path4);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(1600, 654)->save($path1);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(250, 250)->save($path2);
            Image::make($_FILES["post_bannerimg"]["tmp_name"])->resize(640, 640)->save($path3);
        } else {
            $banner_image = 'default-img.jpg';
        }

        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';

        $postSlug = $this->customPostSlug($_POST["post_title"]);


        $postData = array(
            "user_id" => Auth::user()->id,
            "parent_id" => $_POST["post_title"],
            "content" => trim($_POST["post_content"]),
            "title" => $_POST["post_title"],
            "parent_id" => isset($_POST["parent_service"]) ? $_POST["parent_service"] : 0,
            "post_slug" => $postSlug,
            "custom_slug" => $customSlug,
            "post_type" => $_POST["post_category"],
            "banner" => $banner_image,
            "title1" => $_POST["post_title1"],
            "title2" => $_POST["post_title2"],
            "title3" => $_POST["post_title3"],
            "tagline" => $_POST["post_tagline"],
            "short_description" => trim($_POST["post_short_desc"]),
            "long_description" => trim($_POST["post_long_description"]),
            "meta_title" => $_POST["post_meta_title"],
            "meta_keywords" => $_POST["post_meta_keywords"],
            "meta_description" => $_POST["post_meta_description"],
            "status" => $_POST["post_status"],
            "created_at" => date("Y-m-d H:i:s")
        );
        $postId = $this->savePost($postData);

        /*         * **
         * Setup Post meta data
         */
        if (isset($_POST["meta_key"]) && !empty($_POST["meta_key"])) {
            foreach ($_POST["meta_key"] as $key => $val) {
                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $_POST["meta_val"][$key],
                    "postmeta_type" => 'text'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }
        if (isset($_POST["meta_file_key"]) && !empty($_POST["meta_file_key"])) {
            foreach ($_POST["meta_file_key"] as $key => $val) {

                $filename1 = "48x48_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $filename2 = "250x250_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $filename3 = "555x339_" . time() . $_FILES["meta_file_val"]["name"][$key];
                $imageInfo = time() . $_FILES["meta_file_val"]["name"][$key];
                $path1 = public_path('uploads/postmetaImg/' . $filename1);
                $path2 = public_path('uploads/postmetaImg/' . $filename2);
                $path3 = public_path('uploads/postmetaImg/' . $filename3);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(48, 48)->save($path1);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(250, 250)->save($path2);
                Image::make($_FILES["meta_file_val"]["tmp_name"][$key])->resize(555, 339)->save($path3);



                $postMetaData = array(
                    "post_key" => $val,
                    "post_value" => $imageInfo,
                    "postmeta_type" => 'image'
                );
                $this->addPostMeta($postId, $postMetaData);
            }
        }
        Session::flash('message', "Post saved successfully!");
        return Redirect('/admin/manage-posts');
    }

    /*     * **
     * Check Post Custom URL
     */

    public function customUrlCheck() {
        $postedURL = $_POST["check_url"];
        $record = postModel::where("post_slug", $postedURL)->get();
        if (count($record) > 0) {
            echo "exists";
        } else {
            echo "ok";
        }
        die;
    }

    /**
     * To check post slug exists
     */
    public function CheckPostSlugISExists($postSlug) {
        $record = postModel::where("post_slug", $postSlug)->get();
        if (count($record) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * To check post slug exists
     */
    public function CheckBlogSlugISExists($postSlug) {
        $record = Blog::where("blog_slug", $postSlug)->get();
        if (count($record) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*     * **
     * Check Post Slug
     */

    public function customBlogSlug($title) {

        $blogSlug = strtolower(str_replace(" ", "-", $title));
        $check = 1;
        while ($check != 0) {

            $result = $this->CheckBlogSlugISExists($blogSlug);
            if ($result) {
                $blogSlug = $blogSlug . "-" . $check;
                $check++;
            } else {
                $check = 0;
            }
        }
        return $blogSlug;
    }

    /*     * *
     * Create blog slug
     */

    public function customPostSlug($title) {

        $postSlug = strtolower(str_replace(" ", "-", $title));
        $check = 1;
        while ($check != 0) {

            $result = $this->CheckPostSlugISExists($postSlug);
            if ($result) {
                $postSlug = $postSlug . "-" . $check;
                $check++;
            } else {
                $check = 0;
            }
        }
        return $postSlug;
    }

    /*     * *
     * System Setting
     */

    public function systemSetting() {
        /*         * *
         * Get system Settings
         */
        $settingData = systemSettingModel::all();
        $maintanceData = $this->checkSiteMode();

        $dataArray = array("settingData" => $settingData, "maintanceData" => $maintanceData);
        return view('admin.system-setting', ["dataArray" => $dataArray]);
    }

    /*     * *
     * get system settings
     */

    public function manageSystemSetting($id) {
        /*         *
         * Function to get system settings
         * *
         *  */
        $settingData = systemSettingModel::find($id);

        $dataArray = array("settingData" => $settingData);
        return view('admin.manage-system-setting', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Update setting details
     */

    public function updateSystemSetting() {
        $id = $_POST["setting_id"];
        if ($_POST["prev_setting_type"] == 'image') {
            if (isset($_FILES["setting_Img"]) && !empty($_FILES["setting_Img"])) {
                $description = time() . $_FILES["setting_Img"]["name"];
                $path = public_path('uploads/systemImg/' . $description);
                Image::make($_FILES["setting_Img"]["tmp_name"])->save($path);
            } else {
                $description = $_POST["prev_system_img"];
            }
        } else {
            $description = $_POST["description"];
        }
        $dataArray = array(
            "key" => $_POST["key"],
            "value" => $_POST["setting_value"],
            "extra_info" => $description,
            "status" => $_POST["setting_status"],
            "updated_at" => date("Y-m-d H:i:s"),
            "setting_type" => $_POST["prev_setting_type"]);
        $this->UpdateSystemSettings($id, $dataArray);
        Session::flash('message', "Setting saved successfully!");
        return Redirect('admin/updateSetting/' . $id);
    }

    /*     * *
     * Update the maintanice Settings
     */

    public function updateMaintaniceMode() {
        $dataArray = array(
            "value" => $_POST["data"],
            "updated_at" => date("Y-m-d H:i:s")
        );
        DB::table("tbl_system_setting")->where("key", "maintaince_mode")->update($dataArray);
        echo "success";
        die;
    }

    /*     * *
     * Change Password Page
     */

    public function changePassword() {
        return view('admin.change-password');
    }

    /*     * *
     * Update  password
     */

    public function changePasswordData() {
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $re_password = $_POST["re_password"];
        $data = User::find(Auth::user()->id);

        if (Hash::check($old_password, $data->password)) {

            $userPass = bcrypt($new_password);
            $dataUser = User::find(Auth::user()->id);
            $dataUser->password = $userPass;
            $dataUser->updated_at = date("Y-m-d H:i:s");
            $dataUser->save();
            Session::flash('message', "Password updated successfully!");
            return Redirect('admin/change-password/');
        } else {
            return Redirect::back()->withInput()->withErrors(array('old_password' => "You have enter invaild current password."));
        }
    }

    /*     * **
     * Manage Testimonial
     */

    public function manageTestinomialList() {
        /*         *
         * Function to get Testmonial List
         * *
         *  */
        $testimonialData = clientTestimonial::all();

        $dataArray = array("testimonialData" => $testimonialData);
        return view('admin.manage-testimonial', ["dataArray" => $dataArray]);
    }

    /**
     * Add new Testinomial
     */
    public function addNewTestinomial() {
        return view('admin.add-new-testimonial');
    }

    /*     * *
     * Add new testmonial
     */

    public function addNewTestinomialData() {

        $profie_image = '';
        if (isset($_FILES["profie_image"]) && !empty($_FILES["profie_image"]["name"])) {

            $image = $_FILES["profie_image"];
            $filename1 = "555x339_" . time() . $_FILES["profie_image"]["name"];
            $filename2 = "300x223_" . time() . $_FILES["profie_image"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["profie_image"]["name"];
            $profie_image = time() . $_FILES["profie_image"]["name"];
            $path1 = public_path('uploads/client-profile-img/' . $filename1);
            $path2 = public_path('uploads/client-profile-img/' . $filename2);
            $path3 = public_path('uploads/client-profile-img/' . $filename3);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(555, 339)->save($path1);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(300, 223)->save($path2);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(111, 111)->save($path3);
        } else {
            $profie_image = 'default-img.png';
        }

        $project_image = '';
        if (isset($_FILES["project_image"]) && !empty($_FILES["project_image"]["name"])) {

            $image = $_FILES["project_image"];
            $filename1 = "842x372_" . time() . $_FILES["project_image"]["name"];
            $filename2 = "300x223_" . time() . $_FILES["project_image"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["project_image"]["name"];
            $project_image = time() . $_FILES["project_image"]["name"];
            $path1 = public_path('uploads/client-project-img/' . $filename1);
            $path2 = public_path('uploads/client-project-img/' . $filename2);
            $path3 = public_path('uploads/client-project-img/' . $filename3);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(842, 372)->save($path1);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(300, 223)->save($path2);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(111, 111)->save($path3);
        } else {
            $project_image = 'default-img.jpg';
        }
        $client_name = $_POST['client_name'];
        $client_address = $_POST['client_address'];
        $feedbacks = $_POST['feedbacks'];
        $projectUrl = $_POST['projectUrl'];
        $testimonial_type = $_POST['testimonial_type'];
        $videoUrl = $_POST['videoUrl'];
        $status = $_POST['status'];
        if ($testimonial_type == 'text') {
            $videoUrl = '';
        }

        $clientData = new clientTestimonial;
        $clientData->client_name = $client_name;
        $clientData->client_address = $client_address;
        $clientData->client_profilImg = $profie_image;
        $clientData->projectImg = $project_image;
        $clientData->feedbacks = $feedbacks;
        $clientData->projectUrl = $projectUrl;

        $clientData->status = $status;
        $clientData->testimonial_type = $testimonial_type;
        $clientData->videoUrl = $videoUrl;
        $clientData->created_at = date("Y-m-d H:i:s");
        $clientData->save();

        Session::flash('message', "Testimonial saved successfully!");
        return Redirect('admin/manage-testimonial');
    }

    /*     * *
     * manage testimonial
     */

    public function manageTestinomialDetails($testimonialId) {
        /*         * *
         * Get testimonial details
         */
        $testimonialData = clientTestimonial::find($testimonialId);
        $dataArray = array("testimonialData" => $testimonialData);
        return view('admin/edit-testimonial-details', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Edit Testimonial data
     */

    public function editTestinomialDetails() {
        $profie_image = '';
        if (isset($_FILES["profie_image"]) && !empty($_FILES["profie_image"]["name"])) {

            $image = $_FILES["profie_image"];
            $filename1 = "555x339_" . time() . $_FILES["profie_image"]["name"];
            $filename2 = "300x223_" . time() . $_FILES["profie_image"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["profie_image"]["name"];
            $profie_image = time() . $_FILES["profie_image"]["name"];
            $path1 = public_path('uploads/client-profile-img/' . $filename1);
            $path2 = public_path('uploads/client-profile-img/' . $filename2);
            $path3 = public_path('uploads/client-profile-img/' . $filename3);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(555, 339)->save($path1);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(300, 223)->save($path2);
            Image::make($_FILES["profie_image"]["tmp_name"])->resize(111, 111)->save($path3);
        }


        $project_image = '';
        if (isset($_FILES["project_image"]) && !empty($_FILES["project_image"]["name"])) {

            $image = $_FILES["project_image"];
            $filename1 = "842x372_" . time() . $_FILES["project_image"]["name"];
            $filename2 = "300x223_" . time() . $_FILES["project_image"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["project_image"]["name"];
            $project_image = time() . $_FILES["project_image"]["name"];
            $path1 = public_path('uploads/client-project-img/' . $filename1);
            $path2 = public_path('uploads/client-project-img/' . $filename2);
            $path3 = public_path('uploads/client-project-img/' . $filename3);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(842, 372)->save($path1);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(300, 223)->save($path2);
            Image::make($_FILES["project_image"]["tmp_name"])->resize(111, 111)->save($path3);
        }
        $client_name = $_POST['client_name'];
        $client_address = $_POST['client_address'];
        $feedbacks = $_POST['feedbacks'];
        $projectUrl = $_POST['projectUrl'];
        $testimonial_type = $_POST['testimonial_type'];


        $videoUrl = $_POST['videoUrl'];
        if ($testimonial_type == 'text') {
            $videoUrl = '';
        }
        $status = $_POST['status'];
        $testimonialId = $_POST['testimonialId'];


        $clientData = clientTestimonial::find($testimonialId);
        $clientData->client_name = $client_name;
        $clientData->client_address = $client_address;

        if (!empty($profie_image)) {
            $clientData->client_profilImg = $profie_image;
        }
        if (!empty($project_image)) {
            $clientData->projectImg = $project_image;
        }
        $clientData->feedbacks = $feedbacks;
        $clientData->projectUrl = $projectUrl;
        $clientData->status = $status;
        $clientData->testimonial_type = $testimonial_type;
        $clientData->videoUrl = $videoUrl;

        $clientData->updated_at = date("Y-m-d H:i:s");
        $clientData->save();

        Session::flash('message', "Testimonial updated successfully!");
        return Redirect('admin/manage-testimonial-detail/' . $testimonialId);
    }

    /*     * *
     * Delete testimonial
     */

    public function deleteTestinomial() {


        $testinomialId = $_POST["testimonialId"];

        $clientData = clientTestimonial::find($testinomialId);
        $clientData->delete();
        echo "success";
        die;
    }

    /*     * *
     * Manage Blog
     */

    public function manageBlog() {
        /*         * *
         * Get testimonial details
         */
        $BlogData = Blog::all();
        foreach ($BlogData as $key => $val) {
            $category_data = BlogCategories::find($val->category_id);
            $BlogData[$key]->category_data = $category_data;
        }
        //->category_data->data
        $dataArray = array("BlogData" => $BlogData);
        return view('admin/manage-blogs', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Manage Blog
     */

    public function editBlogData($blogSlug) {
        /*         * *
         * Get testimonial details
         */
        $BlogData = Blog::where("blog_slug", $blogSlug)->get();
        $blogCategories = $this->getBlogCategories();
        $dataArray = array("blogCategories" => $blogCategories, "BlogData" => $BlogData);
        return view('admin/edit-blog', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Manage portfolio
     */

    public function managePortfolio() {
        $PortfolioData = portfolio::all();
        foreach ($PortfolioData as $key => $val) {
            $data = postModel::find($val->category_id);
            $PortfolioData[$key]->category_data = $data;
        }

        $dataArray = array("PortfolioData" => $PortfolioData);
        return view('admin/manage-portfolio', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Manage portfolio
     */

    public function addNewPortfolio() {
        $portfolioData = $this->getPosts("portfolio-category", 0, '');

        $dataArray = array("portfolioData" => $portfolioData);
        return view('admin/add-new-portfolio', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Manage Blog
     */

    public function addNewBlog() {
        $blogCategories = $this->getBlogCategories();

        $dataArray = array("blogCategories" => $blogCategories);
        return view('admin/add-new-blog', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Add Portfolio
     */

    public function addNewPortfolioForm() {

        $portfolio_image = '';
        if (isset($_FILES["portfolioImg"]) && !empty($_FILES["portfolioImg"]["name"])) {

            $image = $_FILES["portfolioImg"];
            $filename1 = "842x372_" . time() . $_FILES["portfolioImg"]["name"];
            $filename2 = "512x298_" . time() . $_FILES["portfolioImg"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["portfolioImg"]["name"];
            $filename4 = "1058x645_" . time() . $_FILES["portfolioImg"]["name"];
            $portfolio_image = time() . $_FILES["portfolioImg"]["name"];
            $path1 = public_path('uploads/portfolioImg/' . $filename1);
            $path2 = public_path('uploads/portfolioImg/' . $filename2);
            $path3 = public_path('uploads/portfolioImg/' . $filename3);
            $path4 = public_path('uploads/portfolioImg/' . $filename4);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(842, 372)->save($path1);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(512, 298)->save($path2);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(111, 111)->save($path3);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(1058, 645)->save($path4);
        }
        $portfolioData = new portfolio;
        $portfolioData->title = $_POST["portfolio_title"];
        $portfolioData->category_id = $_POST["portfolio_category"];
        $portfolioData->portfolioImg = $portfolio_image;
        $portfolioData->projectUrl = $_POST["projectUrl"];
        $portfolioData->status = $_POST["post_status"];
        $portfolioData->created_at = date("Y-m-d H:i:s");
        $portfolioData->save();
        Session::flash('message', "Portfolio added successfully!");
        return Redirect('admin/manage-portfolio');
    }

    /*     * *
     * Edit portfolio
     */

    public function editPortfolioDetails($id) {

        $data = portfolio::find($id);

        $portfolioData = $this->getPosts("portfolio-category", 0, '');
        $dataArray = array("data" => $data, "portfolioData" => $portfolioData);
        return view('admin/edit-portfolio-detail', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Update portfolio
     */

    public function updatePortfolioDetails() {
        $portfolio_id = $_POST['portfolio_id'];
        $portfolio_image = '';
        if (isset($_FILES["portfolioImg"]) && !empty($_FILES["portfolioImg"]["name"])) {

            $image = $_FILES["portfolioImg"];
            $filename1 = "842x372_" . time() . $_FILES["portfolioImg"]["name"];
            $filename2 = "512x298_" . time() . $_FILES["portfolioImg"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["portfolioImg"]["name"];
            $filename4 = "1058x645_" . time() . $_FILES["portfolioImg"]["name"];
            $portfolio_image = time() . $_FILES["portfolioImg"]["name"];
            $path1 = public_path('uploads/portfolioImg/' . $filename1);
            $path2 = public_path('uploads/portfolioImg/' . $filename2);
            $path3 = public_path('uploads/portfolioImg/' . $filename3);
            $path4 = public_path('uploads/portfolioImg/' . $filename4);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(842, 372)->save($path1);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(512, 298)->save($path2);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(111, 111)->save($path3);
            Image::make($_FILES["portfolioImg"]["tmp_name"])->resize(1058, 645)->save($path4);
        }
        $portfolioData = portfolio::find($portfolio_id);
        $portfolioData->title = $_POST["portfolio_title"];
        $portfolioData->category_id = $_POST["portfolio_category"];
        if (!empty($portfolio_image)) {
            $portfolioData->portfolioImg = $portfolio_image;
        }
        $portfolioData->projectUrl = $_POST["projectUrl"];
        $portfolioData->status = $_POST["post_status"];
        $portfolioData->updated_at = date("Y-m-d H:i:s");
        $portfolioData->save();
        Session::flash('message', "Portfolio updated successfully!");
        return Redirect('admin/edit-portfolio/' . $portfolio_id);
    }

    /*     * **
     * Add new Blog
     */

    public function addBlogData() {


        $blog_image = '';
        if (isset($_FILES["blog_bannerimg"]) && !empty($_FILES["blog_bannerimg"]["name"])) {

            $image = $_FILES["blog_bannerimg"];
            $filename1 = "781x374_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename2 = "512x298_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename4 = "272x268_" . time() . $_FILES["blog_bannerimg"]["name"];
            $blog_image = time() . $_FILES["blog_bannerimg"]["name"];
            $path1 = public_path('uploads/blogImg/' . $filename1);
            $path2 = public_path('uploads/blogImg/' . $filename2);
            $path3 = public_path('uploads/blogImg/' . $filename3);
            $path4 = public_path('uploads/blogImg/' . $filename4);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(781, 374)->save($path1);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(512, 298)->save($path2);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(111, 111)->save($path3);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(272, 268)->save($path4);
        }
        $blogSlug = $this->customBlogSlug($_POST["blog_title"]);

        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';
        $blogData = new Blog;
        $blogData->title = $_POST["blog_title"];
        $blogData->category_id = $_POST["blog_category"];
        $blogData->blogImg = $blog_image;
        $blogData->description = $_POST["blog_content"];
        $blogData->blog_slug = $blogSlug;
        $blogData->postedBy = Auth::user()->id;
        $blogData->custom_url = $customSlug;
        $blogData->status = $_POST["blog_status"];
        $blogData->created_at = date("Y-m-d H:i:s");
        $blogData->save();
        Session::flash('message', "Blog added successfully!");
        return Redirect('admin/manage-blog');
    }

    /*     * **
     * edit Blog
     */

    public function editBlogDataDetails() {


        $blog_image = '';
        if (isset($_FILES["blog_bannerimg"]) && !empty($_FILES["blog_bannerimg"]["name"])) {

            $image = $_FILES["blog_bannerimg"];
            $filename1 = "781x374_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename2 = "512x298_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename3 = "111x111_" . time() . $_FILES["blog_bannerimg"]["name"];
            $filename4 = "272x268_" . time() . $_FILES["blog_bannerimg"]["name"];
            $blog_image = time() . $_FILES["blog_bannerimg"]["name"];
            $path1 = public_path('uploads/blogImg/' . $filename1);
            $path2 = public_path('uploads/blogImg/' . $filename2);
            $path3 = public_path('uploads/blogImg/' . $filename3);
            $path4 = public_path('uploads/blogImg/' . $filename4);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(781, 374)->save($path1);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(512, 298)->save($path2);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(111, 111)->save($path3);
            Image::make($_FILES["blog_bannerimg"]["tmp_name"])->resize(272, 268)->save($path4);
        }

        $customSlug = isset($_POST["custom_url"]) && !empty($_POST["custom_url"]) ? $_POST["custom_url"] : '';
        $blogData = Blog::find($_POST["blogId"]);
        $blogData->title = $_POST["blog_title"];
        $blogData->category_id = $_POST["blog_category"];

        if (!empty($blog_image)) {
            $blogData->blogImg = $blog_image;
        }
        $blogData->description = $_POST["blog_content"];
        $blogData->status = $_POST["blog_status"];
        $blogData->updated_at = date("Y-m-d H:i:s");
        $blogData->save();
        Session::flash('message', "Blog updated successfully!");
        return Redirect('admin/edit-blog/' . $_POST["blog_slug"]);
    }

    /*     * *
     * Delete Blog
     * 
     */

    public function deleteBlog() {
        $blog_id = $_POST["blog_id"];
        $blogData = Blog::find($blog_id);
        $blogData->delete();
        echo "success";
        die;
    }

    /*     * *
     * For geting contactus data
     */

    public function contactUsRecords() {
        $contactus = contactUsModel::orderBy('created_at', 'desc')->get();
        $dataArray = array("contactusData" => $contactus);
        return view('admin/manage-contactus-records', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Delete Contact us record
     */

    public function deleteContactusRecord() {
        $record_id = $_POST["record_id"];
        $contactUsData = contactUsModel::find($record_id);
        $contactUsData->delete();
        echo "success";
        die;
    }

    /*     * *
     * Delete portfolio  record
     */

    public function deletePortfolioRecord() {
        $record_id = $_POST["record_id"];
        $portfolioData = portfolio::find($record_id);
        $portfolioData->delete();
        echo "success";
        die;
    }

    /*     * **
     * Manage Business Partner Records
     */

    public function businessPartnerRecords() {
        $businessPartnerData = businessPartner::orderBy('created_at', 'desc')->get();
        $dataArray = array("businessPartnerData" => $businessPartnerData);
        return view('admin/manage-partner-records', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Delete partner record
     */

    public function deletePartnerRecord() {
        $record_id = $_POST["record_id"];
        $businessPartnerData = businessPartner::find($record_id);
        $businessPartnerData->delete();
        echo "success";
        die;
    }

    /*     * *
     * Delete job record
     */

    public function deleteJobRecord() {
        $record_id = $_POST["record_id"];
        $jobsData = jobs::find($record_id);
        $jobsData->delete();
        echo "success";
        die;
    }

    /**
     * Manage Job List
     */
    public function manageJobList() {
        $jobsData = jobs::all();
        foreach ($jobsData as $key => $val) {
            $jobsData[$key]->category_data = jobs::find($val->id)->getJobCategoryDetails;
        }
        $dataArray = array("jobsData" => $jobsData);
        return view('admin/manage-jobs-records', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Add Job Vacancy
     */

    public function AddJobVacancy() {
        $jobCategoryData = jobCategories::where('status', 'Active')->get();

        $dataArray = array("jobCategoryData" => $jobCategoryData);
        return view('admin/add-new-job', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Add Job Details
     */

    public function addJobDetails() {
        /*         * *
         * setup the variables
         */

        $dataArray = array(
            "category_id" => $_POST["job_category"],
            "job_title" => $_POST["job_title"],
            "exp_required" => $_POST["req_exp"],
            "job_location" => $_POST["job_location"],
            "profession_exp" => $_POST["professional_exp"],
            "no_of_vacancy" => $_POST["no_of_vacancy"],
            "job_summary" => $_POST["job_summary"],
            "skills" => $_POST["skills_required"],
            "status" => $_POST["job_status"],
            "created_at" => date("Y-m-d H:i:s"),
        );
        jobs::insert($dataArray);
        Session::flash('message', "Job details saved successfully!");
        return Redirect('admin/manage-jobs');
    }

    /*     * *
     * Edit job Details
     * 
     */

    public function editJobData($id) {
        $jobCategoryData = jobCategories::where('status', 'Active')->get();
        $jobDetail = jobs::find($id);
        $dataArray = array("jobCategoryData" => $jobCategoryData, "jobDetail" => $jobDetail);
        return view('admin/edit-job-detail', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Update Job details
     */

    public function editJobDetails() {
        /*         * *
         * setup the variables
         */
        $job_id = $_POST['job_id'];
        $dataArray = array(
            "category_id" => $_POST["job_category"],
            "job_title" => $_POST["job_title"],
            "exp_required" => $_POST["req_exp"],
            "job_location" => $_POST["job_location"],
            "profession_exp" => $_POST["professional_exp"],
            "no_of_vacancy" => $_POST["no_of_vacancy"],
            "job_summary" => $_POST["job_summary"],
            "skills" => $_POST["skills_required"],
            "status" => $_POST["job_status"],
            "updated_at" => date("Y-m-d H:i:s"),
        );
        jobs::where("id", $job_id)->update($dataArray);

        Session::flash('message', "Job details updated successfully!");
        return Redirect('admin/edit-job/' . $job_id);
    }

    /*     * *
     * Manage Job Applications
     */

    public function manageJobApplicaitonsRecords() {

        $jobApplications = jobApplications::orderBy('created_at', 'desc')->get();
        foreach ($jobApplications as $key => $val) {
            $jobApplications[$key]->jobDetail = $val->getJobsDetail;
        }

        $dataArray = array("jobApplications" => $jobApplications);
        return view('admin/manage-applicants-records', ["dataArray" => $dataArray]);
    }

    /*     * *
     * View application details
     */

    public function ViewJobApplicationDetails($app_id) {
        $jobApplications = jobApplications::find($app_id);
        $jobApplications->jobDetail = $jobApplications->getJobsDetail;
        $jobCategoryID = $jobApplications->getJobsDetail->category_id;
        $categoryData = jobCategories::find($jobCategoryID);
        $jobApplications->categoryData = $categoryData;
        $dataArray = array("jobApplications" => $jobApplications);
        return view('admin/view-application-detail', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Update Job Applicaiton
     */

    public function updateJobApplicationData() {
        $application_id = $_POST["application_id"];
        $status = $_POST["application_status"];
        $jobApplicationsData = jobApplications::find($application_id);
        $jobApplicationsData->status = $status;
        $jobApplicationsData->updated_at = date("Y-m-d H:i:s");
        $jobApplicationsData->save();
        Session::flash('message', "Application status updated successfully!");
        return Redirect('admin/view-application-details/' . $application_id);
    }

    /*     * *
     * Delete Application record
     */

    public function deleteApplicationRecord() {
        $record_id = $_POST["record_id"];
        $jobApplicationsData = jobApplications::find($record_id);
        $jobApplicationsData->delete();
        echo "success";
        die;
    }

    /*     * **
     * Manage Header Menu
     */

    public function manageHeaderMenu() {
        /*         * *
         * Get Page Posts
         */
        $pagePost = postModel::where("post_type", "page")->get();
        /*         * *
         * Get Menu Details
         */
        $headerMenu = headerMenuModel::all();

        foreach ($headerMenu as $key => $val) {
            $headerMenu[$key]->postDetail = postModel::find($val->post_id);
        }
        $dataArray = array("headerMenuData" => $headerMenu, "pagePost" => $pagePost);
        return view('admin/manage-header-menu', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Edit Header Menu
     */

    public function EditHeaderMenu($menuId) {

        /*         * *
         * Get Page Posts
         */
        $pagePost = postModel::where("post_type", "page")->where("status", "active")->get();
        /*         * *
         * Get Menu Details
         */
        $headerMenu = headerMenuModel::find($menuId);

        $dataArray = array("headerMenuData" => $headerMenu, "pagePost" => $pagePost);
        return view('admin/edit-header-menu', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Save Header Menu Details
     */

    public function EditHeaderMenuDetail() {

        $menu_name = $_POST["menu_name"];
        $post_category = $_POST["post_category"];
        $menu_index = $_POST["menu_index"];
        $menu_status = $_POST["menu_status"];
        $menuId = $_POST["menuId"];
        $headerMenu = headerMenuModel::find($menuId);
        $headerMenu->name = $menu_name;
        $headerMenu->parent_id = 0;
        $headerMenu->header_sort_index = $menu_index;
        $headerMenu->post_id = $post_category;
        $headerMenu->status = $menu_status;
        $headerMenu->updated_at = date("Y-m-d H:i:s");
        $headerMenu->save();
        Session::flash('message', "Menu updated successfully!");
        return Redirect('admin/edit-header-menu/' . $menuId);
    }

    /*     * *
     * Add new Header Menu
     */

    public function addNewHeaderMenu() {
        /*         * *
         * Get Page Posts
         */
        $pagePost = postModel::where("post_type", "page")->where("status", "active")->get();
        /*         * *
         * Get Menu Details
         */


        $dataArray = array("pagePost" => $pagePost);
        return view('admin/add-header-menu', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Function to add new menu
     */

    public function addHeaderMenuDetail() {
        $menu_name = $_POST["menu_name"];
        $post_category = $_POST["post_category"];
        $menu_index = $_POST["menu_index"];
        $menu_status = $_POST["menu_status"];
        $headerMenu = new headerMenuModel;
        $headerMenu->name = $menu_name;
        $headerMenu->header_sort_index = $menu_index;
        $headerMenu->parent_id = 0;
        $headerMenu->post_id = $post_category;
        $headerMenu->status = $menu_status;
        $headerMenu->created_at = date("Y-m-d H:i:s");
        $headerMenu->save();
        Session::flash('message', "Menu added successfully!");
        return Redirect('admin/manage-header-menu');
    }

    /*     * *
     * Delete header menu
     */

    public function deleteHeaderMenuRecord() {
        $record_id = $_POST["record_id"];
        $headerMenuModelData = headerMenuModel::find($record_id);
        $headerMenuModelData->delete();
        echo "success";
        die;
    }

    /*     * * 
     * Manage Footer Menu
     */

    public function manageFooterMenu() {
        /*         * *
         * Get Page Posts
         */
        $orConditions = array("post_type" => "service", "post_type" => "subservice");
        $pagePost = postModel::whereOr($orConditions)->get();
        // echo "<pre>";
        // print_R($pagePost); die;
        /*         * *
         * Get Menu Details
         */
        $footerMenu = footerMenuModel::where('footer_section', "!=", "section4")->get();

        foreach ($footerMenu as $key => $val) {
            $dataPost = postModel::find($val->post_id);
            $footerMenu[$key]->postDetail = $dataPost;
            $footerMenu[$key]->ParentpostDetail = $dataPost; //postModel::find($dataPost->parent_id);
        }

        $dataArray = array("footerMenuData" => $footerMenu, "pagePost" => $pagePost);
        return view('admin/manage-footer-menu', ["dataArray" => $dataArray]);
    }

    /*     * *
     * Edit footer menu
     */

    public function EditFooterMenu($menuId) {
        /*         * *
         * Get Sub Service Post
         */

        $orConditions = " post_type='subservice'  and status='active'";
        $SubServicePost = postModel::whereRaw($orConditions)->get();
        /*         * *
         * Get Service Posts
         */
        $orConditions = " post_type='service'  and status='active'";
//        $orConditions = " post_type='service' OR post_type='subservice' OR post_type='portfolio-category'  and status='active'";
        $ServicePost = postModel::whereRaw($orConditions)->get();

        /**
         * Get Portfolio Categories
         */
        $orConditions = " post_type='portfolio-category'  and status='active'";
        $PortfolioPost = postModel::whereRaw($orConditions)->get();
        /*         * *
         * Get Menu Details
         */
        $footerMenu = footerMenuModel::find($menuId);
        /*         * *
         * Get Parent Service Detail of selected menu
         */
        $ServiceDetails = postModel::find($footerMenu->post_id);

        $parentServiceDetails = postModel::find($ServiceDetails->parent_id);

        $dataArray = array("footerMenuData" => $footerMenu, "SubServicePost" => $SubServicePost, "ServicePost" => $ServicePost, "PortfolioPost" => $PortfolioPost, "parentServiceDetails" => $parentServiceDetails);
        return view('admin/edit-footer-menu', ["dataArray" => $dataArray]);
    }

    /*     * **
     * Function to update the menu
     */

    public function EditFooterMenuDetail() {

        $menuId = $_POST["menuId"];
        $menuData = footerMenuModel::find($menuId);
        $menuData->parent_id = 0;
        $menuData->post_id = $_POST["linked_post"];
        $menuData->sort_index = $_POST["menu_index"];
//        $menuData->section_title = $_POST["menu_section_title"];
        $menuData->name = $_POST["menu_name"];
        $menuData->footer_section = $_POST["footer_section"];
        $menuData->portfolio_post_id = $_POST["linked_portfolio"];
        $menuData->status = $_POST["menu_status"];
        $menuData->updated_at = date("Y-m-d H:i:s");
        $menuData->save();
        Session::flash('message', "Menu updated successfully!");
        return Redirect('admin/edit-footer-menu/' . $menuId);
    }

    /*     * *
     * Add new Header Menu
     */

    public function addNewFooterMenu() {
        /*         * *
         * Get Sub Service Post
         */

        $orConditions = " post_type='subservice'  and status='active'";
        $SubServicePost = postModel::whereRaw($orConditions)->get();
        /*         * *
         * Get Service Posts
         */
        $orConditions = " post_type='service'  and status='active'";
//        $orConditions = " post_type='service' OR post_type='subservice' OR post_type='portfolio-category'  and status='active'";
        $ServicePost = postModel::whereRaw($orConditions)->get();

        /**
         * Get Portfolio Categories
         */
        $orConditions = " post_type='portfolio-category'  and status='active'";
        $PortfolioPost = postModel::whereRaw($orConditions)->get();
        $dataArray = array("SubServicePost" => $SubServicePost, "ServicePost" => $ServicePost, "PortfolioPost" => $PortfolioPost);
        return view('admin/add-footer-menu', ["dataArray" => $dataArray]);
    }

    /*     * ***
     * Add Footer Menu
     */

    public function addFooterMenuDetail() {

        $menuData = new footerMenuModel;
        $menuData->parent_id = 0;
        $menuData->post_id = $_POST["linked_post"];
        $menuData->sort_index = $_POST["menu_index"];
//        $menuData->section_title = $_POST["menu_section_title"];
        $menuData->name = $_POST["menu_name"];
        $menuData->footer_section = $_POST["footer_section"];
        $menuData->portfolio_post_id = $_POST["linked_portfolio"];
        $menuData->status = $_POST["menu_status"];
        $menuData->updated_at = date("Y-m-d H:i:s");
        $menuData->save();
        Session::flash('message', "Menu updated successfully!");
        return Redirect('admin/edit-footer-menu/');
    }

    /*     * *
     * Delete header menu
     */

    public function deleteFooterMenuRecord() {
        $record_id = $_POST["record_id"];
        $footerMenuModelData = footerMenuModel::find($record_id);
        $footerMenuModelData->delete();
        echo "success";
        die;
    }

    /*     * *
     * Redirect to Access denied
     */

    public function accessDenied() {
        return view('admin/access-denied');
    }

}
