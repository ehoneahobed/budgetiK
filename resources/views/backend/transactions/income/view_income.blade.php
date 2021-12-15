@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        
        <h3>Transactional Income</h3>
        <div class="row col-md-10 mt-4 ml-5">
            
            <div class="card col-md-12">
                <form action="{{ route('transactions.income.show') }}" method="GET">
                    {{-- @csrf --}}

                    <div class="row mt-4 ml-3">
                        <div class="col-md-12" ><h6>Select Interval to view Income</h6></div>
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
                    <button type="submit" class="btn btn-primary col-md-5 offset-md-4">View Income Between This Interval</button>
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

                <div class="card-header">Recently Added Transactional Income</div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL NO.</th>
                            <th scope="col">Category</th>
                            <th scope="col">Income Description</th>
                            <th scope="col">Amount ({{ $currency_symbol }})</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1)
                            @foreach ($income_sources as $income_source)
                                <tr class="">
                                    <th scope="row">
                                        {{ $i++  }}
                                    </th>
                                    <td>
                                        {{ $income_source->category_id }}
    
                                    </td>
                                    <td>
                                        {{ $income_source->income_desc }}
                                    </td>
                                    <td width='15%'>
                                        {{ $income_source->amount }}
                                    </td>
                                    <td>
                                        {{ $income_source->date }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/transactions/income/edit/'.$income_source->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Income">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg></a>
                                          <a href="{{ url('admin/transactions/income/delete/'.$income_source->id) }}" data-toggle="tooltip" data-placement="top" title="Delete Income"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg></a>  
                                  </td>      
                            </tr>
                            @endforeach
                        
                        
                        </tbody>
                        
                    </table>
                    
                    {{-- added the bootstrap part to the pagination links to style it --}}
                    {{ $income_sources->links("pagination::bootstrap-4") }}
    
                   
                </div>
            </div>
        </div>

        </div>
    </div>
</div>



@endsection