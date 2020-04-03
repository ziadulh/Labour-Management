<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Salary_Based_Employee;
use App\Salary_Based_log;

class SalaryBasedEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sb_employee = Salary_Based_Employee::get();
        return view('salaryBasedEmployee.index',compact(['sb_employee']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $building = Building::get();
        return view('salaryBasedEmployee.create',compact(['building']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $bui = Building::find($request->input('building_id'));
        
        $request->validate([
            'name' => 'required', 'salary' => 'required',
        ]);

        $data = array(
            'name' => $request->input('name'),
            'group_id' => $bui->group_id,
            'building_id' => $request->input('building_id'),
            'salary' => $request->input('salary'),
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        );

        Salary_Based_Employee::create($data);

        return redirect(route('salarybasedemployee.index'))->with('success', 'Salary based Employee has been created successfully!');
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
        $sb_employee = Salary_Based_Employee::find($id);
        $building = Building::get();
        return view('salaryBasedEmployee.edit',compact(['building','sb_employee']));
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
        $request->validate(['name' => 'required', 'salary' => 'required']);

         Salary_Based_Employee::where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'salary' => $request->input('salary'),
            'building_id' => $request->input('building_id'),

            'status' => $request->input('status'),
            'updated_by' => auth()->user()->id,
        ]);

        return redirect(route('salarybasedemployee.index'))->with('success', 'Salary based employee information has been created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (Salary_Based_Employee::find($id))->delete();
        return redirect(route('salarybasedemployee.index',$id))->with('success', 'Employee Information has been deleted successfully!');
    }


    public function addSalary($id)
    {
        $building = Building::get();
        return view('salaryBasedEmployee.addSalary',compact(['building','id']));
    }

    public function addSalaryStore(Request $request,$id)
    {

        $request->validate([
            'salary' => 'required', 'month' => 'required',
        ]);

        $sl_emp = Salary_Based_Employee::find($id);

        $data = array(
            'salary' => $request->input('salary'),
            'month' => $request->input('month'),
            'building_id' => $sl_emp->building_id,
            'group_id' => $sl_emp->group_id,
            'employee_id' => $id,
            
        );

        Salary_Based_log::create($data);

        return redirect(route('salarybasedemployee.index'))->with('success', 'Salary has been created successfully!');
    }

}
