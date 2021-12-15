<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;

class ExpenseController extends Controller
{
    //
    public function chooseBudget(){
        $budgets = Budget::all();
        return view('backend.budgets.expense', compact('budgets'));
    }

    public function newBudgetExpense(Request $request){
        $selected_budget_id = $request->budget_id;
        return $this->displayBudget($selected_budget_id);
        
    }

    public function SaveBudgetExpense(REQUEST $request){
        $validate = $request->validate([
            'category_id' => 'required',
            'expense_desc' => 'required',
            'budgeted_amount' => 'required'
        ]);

        $user_id = Auth::user()->id;
        // insert the data into the database after validating
        Expense::insert([
            'user_id' => $user_id,
            'budget_id' => $request->budget_id,
            'category_id' => $request->category_id,
            'expense_desc' => $request->expense_desc,
            'budgeted_amount' => $request->budgeted_amount,
            'created_at' => Carbon::now()
        ]);
        
        return Redirect()->route('budget.expense')->with('success', 'New Budgeted Expenditure added successfully to selected budget');
    }

    function displayBudget($selected_budget_id){
        $categories = Category::where('cat_type', 'Cash Out')->get();

        $selected_budget = Budget::find($selected_budget_id);


        // join three tables and display selected data
        $expense_sources = Expense::withoutGlobalScopes()->join('Categories', 'expenses.category_id', '=', 'categories.id')
                                ->join('Budgets', 'expenses.budget_id', '=', 'budgets.id')->paginate(5)->withQueryString();
                                           
        return view('backend.budgets.add_expense', compact('expense_sources','categories', 'selected_budget'));
    }

    
}
