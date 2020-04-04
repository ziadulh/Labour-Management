<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Group;
use App\Salary_log;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Building::get();
        $gp = Group::get();
        return view('building.index',compact(['data','gp']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group_data = Group::get();
        return view('building.create',compact('group_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required | unique:buildings', 'group_id' => 'required']);

        $data = array(
            'name' => $request->input('name'),
            'group_id' => $request->input('group_id'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        );

        Building::create($data);

        return redirect(route('building.index'))->with('success', 'Building has been created successfully!');
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
        $log_table_testing = Salary_log::where('building_id',$id)->first();
        if($log_table_testing){
            echo "you can not make any changes because already make transection with this building!";
        }else{
            $group = Group::get();
            $building = Building::find($id);
            return view('building.edit',compact(['building','group']));
        }
        
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

        Building::where('id', $id)
          ->update([
            'name' => $request->input('name'),
            'group_id' => $request->input('group_id'),
            'status' => $request->input('status'),
            'updated_by' => auth()->user()->id,
          ]);

          return redirect(route('building.edit',$id))->with('success', 'Your Building information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (Building::find($id))->delete();
        return redirect(route('building.index'))->with('success', 'Group has been deleted successfully!');
    }
}
