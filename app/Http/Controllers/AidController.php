<?php

namespace App\Http\Controllers;

use App\Aid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AidController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('aid.form', [ "type" => $request->query('type',1)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
            'category' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('aid/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->only('title','location','category','description','type','lat', 'lng');
        $aid = Aid::create($data);
        $aid->owner()->associate(auth()->user());
        $aid->save(); 
        return redirect('aid/'. $aid->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aid  $aid
     * @return \Illuminate\Http\Response
     */
    public function show(Aid $aid)
    {
        return view('aid.activity.show',[ 'aid' => $aid] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aid  $aid
     * @return \Illuminate\Http\Response
     */
    public function edit(Aid $aid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aid  $aid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aid $aid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aid  $aid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid)
    {
        //
    }
}
