<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewUserLeads;

class NewUserLeadsController extends Controller
{

    public function save_email(Request $request)
    {

        if(!$request->first_name || !$request->last_name || !$request->email)
        {
            return response()->json([
                'status'=>false,
                'message'=>'First name, last name and email required'
            ]);
        }

        $exists = NewUserLeads::where('email',$request->email)->first();

        if($exists)
        {
            return response()->json([
                'status'=>false,
                'message'=>'Email already saved'
            ]);
        }

        NewUserLeads::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'User details saved successfully'
        ]);

    }


    public function get_user_leads(Request $request)
    {
        $leads = NewUserLeads::select(
            'first_name',
            'last_name',
            'email',
            'created_at'
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10); // <-- IMPORTANT

        return response()->json($leads);
    }

}