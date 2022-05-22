<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    //

    public function AllBlogCategory() {
        $blog_categorys = BlogCategory::latest()->get();
        return view("admin.blog_category.blog_category_all", compact('blog_categorys'));
    }// end method

    public function AddBlogCategory () {
        $blog_categorys = BlogCategory::latest()->get();
        return view("admin.blog_category.blog_category_add", compact('blog_categorys'));
    }// end method

    public function StoreCategory (Request $request) {
       
        $request->validate([
            'blog_category' => 'required',
            
        ],[
            'blog_category' => 'Category Name is Required',
            
        ]);

        BlogCategory::insert([
            'blog_category' => $request->blog_category,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Category created  Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.blog.category')->with($notification);


    }// end method


    public function EditCategory ($id) {
        $blog_categorys = BlogCategory::findOrFail($id);

        return view("admin.blog_category.blog_category_edit", compact('blog_categorys'));
    }// end method


    public function UpdateCategory (Request $request) {

        $request->validate([
            'blog_category' => 'required',
            
        ],[
            'blog_category' => 'Category Name is Required',
            
        ]);

        
        $category_id = $request->id; // the id is from hidden input fielf from form

        BlogCategory::findOrFail($category_id)->update([
            'blog_category' => $request->blog_category,
           
        ]);

        $notification = array(
            'message'=>'Category Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.blog.category')->with($notification);
      
    }// end method


    public function DeleteCategory ($id) {

       BlogCategory::findOrFail($id)->delete();

       $notification = array(
        'message'=>'Category deleted Successfully',
        'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }// end method

}
