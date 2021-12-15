@extends('backend.admin_master')

@section('main_content')
    

    <div class="py-12 row">
        <div class="container">
            <div class="row col-md-12 mt-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    All Categories
                </h2>
            </div>

            <div class="row">
                
                <div class="col-md-8">
                    <div class="card">
                        <!-- show alert message after successfully adding a new category -->
                        @if (session('success'))
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
    
                        @endif

                        <div class="card-header">All Categories</div>
                           
                        
                        
                        <div class=" table-responsive">
                            <div style="overflow-x:auto;">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col" width='5%'>#</th>
                                        <th scope="col" width='20%'>Category</th>
                                        <th scope="col" width='15%'>Type</th>
                                        <th scope="col" width='35%'>Description</th>
                                        <th scope="col" width='15%'>Created On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @php ($i = 1)
                                        @foreach ($categories as $category)
                                            <tr class="">
                                                <th scope="row">{{ $i++  }}</th>
                                                <td>{{ $category->category }}</td>
                                                <td>{{ $category->cat_type }}</td>
                                                <td width='10%'>{{ $category->cat_description }}</td>
                                                <td>{{ $category->created_at->diffforHumans() }}</td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            
                    </div>

                </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Add Category</div>
                            <div class="card-body">
                                <form action="{{ route('add.category') }}" method="POST">
                                    @csrf
        
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Category</label>
                                      <input type="text" class="form-control" name="category" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror  
        
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Type</label>
                                        <select name="cat_type" class="form-control" id="cat_type">
                                            <option value="Cash In">Cash In</option>
                                            <option value="Cash Out">Cash Out</option>
                                        </select>

                                        
                                          @error('cat_type')
                                              <span class="text-danger"> {{ $message }}</span>
                                          @enderror  
          
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Description</label>
                                        <textarea name="cat_description" class="form-control" id="cat_description" cols="30" rows="5"></textarea>
                                        
                                          @error('cat_description')
                                              <span class="text-danger">{{ $message }} </span>
                                          @enderror  
          
                                      </div>
                                    
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
       
    

@endsection