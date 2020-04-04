<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Building;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Group::get();
        return view('group.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required | unique:groups']);

        $data = array(
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        );

        Group::create($data);

        return redirect(route('group.index'))->with('success', 'Group has been created successfully!');
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
        $data = Group::find($id);
        return view('group.edit',compact('data'));
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
        $request->validate(['name' => 'required ']);

        Group::where('id', $id)
          ->update([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'updated_by' => auth()->user()->id,
          ]);

          return redirect(route('group.edit',$id))->with('success', 'Your group information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $building = Building::where('group_id',$id)->get();
        foreach ($building as $building) {
            (Building::find($building->id))->delete();
        }

        (Group::find($id))->delete();
        return redirect(route('group.index',$id))->with('success', 'Group has been deleted successfully!');

    }
}
