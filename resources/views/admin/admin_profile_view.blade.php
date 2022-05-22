@extends('admin/admin_master')

@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <center>
                             
                            <img 
                                class="rounded-circle avatar-xl mt-4" 
                                src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image): url('upload/no_image.jpg') }} " 
                                alt="Card image cap"
                            > 

                        </center>
                        <div class="card-body">
                            <h4 class="card-title">Name: {{ $adminData->name}}</h4>
                            <hr>
                            <h4 class="card-title">User Email: {{ $adminData->email}}</h4>
                            <hr>
                            <h4 class="card-title">Username: {{ $adminData->username}}</h4>
                            <hr>
                           <a href="{{ route('edit.profile') }}" class="btn btn-primary btn-rounded waves-effect waves-light">Edit Profile</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>
</div>
@endsection