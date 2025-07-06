<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTest=Test::all();
        return $allTest;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $fildes=$request->validate(

     [
                'title'=>'required|max:255',
                'body'=>'required',
            ]
        );
        $test=Test::create($fildes);
        return ['test' =>$test];

    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return $test;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $fildes=$request->validate(

            [
                       'title'=>'required|max:255',
                       'body'=>'required',
                   ]
        );
        $test->update($fildes);
        return ['test' =>$test];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return 'the row has been deleted';
    }
}
