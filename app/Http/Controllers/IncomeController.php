<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;

class IncomeController extends Controller
{
    //

    public function chooseBudget(){
        $budgets = Budget::all();
        return view('backend.budgets.income', compact('budgets'));
    }

    public function newBudgetIncome(Request $request){
        // $validate = $request->validate([
        //     'budget_id' => 'required',
        // ]);
        
        $selected_budget_id = $request->budget_id;

        //$selected_budget = Budget::find($selected_budget_id);

        return $this->displayBudget($selected_budget_id);
        
    }

    public function SaveBudgetIncome(REQUEST $request){
        $validate = $request->validate([
            'budget_id' =>'required',
            'category_id' => 'required',
            'income_desc' => 'required',
            'budgeted_amount' => 'required'
        ]);

        $user_id = Auth::user()->id;
        // insert the data into the database after validating
        Income::insert([
            'user_id' => $user_id,
            'budget_id' => $request->budget_id,
            'category_id' => $request->category_id,
            'income_desc' => $request->income_desc,
            'budgeted_amount' => $request->budgeted_amount,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('budget.income')->with('success', 'New Budgeted Income added successfully to selected budget');
    }

    // public function BudgetData($data){
    //     $selected_budget_id = $request->budget_id;
    //     $selected_budget = Budget::find($selected_budget_id);

    //     $categories = Category::where('cat_type', 'Cash In')->get();

    //     $income_sources = Income::where('budget_id', $selected_budget_id)->whereNotNull('budgeted_amount')->latest()->paginate(5);
    //     // return to the previous page with a success message after adding the new category
    //     //return Redirect()->view('backend.budgets.add_income', compact('selected_budget') )->with('success', 'New Budgeted Income added successfully to selected budget');
    //     return view('backend.budgets.add_income', compact('selected_budget', 'categories', 'income_sources') )->with('success', 'New Budgeted Income added successfully to selected budget');
    
    // }

    function displayBudget($selected_budget_id){
        $categories = Category::where('cat_type', 'Cash In')->get();
        
        $selected_budget = Budget::find($selected_budget_id);
        
        // join three tables and display selected data
        $income_sources = Income::withoutGlobalScopes()->join('Categories', 'incomes.category_id', '=', 'categories.id')
                                ->join('Budgets', 'incomes.budget_id', '=', 'budgets.id')->paginate(5)->withQueryString();
                                // ->get(['incomes.*', 'categories.category', 'budgets.budget_name', 'incomes.budget_id' ]);
        
        return view('backend.budgets.add_income', compact('income_sources','categories', 'selected_budget'));
    }
}
