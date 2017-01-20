<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\businessPartner;
use App\postModel;
use App\Blog;
use App\contactUsModel;
use App\BlogCategories;
use App\portfolio;
use App\jobApplications;
use DB;
use App\jobCategories;
use App\jobs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class HomeController extends parentController {

    public $systemData;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();

        /*         * **
         * get Header and footer data
         */
        $headerMenuData = $this->getHeaderMenu();

        $footerMenuData = $this->getFooterSections();

        /*         * **
         * Get the system setting data
         */
        $systemConfig = $this->getSystemConfig();
        /*         * **
         * Get the system setting data
         */
        $testimonialData = $this->getClientTestimonial(1, 'video');

        $partnersData = $this->getPartners();
        $this->systemData = array("systemConfig" => $systemConfig, "testimonialData" => $testimonialData, "headerMenu" => $headerMenuData, "footerMenu" => $footerMenuData, "partnersData" => $partnersData);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $postData = postModel::find(1);
        $postMetaData = postModel::find(1)->getPostMeta;
        /*         * ***
         * Get data for our work
         */
        $ourworkPost = $this->getOurWorkPost();
        /*         * *
         * Get Our services Data
         */

        $serviceData = $this->getDefaultServices();
        /*         * *
         * Get portfolio categories
         */
        $portFolioCategories = $this->getPortfoilioCategories();
        /*         * *
         * Get Client Logo
         */
        $getClientLogos = $this->getClientLogos();
        /*         * *
         * Get Blogs
         */
        $getBlogs = $this->getIndexBlogs();
        /*         * **
         * Get video testinomial
         * 
         */
        $getVideoTestimonial = $this->getClientTestimonial(1, 'video');

        $dataArray = array("getVideoTestimonial" => $getVideoTestimonial, "getBlogs" => $getBlogs, "postDetail" => $postData, "getClientLogos" => $getClientLogos, "portFolioData" => $portFolioCategories, "ourworkPost" => $ourworkPost, "postMetaData" => $postMetaData, "serviceData" => $serviceData);
        return view('front.index', ["dataArray" => $dataArray, "systemData" => $this->systemData]);
    }

    /*     * **
     * To Handle all Single Segment Requests
     */

    public function render($slug = 'home') {

        /*         * *
         * Get Template according to custom Url
         */
        $PostCustomMeta = postModel::where("custom_slug", $slug)->get();
        if (count($PostCustomMeta) > 0) {
//            $PostMeta = postModel::where("post_slug", $slug)->get();

            $PostMeta = $PostCustomMeta[0];
        } else {

            $PostMeta = $this->getPostDetailBySlug($slug);
            if (count($PostMeta) > 0) {
                $PostMeta = $PostMeta[0];
            } else {
                return view('front.404-view');
            }
        }

        /*         * *
         * select the child Posts
         */
        $parentPostId = $PostMeta->id;

        $childPostData = $this->getChildPostById($parentPostId);


        foreach ($childPostData as $key => $val) {
            $data_portfolio = portfolio::where("category_id", $val->id)->inRandomOrder()->first();
            $childPostData[$key]->portfolio = $data_portfolio;
        }
        /*         * **
         * Load the blog 
         */
        if ($PostMeta->post_slug == 'blog') {
            @session_start();
            $category_id = isset($_SESSION["category_id"]) && !empty($_SESSION["category_id"]) ? $_SESSION["category_id"] : '';
            $keyword = isset($_SESSION["keyword"]) && !empty($_SESSION["keyword"]) ? $_SESSION["keyword"] : '';
            $andConditions[] = array("tbl_blog.status", "=", "Active");
            if ($category_id != '') {
                $andConditions[] = array("tbl_blog.status", "=", "Active");
            }
            if ($keyword != '') {
                $andConditions[] = array("tbl_blog.title", "LIKE", "%" . $keyword . "%");
            }


            $childPostData["blogData"] = DB::table('tbl_blog')
                            ->leftJoin('users', 'users.id', '=', 'tbl_blog.postedBy')
                            ->select('users.*', 'tbl_blog.*')
                            ->where($andConditions)
                            ->orderBy("tbl_blog.created_at", 'desc')->paginate(1);
            $blogCategoryData = BlogCategories::where("status", "Active")->get();
            foreach ($blogCategoryData as $key => $val) {
                $blogCategoryData[$key]->blogCount = blog::where("category_id", $val->id)->where("status", "Active")->count();
            }
            $childPostData["blogCategory"] = $blogCategoryData;
        } if ($PostMeta->post_slug == 'career') {
            $currentOpening = $this->GetCurrentOpenings();
            $finalArray = array();
            foreach ($currentOpening as $key => $val) {
                $finalArray[$val->name] = $val;
            }
            $childPostData["openingData"] = $finalArray;
        }

        /*         * *
         * get client video Testimonial
         */
        $videoTestimonial = $this->getClientTestimonial(0, 'video');
        $textTestimonial = $this->getClientTestimonial(0, "text");

        $dataArray = array("postDetail" => $PostMeta, "childPostData" => $childPostData, "textTestinomial" => $textTestimonial, "videoTestimonial" => $videoTestimonial);
        $pageName = $PostMeta->post_slug;
        if ($PostMeta->post_type == 'service') {
            $pageName = "service-detail";
        }
        return view('front.' . $pageName . '-page', ["dataArray" => $dataArray, "systemData" => $this->systemData]);
    }

    /*     * **
     * To Handle all Two Segments Requests
     */

    public function renderSubPart($segment1, $segment2) {

        /*         * *
         * Get Template according to custom Url
         */
        $PostCustomMeta = postModel::where("custom_slug", $segment1)->get();
        if (count($PostCustomMeta) > 0) {
            $ParentPostMeta = postModel::where("post_slug", $segment1);
        } else {
            $ParentPostMeta = $this->getPostDetailBySlug($segment1);

            if (count($ParentPostMeta) > 0) {
                $ParentPostMeta = $ParentPostMeta[0];
            } else {
                return redirect('404-page');
            }
        }

        if ($ParentPostMeta->post_slug == 'blog') {
            $childPostMeta = $ParentPostMeta;
            /*             * *
             * get blog details
             */$blogData = DB::table('tbl_blog')
                    ->leftJoin('users', 'users.id', '=', 'tbl_blog.postedBy')
                    ->select('users.*', 'tbl_blog.*')
                    ->where("blog_slug", $segment2)
                    ->get();

            $childPostMeta->blogData = $blogData;
        } else {


            $PostCustomMeta = postModel::where("custom_slug", $segment2)->get();
            if (count($PostCustomMeta) > 0) {
                $childPostMeta = postModel::where("post_slug", $segment2);
            } else {
                $childPostMeta = $this->getPostDetailBySlug($segment2);
                if (count($childPostMeta) > 0) {
                    $childPostMeta = $childPostMeta[0];
                } else {
                    return redirect('404-page');
                }
            }
        }

        /*         * *
         * select the child Posts
         */
        $childPostMetaID = $childPostMeta->id;

        /*         * **
         * get Image to show on showcase
         */
        $secondChildPostData = $this->getChildPostById($childPostMetaID);

        /*         * *
         * get client video Testimonial
         */
        $videoTestimonial = $this->getClientTestimonial(0, 'video');
        $textTestimonial = $this->getClientTestimonial(0, "text");
        $dataArray = array("ParentPostMeta" => $ParentPostMeta, "postDetail" => $childPostMeta, "secondChildPostData" => $secondChildPostData, "textTestinomial" => $textTestimonial, "videoTestimonial" => $videoTestimonial);
        if ($childPostMeta->post_type == 'portfolio-category') {
            $pageName = "portfolio-single";
            $portfolioData = $this->getPortfolioByCategoryId($childPostMetaID);
            $dataArray['portfolioData'] = $portfolioData;
        } else if ($ParentPostMeta->post_slug == 'blog') {
            $pageName = "blog-single";
            $blogCategoryData = BlogCategories::where("status", "Active")->get();
            foreach ($blogCategoryData as $key => $val) {
                $blogCategoryData[$key]->blogCount = blog::where("category_id", $val->id)->where("status", "Active")->count();
            }
            $childPostMeta->blogCategory = $blogCategoryData;
        } else {
            $pageName = $childPostMeta->post_slug;
        }
        return view('front.' . $pageName . '-page', ["dataArray" => $dataArray, "systemData" => $this->systemData]);
    }

    /*     * *
     * function to refirect to maintainance mode
     */

    public function maintenanceMode() {
        return view('front.maintenance-mode');
    }

    /*     * *
     * function to refirect to 404 
     */

    public function pageNotFound() {
        $dataArray = array();
        $dataArray["data_static"]["meta_title"] = '404';
        $dataArray["data_static"]["meta_description"] = '404';
        $dataArray["data_static"]["meta_keywords"] = '404';
        return view('front.404-view', ["dataArray" => $dataArray, "systemData" => $this->systemData]);
    }

    /*     * **
     * Contact us form
     */

    public function submitContactUs() {

        $ip = $this->getUserIpAddress();
        /*         * *
         * 
         * check user make 3 contact in current date or not
         */
        $records = contactUsModel::where("user_ip", $ip)->whereRaw('Date(created_at) = CURDATE()')->get();
        $url = $_SERVER['HTTP_REFERER'];
        if (count($records) < 3) {

            $contactUsData = new contactUsModel;
            $contactUsData->user_ip = $ip;
            $contactUsData->name = $_POST["name"];
            $contactUsData->email = $_POST["email"];
            $contactUsData->phone_number = $_POST["phone_number"];
            $contactUsData->message_content = $_POST["message_content"];
            $contactUsData->created_at = date("Y-m-d H:i:s");
            $contactUsData->save();
            Session::flash('message', "Message sent successfully! We will contact you shortly");
            return Redirect($url);
        } else {
            Session::flash('errormessage', "Access denied");
            return Redirect($url);
        }
    }

    /*     * *
     * Funciton to get user IP
     */

    function getUserIpAddress() {
        $ipAddress = '';

        // Check for X-Forwarded-For headers and use those if found
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
            }
        }
        return $ipAddress;
    }

    /*     * *
     * Function for bussiness partner
     */

    function submitBusinessPartner() {
        $ip = $this->getUserIpAddress();
        $dataArray = array(
            "name" => $_POST["name"],
            "user_ip" => $ip,
            "email" => $_POST["email"],
            "business_type" => $_POST["partner_type"],
            "Classification" => json_encode($_POST["classification"]),
            "created_at" => date("Y-m-d H:i:s")
        );
        businessPartner::insert($dataArray);
        Session::flash('message', "Message sent successfully! We will contact you shortly");

        return Redirect('business-partner');
    }

    /*     * *
     * Blog Category Filter
     */

    public function blogFilterSession() {

        $category_id = $_POST["category_id"];
        @session_start();
        if (isset($_SESSION["category_id"]) && !empty($_SESSION["category_id"])) {
            unset($_SESSION["category_id"]);
        } else {
            $_SESSION["category_id"] = $category_id;
        }
        echo "success";
        die;
    }

    /*     * *
     * Blog Keyword Filter
     */

    public function blogKeywordSearchSession() {
        $keyword = $_POST["keyword"];
        @session_start();
        $_SESSION["keyword"] = $keyword;
        echo "success";
        die;
    }

    /*     * *
     * Get Current Job Openings
     */

    public function GetCurrentOpenings() {
        $jobCategoriesData = jobCategories::all();
        foreach ($jobCategoriesData as $key => $val) {
            $jobCategoriesData[$key]->jobs = jobCategories::find($val->id)->getJobsByCategory;
        }

        return $jobCategoriesData;
    }

    /*     * *
     * To submit the job applications
     */

    public function jobApplication(Request $request) {
        $sourceFile = '';
        if (isset($_FILES['job_person_resume']) && !empty($_FILES['job_person_resume'])) {
            $file = $request->file('job_person_resume');

            //Move Uploaded File
            $destinationPath = 'uploads/job-applications/';
            $sourceFile = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $sourceFile);
        }


        $job_person_name = $_POST["job_person_name"];
        $job_person_email = $_POST["job_person_email"];
        $job_person_phone = $_POST["job_person_phone"];
        $job_id = $_POST["job_id"];

        $jobApplicationsData = new jobApplications;
        $jobApplicationsData->job_id = $job_id;
        $jobApplicationsData->app_name = $job_person_name;
        $jobApplicationsData->app_email = $job_person_email;
        $jobApplicationsData->app_phone = $job_person_phone;
        $jobApplicationsData->app_resume = $sourceFile;
        $jobApplicationsData->status = 'active';
        $jobApplicationsData->created_at = date("Y-m-d H:i:s");
        $jobApplicationsData->save();
        Session::flash('message', "Your application sent successfully! We will contact you shortly");
        return Redirect('career');
    }

}
