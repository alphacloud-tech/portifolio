@extends('admin/admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Home Slide Page</h4>
                        
                            <form action="{{ route('update.slide') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $homeslide->id}}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="title" 
                                            id="title" 
                                            class="form-control" 
                                            type="text" 
                                            value="{{$homeslide->title}}"
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
                                            value="{{$homeslide->short_title}}"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video url</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="video_url" 
                                            id="video_url" 
                                            class="form-control" 
                                            type="text" 
                                            value="{{ $homeslide->home_slide_image }}"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="home_slide_image" 
                                            id="home_slide_image" 
                                            class="form-control" 
                                            type="file" 
                                            value="{{ $homeslide->home_slide_image }}"
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img 
                                            class="rounded avatar-lg" 
                                            src="{{ (!empty($homeslide->home_slide_image))? 
                                                url($homeslide->home_slide_image): 
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
                                            value="Update Slide"
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

            $('#home_slide_image').change(function(e){
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