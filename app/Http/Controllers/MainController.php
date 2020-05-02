<?php

namespace App\Http\Controllers;

use App\Aid;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        return view('aid.index');
    }

    public function activities(Request $request) {
        $data = Aid::orderBy('created_at', 'desc')->get();

        return view('aid.activity.list', 
            [
                'aids' => $data,
                'request' => $request
             ]);
    }

    public function activitiesByRadius(Request $request) {
        // radius query 

        $data = Aid::orderBy('created_at', 'desc')->get();

        return response()->json($data->toJson());
    }
}
