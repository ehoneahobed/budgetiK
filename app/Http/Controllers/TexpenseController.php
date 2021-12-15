<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Texpense;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;

class TexpenseController extends Controller
{
    //
    public function AddExpense(){
        $categories = Category::where('cat_type', 'Cash Out')->get();
        return view('backend.transactions.expenditure.add_expense', compact('categories'));
    }


    public function SaveExpense(Request $request){
        $validate = $request->validate([
            'category_id' => 'required',
            'expense_desc' => 'required',
            'actual_amount' => 'required',
            'date' => 'required'
        ]);

        $user_id = Auth::user()->id;
        // insert the data into the database after validating
        Texpense::insert([
            'user_id' => $user_id,
            'category_id' => $request->category_id,
            'expense_desc' => $request->expense_desc,
            'amount' => $request->actual_amount,
            'date' => $request->date,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'New Transactional Expenditure added successfully');
    }

    public function ViewExpense(){
        $expense_sources = TExpense::latest()->paginate(2);
        return view('backend.transactions.expenditure.view_expense', compact('expense_sources'));
    }

    public function ShowExpense(REQUEST $request){
        $validate = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        

        $expense_sources = Texpense::whereBetween('date',[$start_date, $end_date])->paginate(1)->withQueryString();
        
    
        //return $start_date;
        return view('backend.transactions.expenditure.view_expense', compact('expense_sources'));
    }
}
