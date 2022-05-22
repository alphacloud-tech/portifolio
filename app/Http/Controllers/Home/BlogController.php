<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BlogController extends Controller
{
    //

    public function AllBlog () {
        $blogs = Blog::latest()->get();
        return view("admin.blog.blogs_all", compact('blogs'));
    }// end method

    public function AddBlog () {
        $categories = BlogCategory::orderBy("blog_category", "asc")->get();
        return view("admin.blog.blog_add", compact('categories'));
    }// end method


    public function StoreBlog (Request $request) {
       
        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
            'blog_tags' => 'required',
            'blog_description' => 'required',
            'blog_image' => 'required',
        ],[
            'blog_category_id' => 'Blog Name is Required',
            'blog_title' => 'Blog Title is Required',
            'blog_tags' => 'Blog Tags is Required',
            'blog_description' => 'Blog Description is Required',
            'blog_image' => 'Blog Image is Required',
        ]);

        $image = $request->file('blog_image');

        // we wnt to generate an id wen we upload an image
        // hexdec() : to create a unique id
        $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

        Image::make($image)->resize(430,327)->save('upload/blog_image/'.$image_name_gen);

        $save_url = 'upload/blog_image/'.$image_name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Blog created  Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.blog')->with($notification);


    }// end method


    public function EditBlog ($id) {
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy("blog_category", "asc")->get();
        return view("admin.blog.blog_edit", compact('blogs', 'categories'));
    }// end method


    public function UpdateBlog (Request $request) {
        
        $blog_id = $request->id; // the id is from hidden input fielf from form

        if ($request->file('blog_image')) {
            # code...

            $image = $request->file('blog_image');

            // we wnt to generate an id wen we upload an image
            // hexdec() : to create a unique id
            $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

            Image::make($image)->resize(1020,519)->save('upload/blog_image/'.$image_name_gen);

            $save_url = 'upload/blog_image/'.$image_name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message'=>'Portfolio Updated with Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.portfolio')->with($notification);
        }else {
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
            ]);

            $notification = array(
                'message'=>'Portfolio Updated without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.blog')->with($notification);
        } // End else

    }// end method


    public function DeleteBlog ($id) {

        $multi_images = Blog::findOrFail($id);

        $img = $multi_images->blog_image;

        unlink($img);

       Blog::findOrFail($id)->delete();

       $notification = array(
        'message'=>'Blog deleted Successfully',
        'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }// end method


    public function BlogDetails ($id) {

        $blogs = Blog::findOrFail($id);
        $blog_recent = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy("blog_category", "asc")->get();


        return view("frontend.blog_details", compact('blogs', 'blog_recent', 'categories'));
    }// end method

    public function BlogCategory ($id) {

        $blogposts = Blog::where('blog_category_id', $id)->orderBy("id", "DESC")->get();
        $blog_recent = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy("blog_category", "asc")->get();
        $cat_name = BlogCategory::findOrFail($id);

        return view("frontend.category_post_details", compact('blogposts', 'blog_recent', 'categories', 'cat_name'));
    }// end method

    public function HomeBlog () {

        $allblogs = Blog::latest()->get();
        $blog_recent = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy("blog_category", "asc")->get();
        // $cat_name = BlogCategory::findOrFail($id);

        return view("frontend.blog", compact('allblogs', 'blog_recent', 'categories'));
    }// end method


}
