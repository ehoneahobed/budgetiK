@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        
        <h3>Transactional Income</h3>
        <div class="row col-md-12 mt-4 ml-5">
            
            <div class="card col-md-10">
                <!-- show alert message if exists -->
                @if (session('success'))
                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <div class="card-header">Add Transactional Income</div>
                <div class="card-body">
                   <h4> </h4>
                    <form action="{{ route('transaction.income.save') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 col-md-5">
                          <label for="exampleInputEmail1" class="form-label">Income Category</label>
                          <select class="form-control" name="category_id" id="">
                              <option value="" >Choose a category</option>
                              @foreach ($categories as $category )
                                  <option value="{{ $category->id }}">{{ $category->category }}</option>
                              @endforeach
                          </select>
                        
                            @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror  

                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="exampleInputEmail1" class="form-label">Income Description</label>
                            <textarea name="income_desc" class="form-control" id="" cols="30" rows="5"></textarea>
                          
                              @error('income_desc')
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror  
  
                          </div>

                          <div class="mb-3 col-md-12 row">
                            <div class="col-md-4 ">
                                <label for="exampleInputEmail1" class="form-label">Amount ({{ $currency_symbol }})</label>
                                <input type="text" class="form-control" name="actual_amount">
                            
                                @error('actual_amount')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror  
                            </div>
                                
  
                            <div class="col-md-4 ml-5">
                                <label for="exampleInputEmail1" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date">
                            
                                @error('date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror  
                            </div>
                          </div>
                        
                        <button type="submit" class="btn btn-primary">Add Income</button>
                      </form>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>



@endsection