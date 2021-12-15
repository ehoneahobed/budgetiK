<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Currency;
use Illuminate\Support\Carbon;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function setCurrency(REQUEST $request){
        // validate data sent from the form
        $validatedData = $request->validate([
            'currency_id' => 'required',
        ]);

        $selected_currency = $request->currency_id;

        // find current logged in user id
        $user_id = Auth::user()->id;
        $user = Auth::user();

        // check if the profile table already has data on this user, if it doesn't insert one but if it does then update it
        $profile_exists = Profile::find($user_id);
        if(!$profile_exists){
            // insert data
            $profile = new Profile;
            $profile->currency_id = $selected_currency;
            $user->profile()->save($profile);
            
            // redirect back to original page with success message
            return Redirect()->back()->with('success', 'You have set a new default currency');
        }
        else {
            // update data
            $profile_exists->currency_id = $selected_currency;
            $profile_exists->save();
            
            // redirect back to original page with success message
            return Redirect()->back()->with('success', 'You have set a new default currency');
        }
    }

}
