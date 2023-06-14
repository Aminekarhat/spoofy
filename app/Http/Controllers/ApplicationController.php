<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\User;
use App\Models\intern;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
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
    public function judge(Request $request)
    {
        $res = false;
        try {
            $res = $request;

            if($request->verdict == "yes") {
                intern::create(['user_id' => $request->app['user_id'], 'hr_id' => $request->app['hr_id']]);
                application::find($request->app['id'])->delete();
                $res = 'ok';

            }else{
                application::find($request->app['id'])->delete();
                $res = 'ok2';
            }   

            
        } catch (\Throwable $th) {
            $res = $th;
        }
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rh' => 'required',
            'user' => 'required',
            'message' => 'required',
        ]);

        $application = application::create(['user_id' => $request->user['id'], 'hr_id' => $request->rh['id'], 'message' => $request->message]);

        return $application;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(application $application)
    {
        //
    }
}
