@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        @foreach ($income_sources as $income_source)
        <h3>Edit Transactional Income</h3>
        <div class="row col-md-12 mt-4 ml-5">
            
            <div class="card col-md-10">
                <!-- show alert message if exists -->
                @if (session('success'))
                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <div class="card-header">Edit Transactional Income</div>
                <div class="card-body">
                   <h4> </h4>
                    <form action="{{ url('admin/transactions/income/update/'.$income_source->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 col-md-5">
                          <label for="exampleInputEmail1" class="form-label">Income Category</label>
                          {{-- <select class="form-control" name="category_id" id="">
                              <option value="" >Choose a category</option>
                              @foreach ($categories as $category )
                                  <option value="{{ $category->id }}">{{ $category->category }}</option>
                              @endforeach
                          </select> --}}
                          @php  
                            //dd($categories);

                          @endphp

                          @foreach ($categories as $category )
                              
                         
                          <input type="text" class="form-control" name="category" value="{{ $category->category}}" disabled>

                            @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror  

                            @endforeach
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="exampleInputEmail1" class="form-label">Income Description</label>
                            <textarea name="income_desc" class="form-control" id="" cols="30" rows="2">{{ $income_source->income_desc }}</textarea>
                          
                              @error('income_desc')
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror  
  
                          </div>

                          <div class="mb-3 col-md-12 row">
                            <div class="col-md-4 ">
                                <label for="exampleInputEmail1" class="form-label">Amount ({{ $currency_symbol }})</label>
                                <input type="text" class="form-control" name="actual_amount" value="{{ $income_source->amount }}">
                            
                                @error('actual_amount')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror  
                            </div>
                                
  
                            <div class="col-md-4 ml-5">
                                <label for="exampleInputEmail1" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" value="{{ $income_source->date }}">
                            
                                @error('date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror  
                            </div>
                          </div>
                          @endforeach
                        
                        <button type="submit" class="btn btn-primary">Update Income</button>
                      </form>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>



@endsection