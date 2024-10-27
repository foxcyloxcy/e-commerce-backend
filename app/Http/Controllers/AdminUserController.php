<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
     /**
     * Get list of user
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        $size = $request->size ?: 10;
        try {
            $data = User::when(!empty($request->filter['keyword']), function ($q) use ($request) {
                $q->where('first_name','LIKE','%'.$request->filter['keyword'].'%')
                ->orWhere('first_name', 'LIKE','%'.$request->filter['keyword'].'%')
                ->orWhere('email', 'LIKE','%'.$request->filter['keyword'].'%')
                ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%".$request->filter['keyword']."%");          
            })
            ->orderBy('id', 'desc')->paginate($size);

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
