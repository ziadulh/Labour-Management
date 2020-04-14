<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LabourType;
use App\Labour;
use App\Group;
use App\Building;
use App\Salary_log;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labour = Labour::get();
        $labourType = LabourType::get();
        $group = Group::get();
        $building = Building::get();
        return view('labour.index',compact(['labour','labourType','group','building']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labourType = LabourType::get();
        $group = Group::get();
        $building = Building::get();
        return view('labour.create',compact(['labourType','group','building']));
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
            'name' => 'required | unique:labours', 'joining_date' => 'required', 'attendance_rate' => 'required | integer',
        ]);

        $data = array(
            'name' => $request->input('name'),
            'joining_date' => $request->input('joining_date'),
            'labour_type' => $request->input('labour_type'),
            'group_id' => $request->input('group_id'),
            'building_id' => $request->input('building_id'),
            'attendance_rate' => $request->input('attendance_rate'),
            // 'food_rate' => $request->input('food_rate'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        );

        labour::create($data);

        return redirect(route('labour.index'))->with('success', 'Labour information has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $labour = Labour::find($id);
        return view('labour.show',compact('labour'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $labour = labour::find($id);
        $labour_type = LabourType::get();
        $group = Group::get();
        $building = Building::get();
        return view('labour.edit',compact(['labour','labour_type','group','building']));
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


        $request->validate([
            'name' => 'required ', 'joining_date' => 'required', 'attendance_rate' => 'required | integer', 'total_attendance' => 'required | numeric', 'total_salary' => 'required | integer', 'total_paid' => 'required | integer', 'total_due' => 'required | integer',
        ]);

        labour::where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'joining_date' => $request->input('joining_date'),
            'labour_type' => $request->input('labour_type'),
            // 'group_id' => $request->input('group_id'),
            'building_id' => $request->input('building_id'),
            'attendance_rate' => $request->input('attendance_rate'),
            // 'food_rate' => $request->input('food_rate'),

            'total_food_rate' => $request->input('total_food_rate'),
            /*'due_foodrate' => $request->input('due_foodrate'),*/

            'total_attendance' => $request->input('total_attendance'),
            'total_salary' => $request->input('total_salary'),
            'total_paid' => $request->input('total_paid'),
            'total_due' => $request->input('total_due'),
            // 'total_food_rate' => $request->input('food_rate'),

            'status' => $request->input('status'),
            'updated_by' => auth()->user()->id,
        ]);

        $data = Labour::find($id);


        labour::where('id', $id)
        ->update([

            'total_salary' => ($data->total_attendance * $data->attendance_rate),
            'total_due' => ($data->total_attendance * $data->attendance_rate) - $data->total_paid,

        ]);

        return redirect(route('labour.edit',$id))->with('success', 'Your Labour type information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (labour::find($id))->delete();
        return redirect(route('labour.index',$id))->with('success', 'Labour Information has been deleted successfully!');
    }

    public function addAttendence($id)
    {

        $lbr = Labour::find($id);

        $building = Building::where('group_id',$lbr->group_id)->get();
        /*$group = Group::get();*/
        return view('labour.addAttendence',compact('id','building'));
    }

    public function addAttendenceStore(Request $request, $id)
    {

        $request->validate([
            'attendence' => 'required', 'food_rate_date' => 'required | integer', 'food_rate_will_get ' => 'required | integer'
        ]);

        $data = Labour::find($id);
        
        labour::where('id', $id)
        ->update([
            'total_attendance' => $data->total_attendance + $request->input('attendence'),
        ]);

        $data2 = Labour::find($id);

        if(($request->input('food_rate')) || (($request->input('food_rate') == 0))){

            labour::where('id', $id)
            ->update([
                'total_salary' => $data2->total_attendance * $data2->attendance_rate,
                'total_food_rate' => $data2->total_food_rate + $request->input('food_rate_will_get'),
                'total_paid' => $request->input('food_rate') + $data2->total_paid,
                'total_due' => ($data2->total_attendance * $data2->attendance_rate) - ($request->input('food_rate') + $data2->total_paid),
            ]);

        }else {

            labour::where('id', $id)
            ->update([
                'total_salary' => $data2->total_attendance * $data2->attendance_rate,
                'total_food_rate' => $data2->total_food_rate + 0,
                'total_paid' => ($data2->food_rate)*$request->input('attendence') + $data2->total_paid,
                'total_due' => ($data2->total_attendance * $data2->attendance_rate) - (($data2->food_rate)*$request->input('attendence') + $data2->total_paid),
            ]);

        }


        $log_data = array(
            'food_rate_date' => $request->input('food_rate_date'),
            'attendence_number' => $request->input('attendence'),
            'food_rate_will_get' => $request->input('food_rate_will_get'),
            'food_rate_paid' => ($request->input('food_rate')?$request->input('food_rate'):0),
            'group_id' => $data->group_id,
            'building_id' => $request->input('building_id'),
            'labour_id' => $id,

        );

        Salary_log::create($log_data);

        return redirect(route('labour.index',$id))->with('success', 'Your Labour type information has been updated successfully!');
    }

    //Employee Bill payment Function 
    /*public function billPaymentView($id){

        $amounts = Labour::select('total_salary', 'total_food_rate')
        ->where('id',$id)
        ->first();

        $dueBill = $amounts->total_salary - $amounts->total_food_rate;

        return view('labour.billPay',compact('id','dueBill'));
    }

    public function billPaymentStore (Request $request, $id){
        $request->validate([
            'billPaymentAmount' => 'required | integer',
        ]);
        dd($request->billPaymentAmount);
        exit();
        return redirect(route('labour.index',$id))->with('success', 'Bill Payment has been updated successfully!');
    } */

















    public function findBuilding(Request $request)
        {
            $id = $request->get('id');
            $bls = Building::where('group_id',$id)->pluck('name','id');
            return response()->json($bls);
        }
        

}
