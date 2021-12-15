@extends('backend.admin_master')

@section('main_content')
    

    <div class="py-12 row">
        <div class="container">
            <div class="row col-md-12 mt-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Budgets
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
                                
                                @foreach ($budgets as $budget)
                                <form action="{{ url('admin/budgets/update/'.$budget->id) }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Budget Name</label>
                                      
                                      <input type="text" class="form-control" name="budget_name" value="{{ $budget->budget_name }}" placeholder="A name to identify your budget">
                                        @error('budget_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror  
        
                                    </div>

                                    
                                    <div class="mb-3">
                                        {{-- <div class="input-group date" data-provide="datepicker"> --}}
                                            <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ $budget->start_date }}">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        {{-- </div> --}}
                                    </div>

                                    <div class="mb-3">
                                        {{-- <div class="input-group date" data-provide="datepicker"> --}}
                                            <label for="exampleInputEmail1" class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ $budget->end_date }}">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    

                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Update Budget</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
       
    

@endsection