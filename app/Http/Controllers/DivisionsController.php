<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $divisions = Division::orderBy('priority', 'asc')->get();
        return view('admin.pages.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name'         =>    'required',
            'priority'        =>    'required',
        ],
            [
                'name.required' =>  'Please insert a Division name',
                'priority.required'   =>  'Please provide division priority',
            ]

        );

        $division = new Division;
        $division->name = $request->name;
        $division->priority = $request->priority;


        Session::flash('add_division', 'Division has been added successfully');
        $division->save();

        return redirect()->route('admin.divisions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $division = Division::findOrFail($id);
        return view('admin.pages.divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'name'         =>    'required',
            'priority'        =>    'required',
        ],
            [
                'name.required' =>  'Please insert a Division name',
                'priority.required'   =>  'Please provide division priority',
            ]

        );

        $division = Division::findOrFail($id);
        $division->name = $request->name;
        $division->priority = $request->priority;


        Session::flash('Update_division', 'Division has been Updated successfully');
        $division->save();

        return redirect()->route('admin.divisions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $division = Division::findOrFail($id);

        //delete all the districts for this division
        $districts = District::where('division_id', $division->id)->get();
            foreach ($districts as $district) {
                $district->delete();
            }
        $division->delete();

        Session::flash('deleted_division', 'Division has been deleted successfully');
        return back();
    }
}
