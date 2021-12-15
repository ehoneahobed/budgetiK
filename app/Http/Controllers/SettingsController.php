<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Carbon;
use Auth;
use DB;

class SettingsController extends Controller
{
    //

    public function showCurrency(){
        //DB::enableQueryLog();
        $currencies = Currency::all()->sortBy("currency_name");
        //dd($currencies);
        //dd(\DB::getQueryLog());
        return view('backend.settings.currency', compact('currencies'));

    }

    public function setCurrency(REQUEST $request){
        $validatedData = $request->validate([
            'currency_id' => 'required',
        ]);

        $selected_currency = $request->currency_id;

        // first of all reset the previous active currency to inactive
        $reset_previous_currency = Currency::where('currency_status', 'ACTIVE')->first();
        if($reset_previous_currency){
            $reset_previous_currency->currency_status = "INACTIVE";
            $reset_previous_currency->save();
        }
         
        // update the status column to ACTIVE for the selected category
        $set_currency = Currency::find($selected_category);
        $set_currency->currency_status = "ACTIVE";
        $set_currency->save();

        // redirect back to original page with success message
        return Redirect()->back()->with('success', 'You have set a new default currency');
    }
}
