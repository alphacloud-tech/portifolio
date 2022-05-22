<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $about_page = About::findOrFail(1);
        return view('admin.about_page.about_page_all', compact('about_page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $about_id = $request->id; // the id is from hidden input fielf from form

        if ($request->file('about_image')) {
            # code...

            $image = $request->file('about_image');

            // we wnt to generate an id wen we upload an image
            // hexdec() : to create a unique id
            $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

            Image::make($image)->resize(523,605)->save('upload/home_about/'.$image_name_gen);

            $save_url = 'upload/home_about/'.$image_name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message'=>'About Page Updated with Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        }else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = array(
                'message'=>'About Page Updated without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        } // End else

        
    }// End Method

    public function HomeAbout() {
        $home_about = About::findOrFail(1);
        return view("frontend.about_page", compact('home_about'));
    }

    public function AddAboutMultiImage() {
        // $home_about = About::findOrFail(1);
        return view("admin.about_page.add_multi_image");
    }// End Method

    public function StoreAboutMultiImage(Request $request) {
        
       $image = $request->file("multi_image");

       foreach ($image as $multi_image) {
           # code...
           $image_name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension(); // i.e 54545.jpg

           Image::make($multi_image)->resize(220,220)->save('upload/about_multi_image/'.$image_name_gen);

           $save_url = 'upload/about_multi_image/'.$image_name_gen;

           MultiImage::insert([
              
               'multi_image' => $save_url,
               'created_at' => Carbon::now(),
            //    'updated_at' =>Carbon::now(),
           ]);

        }// End foreach

        $notification = array(
            'message'=>'Multi Image Inserted  Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route("all.multi.image")->with($notification);

       

       
    }// End Method


    public function AllAboutMultiImage() {

        $multi_images = MultiImage::all();

        return view("admin.about_page.all_multi_image", compact('multi_images'));
    }// end method

    public function EditAboutMultiImage($id) {

        $multi_images = MultiImage::findOrFail($id);

        return view("admin.about_page.edit_multi_image", compact('multi_images'));
    }// end method

    public function UpdateAboutMultiImage(Request $request) {

        $multi_images_id = $request->id;

        if ($request->file('multi_image')) {
            # code...

            $image = $request->file('multi_image');

            // we wnt to generate an id wen we upload an image
            // hexdec() : to create a unique id
            $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

            Image::make($image)->resize(220,220)->save('upload/about_multi_image/'.$image_name_gen);

            $save_url = 'upload/about_multi_image/'.$image_name_gen;

            MultiImage::findOrFail($multi_images_id)->update([
                'multi_image' => $save_url,
            ]);

            $notification = array(
                'message'=>'About Page Updated with Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route("all.multi.image")->with($notification);
        }


    }// end method


    public function DeleteAboutMultiImage($id) {

        $multi_images = MultiImage::findOrFail($id);

        $img = $multi_images->multi_image;

        unlink($img);

       MultiImage::findOrFail($id)->delete();

       $notification = array(
        'message'=>'Multi Image deleted Successfully',
        'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    }// end method


}
