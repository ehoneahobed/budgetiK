@extends('backend.admin_master')

@section('main_content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
</div>



<br>
<div class="row">
    <div class="col-xl-10 col-md-10 mb-4 offset-md-1">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h5 class="h5 mb-0 text-gray-800">Hi! <b> {{ $user_details->name }}</b></h5> --}}
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>
                    Let's get started creating your budget
                    <br><br>
                    <h6 style="color: red"><b>Follow the following instructions</b></h6>
                    <ol>
                        <li>Create various categories for your <a href="{{asset(route('categories')) }}">income or expected income</a></li>
                        <li>Create various categories for your <a href="{{asset(route('categories')) }}">expenses or expected expenses</a></li>
                        <li>Create a <a href="{{asset(route('budgets')) }}">new budget</a></li>
                        <li>Add all expected <a href="{{ route('budget.income') }}">income</a> elements to the budget you created</li>
                        <li>Add all expected <a href="{{ route('budget.expense') }}">expenses</a> elements to the budget you created</li>
                    </ol>
                </p>
                

              </div>
        </div>
    </div>
</div>
<!-- Content Row -->

@endsection

