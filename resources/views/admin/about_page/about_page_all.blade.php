@extends('admin/admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">About Page</h4>
                        
                            <form action="{{ route('update.about') }}" method="post" enctype="multipart/form-data">
                                
                            @csrf

                                <input type="hidden" name="id" value="{{ $about_page->id}}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="title" 
                                            id="title" 
                                            class="form-control" 
                                            type="text" 
                                            value="{{$about_page->title}}"
                                        >
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="short_title" 
                                            id="short_title" 
                                            class="form-control" 
                                            type="text" 
                                            value="{{$about_page->short_title}}"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea
                                            class="form-control" 
                                            name="short_description" 
                                            id="short_description" cols="30" rows="10"
                                            >
                                            {{ $about_page->short_description }}
                                        </textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="long_description">
                                            {{ $about_page->long_description }}
                                        </textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                               

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="about_image" 
                                            id="about_image" 
                                            class="form-control" 
                                            type="file" 
                                            value="{{ $about_page->about_image }}"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img 
                                            class="rounded avatar-lg" 
                                            src="{{ (!empty($about_page->about_image))? 
                                                url($about_page->about_image): 
                                                url('upload/no_image.jpg') }} " 
                                            alt="Card image cap"
                                            id="showImage" 
                                        >
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input 
                                            type="submit" 
                                            class="btn btn-primary btn waves-effect waves-light col-sm-12"
                                            value="Update About Page"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                            </form>
                        
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //get where the image is commin from 

            $('#about_image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    // where to show image 
                    $("#showImage").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>


@endsection