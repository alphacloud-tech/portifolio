<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class PortfolioController extends Controller
{
    //

    public function AllPortfolio () {
        $portfolios = Portfolio::latest()->get();
        return view("admin.portfolio.portfolio_all", compact('portfolios'));
    }// end method

    public function AddPortfolio () {
        $portfolios = Portfolio::latest()->get();
        return view("admin.portfolio.portfolio_add", compact('portfolios'));
    }// end method

    public function StorePortfolio (Request $request) {
       
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_description' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name' => 'Portfolio Name is Required',
            'portfolio_title' => 'Portfolio Title is Required',
            'portfolio_description' => 'Portfolio Description is Required',
            'portfolio_image' => 'Portfolio Image is Required',
        ]);

        $image = $request->file('portfolio_image');

        // we wnt to generate an id wen we upload an image
        // hexdec() : to create a unique id
        $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

        Image::make($image)->resize(1020,519)->save('upload/portfolio_image/'.$image_name_gen);

        $save_url = 'upload/portfolio_image/'.$image_name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Portfolio created  Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.portfolio')->with($notification);


    }// end method


    public function EditPortfolio ($id) {
        $portfolio = Portfolio::findOrFail($id);

        return view("admin.portfolio.portfolio_edit", compact('portfolio'));
    }// end method

    public function UpdatePortfolio (Request $request) {
        
        $portfolio_id = $request->id; // the id is from hidden input fielf from form

        if ($request->file('portfolio_image')) {
            # code...

            $image = $request->file('portfolio_image');

            // we wnt to generate an id wen we upload an image
            // hexdec() : to create a unique id
            $image_name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // i.e 54545.jpg

            Image::make($image)->resize(1020,519)->save('upload/portfolio_image/'.$image_name_gen);

            $save_url = 'upload/portfolio_image/'.$image_name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message'=>'Portfolio Updated with Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.portfolio')->with($notification);
        }else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);

            $notification = array(
                'message'=>'Portfolio Updated without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.portfolio')->with($notification);
        } // End else

    }// end method

    public function DeletePortfolio ($id) {

        $multi_images = Portfolio::findOrFail($id);

        $img = $multi_images->portfolio_image;

        unlink($img);

       Portfolio::findOrFail($id)->delete();

       $notification = array(
        'message'=>'Portfolio deleted Successfully',
        'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }// end method

    public function DetailsPortfolio ($id) {

        $portfolio = Portfolio::findOrFail($id);

        return view("frontend.portfolio_details", compact('portfolio'));
    }// end method

    public function Portfolio () {

        $portfolios = Portfolio::latest()->get();

        return view("frontend.portfolio_page", compact('portfolios'));
    }// end method
}
