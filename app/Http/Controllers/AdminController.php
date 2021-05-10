<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Admin::get();
        return view('welcome',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'joining' => 'required|date|before:today',
            'leaving' => 'required|date|after:joining',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif'
        ]);
  
       
    
        $start_date = Carbon::parse($request->joining);
        $end_date = Carbon::parse($request->leaving);

        $yrs = 0;
        $month = $end_date->diffInMonths($start_date);
        $yrs = intval($month/12);
        $month = $month-$yrs*12;

        if($month>12){
            $yrs+= 1;
            $month-=12;
        }
       
        $user = New Admin;
        $user->name = ucwords($request->name);
        $user->email = $request->email;
        $user->experience = $yrs==0 ? $month .' Months' : $yrs .' Years '. $month .' Months ';
        if($request->hasFile('avatar')){
            $user->image = asset('storage/'.$request->avatar->store('user'));

        }else{
            $user->image = null;
        }
        if($request->has('checkbox')){
            $user->working = "yes";
        }else{
            $user->working = "no";
        }
        $user->save();
        
        return redirect()->route('index')
                        ->with('success',' created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $data = Admin::find($id);
        $data->delete();
        return redirect()->route('index')
                        ->with('success','User deleted successfully');
    }
}
