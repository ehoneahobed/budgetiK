@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        
        <h3>Transactional Expenditure</h3>
        <div class="row col-md-10 mt-4 ml-5">
            
            <div class="card col-md-12">
                <form action="{{ route('transactions.expense.show') }}" method="GET">
            
                    <div class="row mt-4 ml-3">
                        <div class="col-md-12" ><h6>Select Interval to view Expenditure</h6></div>
                        <br>
                        <div class="mb-3 col-md-4 offset-md-1">
                            <label for="exampleInputEmail1" class="form-label">From</label>
                            <input type="date" name="start_date" class="form-control" id="">
                        
                            @error('start_date')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror  

                        </div>
                        <div class="mb-3 col-md-2"></div>

                        <div class=" mb-3 col-md-4">
                            <label for="exampleInputEmail1" class="form-label">To</label>
                            <input type="date" name="end_date" class="form-control" id="">
                        
                            @error('end_date')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror  

                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary col-md-5 offset-md-4">View Expenses Between This Interval</button>
                </form><br>

            </div>
            
            
            <div class="card col-md-12 mt-5">
                <!-- show alert message if exists -->
                @if (session('success'))
                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <div class="card-header">Recently Added Transactional Expenditure</div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL NO.</th>
                            <th scope="col">Category</th>
                            <th scope="col">Expenditure Description</th>
                            <th scope="col">Amount ({{ $currency_symbol }})</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1)
                            @foreach ($expense_sources as $expense_source)
                                <tr class="">
                                    <th scope="row">
                                        {{ $i++  }}
                                    </th>
                                    <td>
                                        {{ $expense_source->category_id }}
    
                                    </td>
                                    <td>
                                        {{ $expense_source->expense_desc }}
                                    </td>
                                    <td width='15%'>
                                        {{ $expense_source->amount }}
                                    </td>
                                    <td>
                                        {{ $expense_source->date }}
                                    </td>
                                    <td> 
                                  </td>      
                            </tr>
                            @endforeach
                        
                        
                        </tbody>
                        
                    </table>
                    
                    {{-- added the bootstrap part to the pagination links to style it --}}
                    {{ $expense_sources->links("pagination::bootstrap-4") }}
    
                   
                </div>
            </div>
        </div>

        </div>
    </div>
</div>



@endsection