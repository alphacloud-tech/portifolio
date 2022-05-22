<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Image;

class HomeSliderController extends Controller
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
        $homeslide = HomeSlide::findOrFail(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
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
        $slide_id = $request->id; // the id is from hidden input fielf from form

        if ($request->file('home_slide_image')) {
            # code...

            $image = $request->file('home_slide_image');

            // we wnt to generate an id wen we upload an image
            // hexdec() : to create a unique id
            $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

            Image::make($image)->resize(636,852)->save('upload/home_slide/'.$image_name_gen);

            $save_url = 'upload/home_slide/'.$image_name_gen;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'home_slide_image' => $save_url,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message'=>'Home Slide Updated with Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        }else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message'=>'Home Slide Updated without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        } // End else

        
    }

    
}
