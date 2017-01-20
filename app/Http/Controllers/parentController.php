<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\headerMenuModel;
use App\footerMenuModel;
use App\postModel;
use App\User;
use App\Blog;
use App\contactUsModel;
use App\portfolio;
use App\BlogCategories;
use App\clientTestimonial;
use App\systemSettingModel;

class parentController extends Controller {

    public function __construct() {
        
    }

    /*     * *
     * Get Header menu
     */

    public function getHeaderMenu() {

        $headerFooterMenuData = headerMenuModel::where("status", "Active")
                        ->where("parent_id", 0)
                        ->orderBy("header_sort_index", "ASC")->limit(5)
                        ->get()->toArray();

        foreach ($headerFooterMenuData as $key => $val) {
            $postDetail = headerMenuModel::find($val['id'])->getPostDetail;
            $headerFooterMenuData[$key]["postDetail"] = $postDetail;
            $headerFooterMenuParentData = headerMenuModel::where("status", "Active")
                            ->where("parent_id", $val["id"])
                            ->orderBy("header_sort_index", "ASC")
                            ->get()->toArray();
            $resultArray = array();
            foreach ($headerFooterMenuParentData as $key1 => $val1) {
                $resultArray[$key1] = $val1;
                $postDetail1 = headerMenuModel::find($val1['id'])->getPostDetail;
                $resultArray[$key1]["postDetail"] = $postDetail1;
            }
            $headerFooterMenuData[$key]['submenu'] = $resultArray;
        }

        return $headerFooterMenuData;
    }

    /*     * **
     * Footer Sections
     */

    public function getFooterSections() {
        $sectionFirst = footerMenuModel::where("status", "Active")
                        ->where("footer_section", "section1")
                        ->orderBy("sort_index", "ASC")->limit(6)
                        ->get()->toArray();
        /*         * *
         * Get Parent Post
         */
        $parentPost = postModel::find($sectionFirst[0]["post_id"]);

        $parentPost2 = postModel::find($parentPost->parent_id);


        foreach ($sectionFirst as $key1 => $val1) {
            $postDetail1 = footerMenuModel::find($val1['id'])->getPostDetail;
            $sectionFirst[$key1]["postDetail"] = $postDetail1;
            $sectionFirst[$key1]["parentPostDetail"] = $parentPost2;

            $postData = postModel::find($val1["portfolio_post_id"]);
            $portfolio_link = '';
            if (count($postData) > 0) {
                $portfolio_link = !empty($postData->custom_slug) ? $postData->custom_slug : $postData->post_slug;
            }
            $sectionFirst[$key1]['portfolio_link'] = "portfolio/" . $portfolio_link;
        }
//        echo "<pre>";
//        print_r($sectionFirst);
//        die;



        $sectionSecond = footerMenuModel::where("status", "Active")
                        ->where("footer_section", "section2")
                        ->orderBy("sort_index", "ASC")->limit(6)
                        ->get()->toArray();
        /*         * *
         * Get Parent Post
         */
        $parentPost = postModel::find($sectionSecond[0]["post_id"]);

        $parentPost2 = postModel::find($parentPost->parent_id);




        foreach ($sectionSecond as $key1 => $val2) {

            $postDetail1 = footerMenuModel::find($val2['id'])->getPostDetail;
            $sectionSecond[$key1]["postDetail"] = $postDetail1;
            $sectionSecond[$key1]["parentPostDetail"] = $parentPost2;
            $postData = postModel::find($val2["portfolio_post_id"]);
            $portfolio_link = '';
            if (count($postData) > 0) {
                $portfolio_link = !empty($postData->custom_slug) ? $postData->custom_slug : $postData->post_slug;
            }
            $sectionSecond[$key1]['portfolio_link'] = "portfolio/" . $portfolio_link;
        }


        $sectionThird = footerMenuModel::where("status", "Active")
                        ->where("footer_section", "section3")
                        ->orderBy("sort_index", "ASC")->limit(6)
                        ->get()->toArray();
        /*         * *
         * Get Parent Post
         */
        $parentPost = postModel::find($sectionThird[0]["post_id"]);

        $parentPost2 = postModel::find($parentPost->parent_id);


        foreach ($sectionThird as $key1 => $val3) {
            $postDetail1 = footerMenuModel::find($val3['id'])->getPostDetail;
            $sectionThird[$key1]["postDetail"] = $postDetail1;
            $sectionThird[$key1]["parentPostDetail"] = $parentPost2;
            $postData = postModel::find($val3["portfolio_post_id"]);
            $portfolio_link = '';
            if (count($postData) > 0) {
                $portfolio_link = !empty($postData->custom_slug) ? $postData->custom_slug : $postData->post_slug;
            }
            $sectionThird[$key1]['portfolio_link'] = "portfolio/" . $portfolio_link;
        }
//        echo "<pre>";
//        print_r($sectionThird);
//        die;
        $sectionFourth = footerMenuModel::where("status", "Active")
                        ->where("footer_section", "section4")
                        ->orderBy("sort_index", "ASC")->limit(6)
                        ->get()->toArray();


        foreach ($sectionFourth as $key1 => $val4) {
            $postDetail1 = footerMenuModel::find($val4['id'])->getPostDetail;
            $sectionFourth[$key1]["postDetail"] = $postDetail1;
        }

        $menuArray = array("first_section" => $sectionFirst,
            "second_section" => $sectionSecond,
            "third_section" => $sectionThird,
            "fourth_section" => $sectionFourth);
        return $menuArray;
    }

