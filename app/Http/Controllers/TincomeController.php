<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tincome;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;

class TincomeController extends Controller
{
    //
    public function AddIncome(){
        $categories = Category::where('cat_type', 'Cash Out')->get();
      
        return view('backend.transactions.income.add_income', compact('categories'));
    }


    public function SaveIncome(Request $request){
        $validate = $request->validate([
            'category_id' => 'required',
            'income_desc' => 'required',
            'actual_amount' => 'required',
            'date' => 'required'
        ]);

        $user_id = Auth::user()->id;
        // insert the data into the database after validating
        Tincome::insert([
            'user_id' => $user_id,
            'category_id' => $request->category_id,
            'income_desc' => $request->income_desc,
            'amount' => $request->actual_amount,
            'date' => $request->date,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'New Transactional Income added successfully');
    }

    public function ViewIncome(){
        $income_sources = Tincome::latest()->paginate(2);
        return view('backend.transactions.income.view_income', compact('income_sources'));
    }

    public function ShowIncome(REQUEST $request){
        $validate = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        
        //return $this->displayIncome($start_date, $end_date);

        $income_sources = Tincome::whereBetween('date',[$start_date, $end_date])->paginate(1)->withQueryString();
        
    
        //return $start_date;
        return view('backend.transactions.income.view_income', compact('income_sources'));
    }

    // public function displayIncome($start_date, $end_date){
    //     $income_sources = Tincome::whereBetween('date',[$start_date, $end_date])->paginate(1);
    //     //return $start_date;
    //     return view('backend.transactions.income.view_income', compact('income_sources'));
    // }


    public function editTincome($id){
        $income_source = Tincome::find($id)->first();

        $income_sources = Tincome::find($id)->get();
        $categories = Category::where('id', $income_source->category_id)->get();
        return view('backend.transactions.income.edit', compact('income_sources', 'categories'));
    }

    public function updateTincome(REQUEST $request, $id){
        // validate the data submitted from the edit income form        
        $validatedData = $request->validate([
          
            'income_desc' => 'required',
            'actual_amount' => 'required',
            'date' => 'required',
        ]);


        
        $update = Tincome::find($id)->update([
            'category' => $request->category,
            'income_desc' => $request->income_desc,
            'actual_amount' => $request->actual_amount,
            'date' => $request->date,
        ]);

        // return to the previous page with a success message 
        return Redirect()->back()->with('success', 'Income Successfully updated');
    }

    public function deleteTincome($id){
        $delete = Tincome::find($id)->delete();

        // return to the previous page with a success message 
        return Redirect()->back()->with('success', 'Income Deleted Successfully');
    }
}
