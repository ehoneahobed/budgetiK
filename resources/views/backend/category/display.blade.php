@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        <div class="row col-md-12 mt-5">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Here are all available Categories
            </h2>
        </div>

        <div class="row">
                
            <div class="col-md-6">
                <div class="card">
                    <!-- show alert message after successfully adding a new category -->
                    @if (session('success'))
                        
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif
                    
                    <div class="card-header"><h4>Cash In Categories</h4></div>
                </div>

                <div class=" table-responsive">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" width='5%'>#</th>
                                <th scope="col" width='40%'>Category</th>
                                <th scope="col" width='50%'>Description</th>
                                <th scope="col" width='5%'>Action<th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                @php ($i = 1)
                                @foreach ($cashin_cats as $cashin_cat)
                                    <tr class="">
                                        <th scope="row">{{ $i++  }}</th>
                                        <td>{{ $cashin_cat->category }}</td>
                                        <td width='10%'>{{ $cashin_cat->cat_description }}</td>
                                        <td>
                                            <a href="{{ url('admin/category/edit/'.$cashin_cat->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Category Details"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                              </svg></a>

                                              <a href="{{ url('admin/category/delete/'.$cashin_cat->id) }}" data-toggle="tooltip" data-placement="top" title="Delete Category"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                      </svg></a>    
                                        </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Cash Out Categories</h4></div>
                </div>

                <div class=" table-responsive">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width='5%'>#</th>
                                    <th scope="col" width='40%'>Category</th>
                                    <th scope="col" width='50%'>Description</th>
                                    <th scope="col" width='5%'>Action<th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @php ($i = 1)
                                @foreach ($cashout_cats as $cashout_cat)
                                    <tr class="">
                                        <th scope="row">{{ $i++  }}</th>
                                        <td>{{ $cashout_cat->category }}</td>
                                        <td width='10%'>{{ $cashout_cat->cat_description }}</td>
                                        <td>
                                            <a href="{{ url('admin/category/edit/'.$cashout_cat->id) }}" data-toggle="tooltip" data-placement="top" title="View Budget Details"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                              </svg></a>

                                              <a href="{{ url('admin/category/delete/'.$cashout_cat->id) }}" data-toggle="tooltip" data-placement="top" title="Delete Category"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg></a>
                                        </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection