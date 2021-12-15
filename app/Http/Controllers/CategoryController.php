<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;

class CategoryController extends Controller
{
    //
    public function ShowCategories(){
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }


    public function AddCategory(Request $request){
        $validatedData = $request->validate([
            'category' => 'required|unique:categories|max:100|min:4',
            'cat_type' => 'required|max:55',
        ],

        [
            'category.required' => 'Please Input a Category Name first',
        ]);

        $user_id = Auth::user()->id;
        // Inserting data into the database using the Eloquent ORM style 1
            Category::insert([
                'user_id' => $user_id,
                'category' => $request->category,
                'cat_type' => $request->cat_type,
                'cat_description' => $request->cat_description,
                'created_at' => Carbon::now()
            ]);

        // return to the previous page with a success message after adding the new category
            return Redirect()->back()->with('success', 'New Category added successfully');
    
    }

    public function DisplayCategories(){
        $cashin_cats = Category::where('cat_type', 'Cash In')->get();
        $cashout_cats = Category::where('cat_type', 'Cash Out')->get();
        return view('backend.category.display', compact('cashin_cats', 'cashout_cats'));
    }


    public function editCategory($id){
        $categories = Category::where('id', $id)->get();
        return view('backend.category.edit', compact('categories'));
    }

    public function updateCategory(REQUEST $request, $id){
        // validate the data submitted from the create budget form        
        $validatedData = $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'category_type' => 'required',
        ]);

        $update = Category::find($id)->update([
            'category' => $request->category_name,
            'cat_description' => $request->category_description,
            'cat_type' => $request->category_type,
        ]);

        // return to the previous page with a success message 
        return Redirect()->back()->with('success', 'Category Successfully updated');

    }

    public function deleteCategory($id){
        $update = Category::find($id)->delete();

        // return to the previous page with a success message 
        return Redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
