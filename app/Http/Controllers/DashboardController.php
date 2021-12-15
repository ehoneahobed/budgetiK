<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Texpense;
use App\Models\Tincome;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class DashboardController extends Controller
{
    //
    public function displayDashboard(){
        $budgets = Budget::all();
        $currentmonth = Carbon::NOW()->month;
        
        $data['budgets'] = $budgets;
        $data['this_month_incomes'] = Tincome::whereMonth('date', $currentmonth)->get();
        $data['this_month_expense'] = Texpense::whereMonth('date', $currentmonth)->get();
        
        // select id of the most recent budget created
        $most_recent_budget = Budget::latest('created_at')->first();

        // name of selected budget
        if (!$most_recent_budget){
            $data['user_details'] = Auth::user();
            return view('welcome', $data);
        }
        
        $id_of_recent_budget = $most_recent_budget->id;
        
        $start_date = $most_recent_budget->start_date;

        $end_date = $most_recent_budget->end_date;

        // select expenses where budget id = the selected budget id above
        $data['selected_expenses'] = Expense::where('budget_id', $id_of_recent_budget)->get();
    

        // select Texpenses where expenses date is between the selected budget start and end date
        $data['selected_exp_actual'] = Texpense::whereBetween('date', [$start_date, $end_date])->get();

        // get all the information respect to how much was spent on each category and display it as a chart
        $selected_exp_actual = Texpense::whereBetween('date', [$start_date, $end_date])->get();
        foreach($selected_exp_actual as $selected_exp_actual ){

            $exp_category_id = $selected_exp_actual->id;
            //$exp_category[] = Category::find($exp_category_id)->where('cat_type','Cash Out'); // didn't work
           // $exp_category[] = Category::where('cat_type', 'Cash Out')->find($exp_category_id);
        }

        $start_date = $most_recent_budget->start_date;

        $end_date = $most_recent_budget->end_date;

        // combining details from tincome table, budgets table and categories table (the results of this query will be used for the charts on the dashboard)
        $data['exp_details'] = Texpense::withoutGlobalScopes()->join('Categories', 'texpenses.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    
                                    $join->whereBetween('date', ['2021-06-01', '2021-07-31']);
                                })->get();
        
        // combining details from tincome table, budgets table and categories table (the results of this query will be used for the charts on the dashboard)
        $data['inc_details'] = Tincome::withoutGlobalScopes()->join('Categories', 'tincomes.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->get();
   
                  //return $inc_details;
        
        // select Texpenses where expenses date is between the selected budget start and end date
        $data['selected_inc_actual'] = Tincome::whereBetween('date', [$start_date, $end_date])->get();

        // select Income where income created date is between the selected budget start and end date
        $data['selected_inc_projected'] = Income::whereBetween('created_at', [$start_date, $end_date])->get();
       
        // select Expense where expense created date is between the selected budget start and end date
        $data['selected_exp_projected'] = Expense::whereBetween('created_at', [$start_date, $end_date])->get();




        // trying out new set of code for visualising data on charts

    // 1. Chart of all incomes expressed in order of categories    
        // get all the categories that had transactional income recorded under them
        $list_of_tincome_categories = Tincome::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_income"))
                                ->join('Categories', 'tincomes.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('categories.category');
                                //return $list_of_tincome_categories;

        // get all the total income per category
        $amount_tincome_per_category = Tincome::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_income_per_category"))
                                ->join('Categories', 'tincomes.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('total_income_per_category');
                                
                                //return $amount_tincome_per_category;
        // $chartData = [];
        // foreach ($list_of_tincome_categories as $key => $category) {
        //     $chartData[$category] = $amount_tincome_per_category[$key];
        // }

        //print_r($chartData);          // this is working
        $data['list_of_inc_categories'] = $list_of_tincome_categories;
        $data['amount_per_inc_category'] = $amount_tincome_per_category;
        //$data['chartData'] = $chartData;
        

        // 2. Chart of all expenses expressed in order of categories    
        // get all the categories that had transactional income recorded under them
        $list_of_texpense_categories = Texpense::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_expense"))
                                ->join('Categories', 'texpenses.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('categories.category');
                                //return $list_of_texpense_categories;

        // get all the total income per category
        $amount_texpense_per_category = Texpense::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_expense_per_category"))
                                ->join('Categories', 'texpenses.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('total_expense_per_category');
                                
                                //return $amount_texpense_per_category;
        
        $data['list_of_exp_categories'] = $list_of_texpense_categories;
        $data['amount_per_exp_category'] = $amount_texpense_per_category;

        //return $currentdate;
        //return view('dashboard', compact('budgets'));

                            
        return view('dashboard', $data);
    }

    public function ShowDashboard(REQUEST $request){        
        // validate the incoming data
        $validate = $request->validate([
            'budget_id' => 'required'
        ]);
        
        // grab the selected budget id and assign it to a variable
        $budget_id = $request->budget_id;

        // select the budget with the selected id
        $selected_budget = Budget::find($budget_id)->first();

        // name of selected budget
        $data['name_of_selected_budget'] = $selected_budget->budget_name;

        $start_date = $selected_budget->start_date;

        $end_date = $selected_budget->end_date;

        // for the purpose of other parameters on the dashboard including the list of budgets etc
        $budgets = Budget::all();
        $currentmonth = Carbon::NOW()->month;
        $data['budgets'] = $budgets;
        $data['this_month_incomes'] = Tincome::whereMonth('date', $currentmonth)->get();
        $data['this_month_expense'] = Texpense::whereMonth('date', $currentmonth)->get();

         // select expenses where budget id = the selected budget id above
         $data['selected_expenses'] = Expense::where('budget_id', $budget_id)->get();
    

         // select Texpenses where expenses date is between the selected budget start and end date
         $data['selected_exp_actual'] = Texpense::whereBetween('date', [$start_date, $end_date])->get();
 
         // get all the information with respect to how much was spent on each category and display it as a chart
         $selected_exp_actual = Texpense::whereBetween('date', [$start_date, $end_date])->get();
         foreach($selected_exp_actual as $selected_exp_actual ){
 
             $exp_category_id = $selected_exp_actual->id;
           
         }

        // select Texpenses where expenses date is between the selected budget start and end date
        $data['selected_inc_actual'] = Tincome::whereBetween('date', [$start_date, $end_date])->get();

        // select Income where income created date is between the selected budget start and end date
        $data['selected_inc_projected'] = Income::whereBetween('created_at', [$start_date, $end_date])->get();
       
        // select Expense where expense created date is between the selected budget start and end date
        $data['selected_exp_projected'] = Expense::whereBetween('created_at', [$start_date, $end_date])->get();


         // 1. Chart of all incomes expressed in order of categories    
        // get all the categories that had transactional income recorded under them
        $list_of_tincome_categories = Tincome::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_income"))
                                ->join('Categories', 'tincomes.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('categories.category');
                                //return $list_of_tincome_categories;

        // get all the total income per category
        $amount_tincome_per_category = Tincome::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_income_per_category"))
                                ->join('Categories', 'tincomes.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('total_income_per_category');
                                
                                //return $amount_tincome_per_category;
        // $chartData = [];
        // foreach ($list_of_tincome_categories as $key => $category) {
        //     $chartData[$category] = $amount_tincome_per_category[$key];
        // }

        //print_r($chartData);          // this is working
        $data['list_of_inc_categories'] = $list_of_tincome_categories;
        $data['amount_per_inc_category'] = $amount_tincome_per_category;
        //$data['chartData'] = $chartData;
        

        // 2. Chart of all expenses expressed in order of categories    
        // get all the categories that had transactional income recorded under them
        $list_of_texpense_categories = Texpense::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_expense"))
                                ->join('Categories', 'texpenses.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('categories.category');
                                //return $list_of_texpense_categories;

        // get all the total income per category
        $amount_texpense_per_category = Texpense::withoutGlobalScopes()->select(DB::raw("categories.category, sum(`amount`) as total_expense_per_category"))
                                ->join('Categories', 'texpenses.category_id', '=', 'categories.id')
                                ->join('Budgets', function($join){
                                    $most_recent_budget = Budget::latest('created_at')->first();
                                    $start_date = $most_recent_budget->start_date;
                                    $end_date = $most_recent_budget->end_date;

                                    $join->whereBetween('date', [$start_date, $end_date]);
                                })->groupBy('categories.category')->pluck('total_expense_per_category');
                                
                                //return $amount_texpense_per_category;
        
        $data['list_of_exp_categories'] = $list_of_texpense_categories;
        $data['amount_per_exp_category'] = $amount_texpense_per_category;

        //$currentdate = Carbon::NOW();
        //return $currentdate;
        // $budget_id = $request->budget_id;
        // $data['budgetDetails'] = Budget::find($budget_id);
        // $data['this_month_incomes'] = Tincome::whereMonth('date', $currentdate);

        return view('dashboard', $data);
    }
}
