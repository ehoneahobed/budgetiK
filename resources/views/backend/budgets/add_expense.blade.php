@extends('backend.admin_master')

@section('main_content')
<div class="py-12 row">
    <div class="container">
        <div class="row col-md-12 mt-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                
                Add Projected Expenditure to {{ $selected_budget->budget_name }}
            </h2>

            <div class="col-md-8">
                <div class="card">
                    <!-- show alert message after successfully adding a new category -->
                    @if (session('success'))
                    
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif

                    <div class="card-header">Projected Expenditure for current budget</div>
               
            

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">SL NO.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Expense Description</th>
                        <th scope="col">Budgeted Amount ({{ $currency_symbol }})</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach ($expense_sources as $expense_source)
                            <tr class="">
                                <th scope="row">{{ $i++  }}</th>
                                <td>
                                    {{ $expense_source->category }}

                                </td>
                                <td>{{ $expense_source->expense_desc }}</td>
                                <td width='10%'>
                                    {{ $expense_source->budgeted_amount }}
                                </td>
                                <td>
                                  <a href="#" data-toggle="tooltip" data-placement="top" title="Edit Income">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg></a>
                                  <a href="#" data-toggle="tooltip" data-placement="top" title="Delete Income"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg></a>    
                              </td>      
                        </tr>
                        @endforeach
                    
                    
                    </tbody>
                    
                </table>
                
                {{-- added the bootstrap part to the pagination links to style it --}}
                {{ $expense_sources->links("pagination::bootstrap-4") }}
                  
                
                

            </div>
            
        </div>


        <div class="col-md-4">
            <div class="card">
                <!-- show alert message if exists -->
                @if (session('success'))
                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <div class="card-header">Add Income</div>
                <div class="card-body">
                   <h4> {{ $selected_budget->budget_name }}</h4>
                    <form action="{{ route('budget.expense.save') }}" method="POST">
                        @csrf

                        <input type="hidden" class="form-control"  name="budget_id" value="{{ $selected_budget->id }}">
                        
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Expenditure Category</label>
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

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Expenditure Description</label>
                            <textarea name="expense_desc" class="form-control" id="" cols="30" rows="5"></textarea>
                          
                              @error('expense_desc')
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror  
  
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Budgeted Amount ({{ $currency_symbol }})</label>
                            <input type="text" class="form-control" name="budgeted_amount">
                          
                              @error('budgeted_amount')
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror  
  
                          </div>
                        
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                      </form>
                </div>
            </div>
        </div>

    </div>


        </div>
    </div>
</div>

@endsection