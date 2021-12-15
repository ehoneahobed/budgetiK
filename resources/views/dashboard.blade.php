@extends('backend.admin_master')

@section('main_content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
</div>

<h5 class="h5 mb-0 text-gray-800">Summaries for this month</h5>
<br>

{{-- @if (!$this_month_incomes) --}}
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">Total Income Earned</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @if (count($this_month_incomes)==0)
                    @php $total_income = 0.00; @endphp
                        <span style="font-size: 15px">{{ $currency }}</span><span style="font-size: 30px"> {{ round($total_income) }} </span>
                @else
                    @foreach ($this_month_incomes as $income )
                    @php
                    //convert all the income amount into an array so that I can subsequeently apply array sum on it
                        $inc_amount[] = $income->amount;
                    @endphp 
                
                    @endforeach
                    @php
                        
                    @endphp
                    <span style="font-size: 30px">{{ $currency }} {{ round($total_income =array_sum($inc_amount), 2) }} </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-danger">Total Amount Spent</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @if (count($this_month_expense)==0)
                    @php $total_expense = 0.00; @endphp
                    <span style="font-size: 15px">{{ $currency }}</span> <span style="font-size: 30px">{{ $total_expense }} </span>
                @else

                    @foreach ($this_month_expense as $expense )
                    @php
                    //convert all the income amount into an array so that I can subsequeently apply array sum on it
                        $exp_amount[] = $expense->amount;
                    @endphp 
                
                @endforeach

                <span style="font-size: 15px">{{ $currency }}</span> <span style="font-size: 30px"> {{ round($total_expense = array_sum($exp_amount), 2) }} </span>
              @endif
            </div>
        </div>
    </div>

   

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Outstanding Amount</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @php
                    $outstanding_amount = ($total_income-$total_expense);
                @endphp
            <span style="font-size: 15px">{{ $currency }}</span> <span style="font-size: 30px"> {{ round($outstanding_amount, 2) }} </span>
            
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">% Income Spent</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               @if ($total_expense == 0 AND $total_income == 0)
                  @php $percent_income_spent = 0.00."%"; @endphp
                  <span style="font-size: 25px">{{ $percent_income_spent }} </span>
                @else
                @php
                    $percent_income_spent = ($total_expense/$total_income)*100;
                @endphp
                 <div style="font-size: 25px"> {{ round($percent_income_spent, 2) }}% 
                @endif

                <div class="progress progress-sm">
                    <div class="progress-bar 
                        @if (round($percent_income_spent, 2)>50)
                            {{ "bg-warning" }} //if more than 50% of income spent show warning color
                        @endif
                    
                        bg-info" role="progressbar"
                        style="width: {{ round($percent_income_spent,2) }}%" aria-valuenow="{{ round($percent_income_spent) }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
           
            </div>
        </div>
    </div>
</div>

            <div class="card-body shadow mb-4">
              <div class="card-text col-md-4 ">

                    <form action="{{ route('dashboard.summary') }}" method="GET">
                        <label for="exampleInputEmail1" class="form-label">Choose budget to display details</label>
                        <select name="budget_id" id="" class="form-control">
                            @foreach ($budgets as $budget )
                                <option value="{{ $budget->id }}">{{ $budget->budget_name }}</option>
                            @endforeach
                        </select>

                        @error('budget_id')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror 
                        
                        <br>
                        <input type="submit" value="View Budget Details" class="btn btn-info">
                    </form>
                </div>
            </div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    @if (!isset($name_of_selected_budget))
        @php $name_of_selected_budget = "No budget selected" @endphp
    @else
    
                <h5 class="h5 mb-0 text-gray-800">Summaries for selected budget <h6>({{ $name_of_selected_budget }})</h6></h5>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    @endif
</div>
<!-- Content Row -->
<div class="row col-md-12">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Savings (On Budget)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            @if (count($selected_inc_projected)==0)
                                @php $total_projected_income = 0.00; @endphp
                            @else   
                                {{-- savings = Projected income - projected expenses --}}
                                 {{-- calculating total projected income --}}
                                    @foreach ($selected_inc_projected as $projected_income )
                                        @php
                                        //convert all the income amount into an array so that I can subsequeently apply array sum on it
                                            $projected_inc_amount[] = $projected_income->budgeted_amount;
                                        @endphp 
                                
                                @endforeach
                                @php
                                    $total_projected_income =array_sum($projected_inc_amount);
                                @endphp
                            @endif

                            @if (count($selected_exp_projected)==0)
                                @php $total_projected_expense = 0.00; @endphp
                            @else 
                                    {{-- calculating total projected expenses --}}
                                    @foreach ($selected_exp_projected as $projected_expense )
                                        @php
                                        //convert all the income amount into an array so that I can subsequeently apply array sum on it
                                            $projected_exp_amount[] = $projected_expense->budgeted_amount;
                                        @endphp 
                                
                                @endforeach
                                @php $total_projected_expense =array_sum($projected_exp_amount); @endphp
                            @endif

                            @php
                               // calculating the savings
                               $savings = $total_projected_income - $total_projected_expense;
                           @endphp

                           <span style="font-size: 20px">{{ $currency }} {{ round($savings, 2) }} </span>
                           
                      

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Income Generated</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if (count($selected_inc_actual)==0)
                                @php $total_actual_income = 0.00; @endphp
                            @else  
                            {{-- calculating total actual income --}}
                            @foreach ($selected_inc_actual as $actual_income )
                                @php
                                //convert all the income amount into an array so that I can subsequeently apply array sum on it
                                    $actual_inc_amount[] = $actual_income->amount;
                                @endphp 
                           
                           @endforeach
                           @php
                              $total_actual_income =array_sum($actual_inc_amount); @endphp
                            @endif
                            
                            @if ($total_actual_income ==0 AND $total_projected_income ==0)
                                {{ $percent_inc_generated = 0.00 }}
                            @else
                            @php
                            // calculating percentage income generated
                              $percent_inc_generated = ($total_actual_income/$total_projected_income)*100;
                              echo round($percent_inc_generated, 2);
                           @endphp
                            %
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-percent  fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Budget Spent (Percent)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @if (count($selected_exp_actual)==0)
                                        @php $total_actual_expense = 0.00; @endphp
                                    @else  
                                            
                                    {{-- calculating total actual expense --}}
                                    @foreach ($selected_exp_actual as $actual_expense )
                                    @php
                                    //convert all the income amount into an array so that I can subsequeently apply array sum on it
                                        $actual_exp_amount[] = $actual_expense->amount;
                                    @endphp 
                       
                                    @endforeach
                                    @php
                                        $total_actual_expense =array_sum($actual_exp_amount); @endphp
                                    @endif
                                    
                                    @if ($total_actual_expense ==0 AND $total_projected_expense ==0)
                                        {{ $pbs = 0 }}
                                    @else
                                    @php
                                    // calculating percentage budget spent
                                        $percent_budget_spent = ($total_actual_expense/$total_projected_expense)*100;
                                        echo $pbs = round($percent_budget_spent, 2);
                                    @endphp
                                        %
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar
                                    @if ($pbs<25)
                                    {{ "bg-success" }} //if less than 75% of income spent show success color

                                    @elseif ($pbs>50 && $pbs<75)
                                    {{ "bg-warning" }} //if more than 50% but less then 75% of income spent show warning color

                                    @elseif ($pbs>75)
                                    {{ "bg-danger" }} //if more than 75% of income spent show danger color

                                    @else
                                    {{ "bg-info" }} //if less than 50% but greater than 25% of income spent show info color
                                @endif
                                    
                                    " role="progressbar"
                                        style="width: {{ $pbs }}%" aria-valuenow="{{ $pbs }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Expenses Incurred</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currency }} {{ round($total_actual_expense, 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign  fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card shadow h-100 py-1">
            <div class="card-header">
                <h6>Summary of income earned grouped by categories</h6>
            </div>
            <div class="card-body">
                {{-- Bringing in various charts --}}
                <canvas id="incChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div> 
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card shadow h-100 py-1">
            <div class="card-header">
                <h6>Summary of expenses grouped by categories</h6>
            </div>
            <div class="card-body">
                {{-- Bringing in various charts --}}
                <canvas id="expChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>  
</div>

{{-- 
@endif --}}
<!-- Content Row -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script>
    var ctx = document.getElementById('incChart').getContext('2d');
    var incChart = new Chart(ctx, {
        type: 'bar',
        data: {
 //           labels: ["Red", "Blue", "Yellow"],
            //labels: ["Service Fee - Web Design","Test 1","test 3"],
            labels: <?php echo json_encode($list_of_inc_categories); ?>,
            datasets: [{
                label: 'Income Earned Per Category',
                //data: [12, 19, 3],
                data: <?php echo json_encode($amount_per_inc_category); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // script for the expenses chart
    var exCx = document.getElementById('expChart').getContext('2d');
    var expChart = new Chart(exCx, {
        type: 'bar',
        data: {
 //           labels: ["Red", "Blue", "Yellow"],
            //labels: ["Service Fee - Web Design","Test 1","test 3"],
            labels: <?php echo json_encode($list_of_exp_categories); ?>,
            datasets: [{
                label: 'Expenses made Per Category',
                //data: [12, 19, 3],
                data: <?php echo json_encode($amount_per_exp_category); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 2)',
                    'rgba(54, 162, 235, 2)',
                    'rgba(255, 206, 86, 2)',
                    'rgba(75, 192, 192, 2)',
                    'rgba(153, 102, 255, 2)',
                    'rgba(255, 159, 64, 2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

@endsection

