<?php

namespace App\Http\Controllers;

use App\Models\off;
use App\Models\intern;
use Illuminate\Http\Request;

class OffController extends Controller
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
        $intern = intern::all()->where('user_id', $request->user['id'])->first();

        if($intern) {
            try {
                $request->validate([
                    'user' => 'required',
                    'date' => 'required',
                ]);
    
        
                $off = off::create(['intern_id' => $intern->id, 'day' => $request->date]);
            } catch (\Throwable $th) {
                //throw $th;
                $off = $th;
            }
        }else{
            $off = response(['errors' => ['x' => 'user is not an intern yet.']], 500);
        }
        return $off;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\off  $off
     * @return \Illuminate\Http\Response
     */
    public function show(off $off)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\off  $off
     * @return \Illuminate\Http\Response
     */
    public function edit(off $off)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\off  $off
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, off $off)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\off  $off
     * @return \Illuminate\Http\Response
     */
    public function destroy(off $off)
    {
        //
    }
}
