
<ul class="navbar-nav bg-gradient-budgetik2 sidebar sidebar-dark accordion" id="accordionSidebar " >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{asset(route('dashboard')) }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-money"></i>
        </div>
        <div class="sidebar-brand-text mx-1">BudgetiK</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{asset(route('dashboard')) }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        BUDGETS
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Budget</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Plan your budget</h6>
                <a class="collapse-item" href="{{ route('budgets') }}">All Budgets</a>
                <a class="collapse-item" href="{{ route('budget.income') }}">Income</a>
                <a class="collapse-item" href="{{ route('budget.expense') }}">Expenses</a>
            </div>
        </div>
    </li>
    
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">More about Categories</h6>
                <a class="collapse-item" href="{{asset(route('categories')) }}">Add New</a>
                <a class="collapse-item" href="{{asset(route('all.category')) }}">All Categories</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- <h6 style="color: rgb(212, 207, 207);" class="ml-3">Transactions</h6> --}}

    <!-- Heading -->
    <div class="sidebar-heading">
        TRANSACTIONS
    </div>

   

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Income</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Record your all income</h6>
                <a class="collapse-item" href="{{ asset(route('transactions.income')) }}">Add</a>
                <a class="collapse-item" href="{{ asset(route('transactions.income.view')) }}">View</a>
                
            </div>

            
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
            aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>Expenditure</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Record your all expenses</h6>
                <a class="collapse-item" href="{{ asset(route('transactions.expense')) }}">Add</a>
                <a class="collapse-item" href="{{ asset(route('transactions.expense.view')) }}">View</a>
                
            </div>

            
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- <h6 style="color: rgb(212, 207, 207);" class="ml-3">Transactions</h6> --}}

    <!-- Heading -->
    <div class="sidebar-heading">
        SETTINGS
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ asset(route('currency.settings')) }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Currency</span></a>
    </li>
    

    {{-- <!-- Nav Item - Charts -->
    

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  

</ul>

