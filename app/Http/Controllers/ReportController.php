<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labour;
use App\LabourType;
use App\Group;
use App\Building;
use App\Salary_log;
use App\Salary_Based_log;
use App\Salary_Based_Employee;
use Illuminate\Support\Facades\DB;
use App\User;

class ReportController extends Controller
{
	public function building(Request $request){

		$filters = [
			'l_id' => number_format($request->get('l_id')),
			'g_id' => number_format($request->get('g_id')),
			'b_id' => number_format($request->get('b_id')),
		];

		$type = LabourType::get();
		$group = Group::get();
		$building = Building::get();

		$labour = Labour::where(function ($query) use ($filters){
			if($filters['l_id']){
				$query->where('labour_type','=',$filters['l_id']);
			}

			if($filters['g_id']){
				$query->where('group_id','=',$filters['g_id']);
			}

			if($filters['b_id']){
				$query->where('building_id','=',$filters['b_id']);
			}
		})->get();

		return view('report.building',compact(['labour','type','group','building','filters']));
	}


	public function buildingCostReport(){

		$getAllBuildingsReport=DB::select(DB::raw("SELECT subQuery2.total_cost,subQuery2.rate, subQuery2.builId as id, subQuery2.buildName, subQuery2.total_hazira, subQuery2.total_salary,SUM(salary__based_logs.salary) as total_salary_cost
			FROM
			(
			SELECT subQuery.total_cost,subQuery.rate, subQuery.builId, subQuery.buildName, subQuery.total_hazira, SUM (salary__based__employees.salary) as total_salary
			FROM 
			(
			SELECT SUM(salary_logs.food_rate_paid) as total_cost, labours.attendance_rate as rate, buildings.id as builId,buildings.name as buildName, SUM (salary_logs.attendence_number) as total_hazira
			FROM salary_logs 
			LEFT JOIN buildings 
			ON buildings.id = salary_logs.building_id
			LEFT JOIN labours
			ON labours.id = salary_logs.labour_id

			GROUP BY buildings.id,labours.attendance_rate 
			) subQuery
			LEFT JOIN salary__based__employees
			ON salary__based__employees.building_id = subQuery.builId


			GROUP BY salary__based__employees.building_id,subQuery.total_cost,subQuery.rate, subQuery.builId, subQuery.buildName, subQuery.total_hazira
			) subQuery2
			LEFT JOIN salary__based_logs
			ON salary__based_logs.building_id = subQuery2.builId
			GROUP BY subQuery2.total_salary,subQuery2.total_cost,subQuery2.rate, subQuery2.builId, subQuery2.buildName, subQuery2.total_hazira,salary__based_logs.building_id "));

		return view('report.buildingCost',compact(['getAllBuildingsReport']));

	}

	public function groupCostReport(){
    	// $labour = Labour::get()->groupBy('group_id');
		/*$group = Group::get();

		$log = Salary_log::groupBy('group_id')
		->selectRaw('sum(food_rate_will_get) as total_food, sum(food_rate_paid) as total_paid, group_id')
		->orderBy('group_id', 'asc')
		->get();

		$total_array = [];

		foreach ($log as $key => $lg) {
			$total_cost = 0;
			$bld = Salary_log::where('group_id',$lg->group_id)->get();
			foreach ($bld as $k => $val) {
				$data = Labour::find($val->labour_id);
				$total_cost = $total_cost + $data->attendance_rate * $val->attendence_number;

			}
			$total_array[$lg->group_id] = $total_cost;


		}*/



		$group = DB::table('salary_logs')
			->selectRaw('SUM(salary_logs.attendence_number) as total, labours.attendance_rate as ar, salary_logs.group_id as gid')
    		->leftJoin('labours','salary_logs.labour_id','=','labours.id')
    		->groupBy('salary_logs.group_id','labours.attendance_rate')
            // ->join('labours', 'labours.id', '=', 'salary_logs.labour_id')
            // ->selectRaw('salary_logs.labour_id as id, sum(salary_logs.attendence_number) as total_attendence, sum(salary_logs.food_rate_will_get) as total_food_get, sum(salary_logs.attendence_number * labours.attendance_rate) as total_amount, sum(salary_logs.food_rate_paid) as total_paid, labours.name as name')
            // ->groupBy('labours.id','salary_logs.labour_id')
            // ->orderBy('labours.id', 'asc')
            ->get();

            dd($group);


		return view('report.groupCost',compact(['group','total_array','log']));
	}

	public function perbuildingcost($id){
		$labour = Labour::get();
		$building_cost = Salary_log::where('building_id',$id)->get();
		$sb_log = Salary_Based_log::where('building_id',$id)->get();
		$emp = Salary_Based_Employee::get();
		return view('report.perBuildingCost',compact(['building_cost','labour','sb_log','emp']));
	}

	public function pergroupcost($id){

		$labour = Labour::get();
		$group_cost = Salary_log::where('group_id',$id)->get();
		$building = Building::get();
		return view('report.perGroupCost',compact(['group_cost','labour','building']));


    }

    public function employeeBasedReport(Request $request){

    	$group = Group::get();

    	/*$data = DB::select('SELECT salary_logs.food_rate_date FROM salary_logs WHERE salary_logs.food_rate_date = "2020-04-07"'); dd($data);*/
    	$from= $request->input('from');
    	$to = $request->input('to');
    	$gp_trac = ($request->input('group'));

/*join salary_log table (where data is between from date to to data) with labour with labour table and make group with labour id*/

if($gp_trac){
	$employee_based_log = DB::table('salary_logs')
    		->where('salary_logs.group_id','=',$gp_trac)
    		->whereDate('salary_logs.food_rate_date','>=', ($request->input('from')?$request->input('from'):'1920-01-01'))
    		->whereDate('salary_logs.food_rate_date','<=', ($request->input('to')?$request->input('to'):'3020-01-01'))
            ->join('labours', 'labours.id', '=', 'salary_logs.labour_id')
            ->selectRaw('salary_logs.labour_id as id, sum(salary_logs.attendence_number) as total_attendence, sum(salary_logs.food_rate_will_get) as total_food_get, sum(salary_logs.attendence_number * labours.attendance_rate) as total_amount, sum(salary_logs.food_rate_paid) as total_paid, labours.name as name')
            ->groupBy('labours.id','salary_logs.labour_id')
            ->orderBy('labours.id', 'asc')
            ->get();
}

else{
	$employee_based_log = DB::table('salary_logs')
    		->whereDate('salary_logs.food_rate_date','>=', ($request->input('from')?$request->input('from'):'1920-01-01'))
    		->whereDate('salary_logs.food_rate_date','<=', ($request->input('to')?$request->input('to'):'3020-01-01'))
            ->join('labours', 'labours.id', '=', 'salary_logs.labour_id')
            ->selectRaw('salary_logs.labour_id as id, sum(salary_logs.attendence_number) as total_attendence, sum(salary_logs.food_rate_will_get) as total_food_get, sum(salary_logs.attendence_number * labours.attendance_rate) as total_amount, sum(salary_logs.food_rate_paid) as total_paid, labours.name as name')
            ->groupBy('labours.id','salary_logs.labour_id')
            ->orderBy('labours.id', 'asc')
            ->get();
}

    	

            /*dd($data);

    		$employee_based_log = DB::select('SELECT salary_logs.labour_id, SUM(salary_logs.attendence_number) as total_attendence, SUM(salary_logs.food_rate_will_get) as total_food_get, SUM(salary_logs.attendence_number * labours.attendance_rate) as total_amount,  SUM(salary_logs.food_rate_paid) as total_paid, labours.name as name FROM salary_logs LEFT JOIN labours 
			ON labours.id = salary_logs.labour_id
			GROUP BY salary_logs.labour_id, labours.id ORDER BY salary_logs.labour_id ASC'
			); */    

		return view('report.labourBasedReport',compact(['employee_based_log','from','to','group','gp_trac']));
    }


    public function downloadXL(Request $request) 
    {

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=pages.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

 

        $from= $request->input('from');
    	$to = $request->input('to');

/*join salary_log table (where data is between from date to to data) with labour with labour table and make group with labour id*/

    	$employee_based_log = DB::table('salary_logs')
    		->whereDate('salary_logs.food_rate_date','>=', ($request->input('from')?$request->input('from'):'1920-01-01'))
    		->whereDate('salary_logs.food_rate_date','<=', ($request->input('to')?$request->input('to'):'3020-01-01'))
            ->join('labours', 'labours.id', '=', 'salary_logs.labour_id')
            ->selectRaw('salary_logs.labour_id as id, sum(salary_logs.attendence_number) as total_attendence, sum(salary_logs.food_rate_will_get) as total_food_get, sum(salary_logs.attendence_number * labours.attendance_rate) as total_amount, sum(salary_logs.food_rate_paid) as total_paid, labours.name as name')
            ->groupBy('labours.id','salary_logs.labour_id')
            ->orderBy('labours.id', 'asc')
            ->get()->toArray();


            $arr = [];

        foreach ($employee_based_log as $key => $value) {
        	$a = array(
        		"id" => 'EP-'.$value->id,
        		"name" => $value->name,
        		"total_attendence" => $value->total_attendence,
        		"total_amount" => $value->total_amount,
        		"total_food_get" => $value->total_food_get,
        		"total_paid" => $value->total_paid,
        		"total_due" => $value->total_amount - $value->total_paid,
        		"due_food" => $value->total_food_get - $value->total_paid
        	);
        	array_push($arr, $a);
        }
 
		
        # add headers for each column in the CSV download
        array_unshift($arr, array_keys($arr[0]));

 

        $callback = function() use ($arr) 
        {
            $FH = fopen('php://output', 'w');
            fputcsv($FH, array("Labour ID","Name","Total হাজিরা সংখ্যা","Total Amount","Total Paid","Total খোরাকী পাবে","Due Salary","Due খোরাকী"));
            foreach ($arr as $key => $row) { 
                if($key>0){
                    fputcsv($FH, $row);
                }
                
            }

            fclose($FH);

        };

 

        return Response()->stream($callback, 200, $headers);
    }

}
