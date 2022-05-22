@extends('admin/admin_master')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> All Portfolio</h4>

                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> All Portfolio Data </h4> <br><br>
                            <!-- <p class="card-title-desc">DataTables has most features enabled by
                                default, so all you need to do to use it with your own tables is to call
                                the construction function: <code>$().DataTable();</code>.
                            </p> -->

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Portfolio Name</th>
                                    <th>Portfolio Title</th>
                                    <th>Portfolio Image</th>
                                    
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @php($i = 1)
                                @foreach ($portfolios as $portfolio)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $portfolio->portfolio_name }} </td>
                                        <td>{{ $portfolio->portfolio_title	 }} </td>
                                        <td><img src="{{ asset($portfolio->portfolio_image) }}" width="60px" height="60px" alt=""></td>
                                        <td>{{ $portfolio->created_at }}</td>
                                        <td>{{ $portfolio->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('edit.portfolio', $portfolio->id) }}" class="btn btn-info sm" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a id="delete" href="{{ route('delete.portfolio', $portfolio->id) }}" class="btn btn-danger sm" title="Delete Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                      
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
            
@endsection