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
		$group = Group::get();

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


		}


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

    public function costSelected(){
        $log = Salary_log::groupBy('building_id')
               ->selectRaw('sum(food_rate_will_get) as total_food, sum(food_rate_paid) as total_paid, building_id')
               ->orderBy('building_id', 'asc')
               ->get();

               

        $total_array = [];

        foreach ($log as $key => $lg) {
            $total_cost = 0;

            $bld = Salary_log::where('building_id',$lg->building_id)->get();
            foreach ($bld as $k => $val) {
                $data = Labour::find($val->labour_id);
                $total_cost = $total_cost + $data->attendance_rate * $val->attendence_number;
                
            }
            $total_array[$lg->building_id] = $total_cost;
            
        }

        dd($total_array);
    }

}
