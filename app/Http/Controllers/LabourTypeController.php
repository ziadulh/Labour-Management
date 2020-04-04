<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\labourType;

class LabourTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LabourType::get();
        return view('labourType.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labourType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required | unique:labour_types']);

        $data = array(
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        );

        labourType::create($data);

        return redirect(route('labourType.index'))->with('success', 'Labour type has been created successfully!');
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
        $data = labourType::find($id);
        return view('labourType.edit',compact('data'));
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
        $request->validate(['name' => 'required']);

        labourType::where('id', $id)
          ->update([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'updated_by' => auth()->user()->id,
          ]);

          return redirect(route('labourType.edit',$id))->with('success', 'Your Labour type information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (labourType::find($id))->delete();
        return redirect(route('labourType.index',$id))->with('success', 'Labour type has been deleted successfully!');
    }
}
