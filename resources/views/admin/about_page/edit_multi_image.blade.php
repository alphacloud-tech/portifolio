@extends('admin/admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Multi Image</h4> <br><br>
                        
                            <form action="{{ route('update.multi.image') }}" method="post" enctype="multipart/form-data">
                                
                            @csrf

                                <input type="hidden" name="id" value="{{ $multi_images->id }}">


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                                    <div class="col-sm-10">
                                        <input 
                                            name="multi_image" 
                                            id="multi_image" 
                                            class="form-control" 
                                            type="file" 
                                        >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img 
                                            class="rounded avatar-lg" 
                                            src="{{ !empty(asset($multi_images->multi_image))? asset($multi_images->multi_image): url('upload/no_image.jpg')  }} " 
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
                                            value="Update Multi Image"
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

            $('#multi_image').change(function(e){
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