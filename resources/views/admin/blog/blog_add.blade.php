@extends('admin/admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>


    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Blog Page</h4> <br><br>
                        
                            <form action="{{ route('store.blog') }}" method="post" enctype="multipart/form-data">
                                
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category</label>

                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="blog_category_id" id="blog_category_id">
                                            <option value="">Select Option</option>

                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->blog_category }}</option>
                                            @endforeach
                                        </select>
                                        @error('blog_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="blog_title" 
                                            id="blog_title" 
                                            class="form-control" 
                                            type="text" 
                                           
                                        >
                                        @error('blog_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="blog_tags" 
                                            id="blog_tags" 
                                            class="form-control" 
                                            type="text" 
                                            value="home,tech,sport"
                                            data-role="tagsinput"
                                        >
                                        @error('blog_tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                                    <div class="col-sm-10">
                                        <textarea
                                            class="form-control" 
                                            name="blog_description" 
                                            id="elm1" cols="30" rows="10"
                                            >
                                           
                                        </textarea>
                                        @error('blog_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                               

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="blog_image" 
                                            id="blog_image" 
                                            class="form-control" 
                                            type="file" 
                                            
                                        >
                                        @error('blog_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img 
                                            class="rounded avatar-lg" 
                                            src="{{ url('upload/no_image.jpg')  }} " 
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
                                            class="btn btn-primary btn waves-effect waves-light"
                                            value="Add Portfolio"
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

            $('#blog_image').change(function(e){
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