<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\BudgetController;
use App\HTTP\Controllers\IncomeController;
use App\HTTP\Controllers\ExpenseController;
use App\HTTP\Controllers\CategoryController;
use App\HTTP\Controllers\TincomeController;
use App\HTTP\Controllers\TexpenseController;
use App\HTTP\Controllers\DashboardController;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\SettingsController;
use App\HTTP\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('currency', [SettingsController::class, 'showCurrency'])->name('currency.settings');

Route::post('currency/activate', [ProfileController::class, 'setCurrency'])->name('currency.activating');

//Route::get('user/profile', [AuthController::class, 'showProfile'])->name('profile.show');

//Route::get('/register', 'RegistrationController@create');
//Route::post('register', [AuthController::class, 'userStore']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'displayDashboard'])->name('dashboard');

// Routes for BudgetController
    Route::get('admin/budgets', [BudgetController::class, 'displayBudget'])->name('budgets');

    Route::post('admin/budgets/create', [BudgetController::class, 'createBudget'])->name('create.budget');

    // edit budget
    Route::get('admin/budgets/edit/{id}', [BudgetController::class, 'editBudget']);

    //update budget
    Route::post('admin/budgets/update/{id}', [BudgetController::class, 'updateBudget']);

// Routes for incomeController
    Route::get('admin/budgets/income', [IncomeController::class, 'chooseBudget'])->name('budget.income');

    Route::get('admin/budgets/income/add/', [IncomeController::class, 'newBudgetIncome'])->name('budget.income.new');

    Route::post('admin/budgets/income/save', [IncomeController::class, 'SaveBudgetIncome'])->name('budget.income.save');

// Routes for ExpenseController
    Route::get('admin/budgets/expense', [ExpenseController::class, 'chooseBudget'])->name('budget.expense');

    Route::get('admin/budgets/expense/add/', [ExpenseController::class, 'newBudgetExpense'])->name('budget.expense.new');

    Route::post('admin/budgets/expense/save', [ExpenseController::class, 'SaveBudgetExpense'])->name('budget.expense.save');



// routes for everything concerning categories
    Route::get('/categories', [CategoryController::class, 'ShowCategories'])->name('categories');

    // to add new categories
    Route::post('category/add', [CategoryController::class, 'AddCategory'])->name('add.category');

    // to display all created categories
    Route::get('/category/all', [CategoryController::class, 'DisplayCategories'])->name('all.category');

    // to edit categories
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'editCategory']);

    //update categories
    Route::post('admin/category/update/{id}', [CategoryController::class, 'updateCategory']);

    // delete category
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'deleteCategory']);


// Routes for all TincomeController
    Route::get('admin/transactions/income/add', [TincomeController::class, 'AddIncome'])->name('transactions.income');
    Route::post('admin/transactions/income/save', [TincomeController::class, 'SaveIncome'])->name('transaction.income.save');
    Route::get('admin/transactions/income/view', [TincomeController::class, 'ViewIncome'])->name('transactions.income.view');
    Route::get('admin/transactions/income/show', [TincomeController::class, 'ShowIncome'])->name('transactions.income.show');

    // to edit Tincome
    Route::get('admin/transactions/income/edit/{id}', [TincomeController::class, 'editTincome']);

    // to update Tincome 
    Route::post('admin/transactions/income/update/{id}', [TincomeController::class, 'updateTincome']);

    // to delete Tincome 
    Route::get('admin/transactions/income/delete/{id}', [TincomeController::class, 'deleteTincome']);


// Routes for all TexpenseController
    Route::get('admin/transactions/expense/add', [TexpenseController::class, 'AddExpense'])->name('transactions.expense');
    Route::post('admin/transactions/expense/save', [TexpenseController::class, 'SaveExpense'])->name('transaction.expense.save');
    Route::get('admin/transactions/expense/view', [TexpenseController::class, 'ViewExpense'])->name('transactions.expense.view');
    Route::get('admin/transactions/expense/show', [TexpenseController::class, 'ShowExpense'])->name('transactions.expense.show');
    
// Routes for all DashboardController
    Route::get('admin/dashboard/', [DashboardController::class, 'ShowDashboard'])->name('dashboard.summary');