    /*     * *
     *  Get partner posts
     */

    public function getPartners() {
        $limit = 5;

        $data = $this->getPosts("partner", $limit);
        return $data;
    }

    /*     * *
     * Get system config
     */

    public function getSystemConfig() {
        $systemResult = systemSettingModel::where("status", "active")->get();
        $systemData = array();
        foreach ($systemResult as $key => $val) {

            $systemData[$val->key] = array("value" => $val->value, "image" => $val->extra_info);
        }

        return $systemData;
    }

    /*     * *
     * Get Default Services
     * 
     */

    public function getDefaultServices() {
        $limit = 4;
        $serviceData = $this->getPosts("service", $limit);

        foreach ($serviceData as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $serviceData[$key]->postDetail = $postData;
        }
        return $serviceData;
    }

    /*     * **
     * get our work post
     */

    public function getOurWorkPost() {

        $data = $this->getPosts("ourwork");
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * *
     * Get Portfolio Categories
     */

    public function getPortfoilioCategories() {

        $data = $this->getPosts("portfolio-category");
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * ***
     * Get Client Logos
     * *
     */

    public function getBlogs() {
        $limit = 4;
        $data = $this->getPosts("blog", $limit);
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * ***
     * Get Client Logos
     * *
     */

    public function getClientLogos() {
        $limit = 6;
        $data = $this->getPosts("client-logo", $limit);
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * ***
     * Get Client Video 
     * *
     */

    public function getVideoTestimonial() {
        $limit = 1;

        $data = $this->getPosts("video-testimonial", $limit);
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }

            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * *
     * function to get posts
     */

    public function getPosts($post_type = '', $limit = 0, $userinfo = '') {

        $andConditions = array("status" => "active");
        if ($post_type != '') {
            $andConditions["post_type"] = $post_type;
        }
        $data = postModel::where($andConditions)
                ->when($limit, function ($query) use ($limit) {
                    if ($limit > 0) {
                        return $query->limit($limit);
                    }
                })
                ->get();
        /*         * *
         * user info
         */
        if ($userinfo != '') {

            foreach ($data as $key => $val) {
                $userDetail = postModel::find($val->id)->UserInfo;
                $data[$key]->userDetail = $userDetail;
                if (isset($val->updated_by) && !empty($val->updated_by)) {
                    $updateByUserDetail = postModel::find($val->updated_by)->UserInfo;
                    $data[$key]->updateByUserDetail = $updateByUserDetail;
                }
            }
        }


        return $data;
    }

    /*     * **
     * Get Post Details
     * 
     */

    public function getPostDetailBySlug($slug = 'home', $post_type = '') {
        $andConditions = array("status" => "active", "post_slug" => $slug);
        if ($post_type != '') {
            $andConditions["post_type"] = $post_type;
        }
        $data = postModel::where($andConditions)
                ->get();
        foreach ($data as $key => $val) {

            $postDetail1 = postModel::find($val->id)->getPostMeta;
            $postData = array();

            foreach ($postDetail1 as $key1 => $val1) {

                $postData[$val1['post_key']] = array("value" => $val1['post_value'], 'postmeta_type' => $val1['postmeta_type']);
            }
            $userDetail = postModel::find($val->id)->UserInfo;
            $data[$key]->userDetail = $userDetail;
            if (isset($val->updated_by) && !empty($val->updated_by)) {
                $updateByUserDetail = postModel::find($val->updated_by)->UserInfo;
                $data[$key]->updateByUserDetail = $updateByUserDetail;
            }
            $data[$key]->postDetail = $postData;
        }
        return $data;
    }

    /*     * *
     * Get User List
     */

    public function getUserList() {
//        $andConditions = array("status" => "active");
        $andConditions = array();
        $data = User::where($andConditions)->where("usertype", '!=', 'superadmin')->get();
        return $data;
    }

    /*     * *
     * Get Post List
     */

    public function getPostList() {
        $limit = 0;
        $data = postModel::where("post_type", '!=', "page")
                ->when($limit, function ($query) use ($limit) {
                    if ($limit > 0) {
                        return $query->limit($limit);
                    }
                })
                ->get();

        /*         * *
         * user info
         */
        foreach ($data as $key => $val) {
            $userDetail = postModel::find($val->id)->UserInfo;
            $data[$key]->userDetail = $userDetail;
            if (isset($val->updated_by) && !empty($val->updated_by)) {
                $updateByUserDetail = postModel::find($val->updated_by)->UserInfo;
                $data[$key]->updateByUserDetail = $updateByUserDetail;
            }
        }

        return $data;
    }

    /*     * *
     * Get User List
     */

    public function getUserParticularTypeUsers($type) {
        $andConditions = array("status" => "active");
        $data = User::where($andConditions)->where("usertype", $type)->get();
        return $data;
    }

    /*     * **
     * Function to get user info based on fields
     * EX.  array("id"=>'value');
     * 
     */

    public function getUserDetailBySlug($slug) {
        $andConditions = array("user_slug" => $slug);
        $data = User::where($andConditions)->get();
        return $data;
    }

    /*     * *
     * Function to update the post using post slug
     */

    public function upatePostData($slug, $data) {

        $result = DB::table('tbl_posts')
                ->where('post_slug', $slug)
                ->update($data);
        if ($result) {
            return "success";
        } else {
            return "failed";
        }
    }

    /*     * *
     * Update Post Meta data
     * 
     */

    public function updatePostMetaData($postId, $data) {

        foreach ($data as $key => $val) {
            $postArray = array("post_id" => $postId, "post_key" => $key, "post_value" => $val, "updated_at" => date("Y-m-d H:i:s"));
            DB::table('tbl_postmeta')->where('post_key', $key)->where('post_id', $postId)->update($postArray);
        }
        return "success";
    }

    /*     * *
     * Update User related things
     */

    public function updateUserInfo($userId, $data) {
        DB::table('users')->where('id', $userId)->update($data);
        return "success";
    }

    /*     * *
     * Update User related things
     */

    public function deletePostData($postId) {
        /*         * **
         * Delete post info
         */
        $postData = postModel::find($postId);
        $postData->delete();
        /*         * *
         * Delete post meta info
         */
        DB::table('tbl_postmeta')->where('post_id', $postId)->delete();
        return "success";
    }

    /*     * **
     * Save Post
     */

    public function savePost($postData) {
        $postId = DB::table('tbl_posts')->insertGetId($postData);
        return $postId;
    }

    /*     * **
     * To add post meta
     */

    public function addPostMeta($postId, $data) {
        $postArray = array("post_id" => $postId, "post_key" => $data["post_key"], "post_value" => $data["post_value"], "postmeta_type" => $data["postmeta_type"], "created_at" => date("Y-m-d H:i:s"));

        $postMetaId = DB::table('tbl_postmeta')->insertGetId($postArray);
        return $postMetaId;
    }

    /*     * *
     * Delete the post meta data
     */

    public function deletePostMetaData($postId) {
        DB::table('tbl_postmeta')->where('post_id', $postId)->delete();
        return "success";
    }

    /*     * **
     * Delete Post 
     */

    public function UpdateSystemSettings($setting_id, $data) {
        DB::table('tbl_system_setting')->where('id', $setting_id)->update($data);
        return "success";
    }

    /*     * **
     * Function to check site is in maintaince mode or not
     */

    public function checkSiteMode() {
        $data = DB::table('tbl_system_setting')->where('key', "maintaince_mode")->get();
        return $data;
    }

    /*     * **
     * Get Testimonial
     */

    public function getClientTestimonial($limit = 0, $type = 'text') {

        $data = clientTestimonial::where("status", 'active')->where("testimonial_type", $type)
                ->when($limit, function ($query) use ($limit) {
                    if ($limit > 0) {
                        return $query->limit($limit);
                    }
                })
                ->get();
        return $data;
    }

    /*     * *
     * Get Child Posts by parent
     */

    public function getChildPostById($id, $limit = 0) {

        $postData = postModel::where("parent_id", $id)
                ->when($limit, function ($query) use ($limit) {
                    if ($limit > 0) {
                        return $query->limit($limit);
                    }
                })
                ->get();
        return $postData;
    }

    /**
     * Get Portfolio by category
     */
    public function getPortfolioByCategoryId($categoryID) {

        $portfolioData = portfolio::where("category_id", $categoryID)->get();
        return $portfolioData;
    }

    /*     * *
     * Blog categories
     */

    public function getBlogCategories() {
        $BlogCategoriesData = BlogCategories::where("status", "Active")->get();
        return $BlogCategoriesData;
    }

    /*     * *
     * Get Blog for home page
     */

    public function getIndexBlogs() {

        $data = DB::table('tbl_blog')
                        ->leftJoin('users', 'users.id', '=', 'tbl_blog.postedBy')
                        ->select('users.*', 'tbl_blog.*')
                        ->where("tbl_blog.status", "Active")
                        ->orderBy("tbl_blog.created_at", 'desc')->limit(10)->get();

        return $data;
    }

}
