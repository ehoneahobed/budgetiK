@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        <div class="row col-md-12 mt-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Projected Expenditure to Budget
            </h2>
        </div>

        <div class="card">
            <!-- show alert message if exits-->
            @if (session('success'))
                        
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif

            <h5 class="card-header">Choose a budget to set projected expenditure</h5>
            <div class="card-body">
              <h5 class="card-title">Budgets</h5>
              <p class="card-text">

                <form action="{{ route('budget.expense.new') }}" method="GET">
                   
                    <label for="exampleInputEmail1" class="form-label">Choose budget</label>
                    <select name="budget_id" id="" class="form-control">
                        @foreach ($budgets as $budget )
                            <option value="{{ $budget->id }}">{{ $budget->budget_name }}</option>
                        @endforeach
                    </select>
            
                    @error('budget_id')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror 
                    
                    <br>
                    <input type="submit" value="Add expense source to budget" class="btn btn-info">
                    
                </form>
              </p>
            </div>
          </div>
        
    </div>
</div>

@endsection