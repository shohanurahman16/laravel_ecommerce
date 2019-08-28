<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $districts = District::orderBy('name', 'asc')->get();
        return view('admin.pages.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $divisions = Division::orderBy('priority','asc')->get();
        return view('admin.pages.districts.create', compact('divisions') );

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
            'division_id'        =>    'required',
        ],
            [
                'name.required' =>  'Please insert a District name',
                'division_id.required'   =>  'Please provide District of this district',
            ]

        );

        $district = new District;
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        Session::flash('add_division', 'District has been added successfully');
        $district->save();

        return redirect()->route('admin.districts.index');
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
        $divisions = Division::orderBy('priority','asc')->get();
        $district = District::findOrFail($id);
        return view('admin.pages.districts.edit', compact('district','divisions'));
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
            'division_id'        =>    'required',
        ],
            [
                'name.required' =>  'Please insert a District name',
                'division_id.required'   =>  'Please provide district of this district',
            ]

        );

        $district = District::findOrFail($id);
        $district->name = $request->name;
        $district->division_id = $request->division_id;


        Session::flash('update_district', 'District has been Updated successfully');
        $district->save();

        return redirect()->route('admin.districts.index');
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
        $district = District::findOrFail($id);
        $district->delete();
        Session::flash('deleted_district', 'District has been deleted successfully');
        return back();
    }
}
