<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Carbon;
use Auth;

class BudgetController extends Controller
{
    //
    public function displayBudget(){
        $budgets = Budget::all();
        return view('backend.budgets.index', compact('budgets'));
    }


    public function createBudget(REQUEST $request){
        // validate the data submitted from the create budget form        
        $validatedData = $request->validate([
            'budget_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $user_id = Auth::user()->id;
        // insert the data into the database after validating
        Budget::insert([
            'user_id' => $user_id,
            'budget_name' => $request->budget_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_at' => Carbon::now()
        ]);

        // return to the previous page with a success message after adding the new category
        return Redirect()->back()->with('success', 'New Budget created successfully');
    
    }

    public function editBudget($id){
        $budgets = Budget::find($id)->get();
        return view('backend.budgets.edit', compact('budgets'));
    }

    public function updateBudget(REQUEST $request, $id){
        // validate the data submitted from the create budget form        
        $validatedData = $request->validate([
            'budget_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $update = Budget::find($id)->update([
            'budget_name' => $request->budget_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // return to the previous page with a success message 
        return Redirect()->back()->with('success', 'Budget Successfully updated');



    }
}
