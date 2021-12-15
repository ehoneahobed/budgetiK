@extends('backend.admin_master')

@section('main_content')
    

    <div class="py-12 row">
        <div class="container">
            <div class="row col-md-12 mt-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Catgory
                </h2>
            </div>

            <div class="row">
                
                <div class="col-md-12">
                   
                        <!-- show alert message after successfully adding a new category -->
                        @if (session('success'))
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
    
                        @endif

                           
                        
                        
                        
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                
                                @foreach ($categories as $category)
                                <form action="{{ url('admin/category/update/'.$category->id) }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                      
                                      <input type="text" class="form-control" name="category_name" value="{{ $category->category }}">
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror  
        
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Description</label>
                                        
                                        <textarea type="text" class="form-control" name="category_description" >{{ $category->cat_description }}</textarea>
                                          @error('category_description')
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror  
          
                                      </div>
                                    
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Type</label>
                                        
                                        <select name="category_type" id="category_type" class="form-control">
                                            <option value="{{ $category->cat_type }}">{{ $category->cat_type }}</option>
                                            <option value="Cash Out">Cash Out</option>
                                        </select>
                
                                          @error('category_type')
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror  
          
                                      </div>
                                   

                                    
                                    

                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
       
    

@endsection