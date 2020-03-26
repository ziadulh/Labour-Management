<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labour;
use App\LabourType;
use App\Group;
use App\Building;

class ReportController extends Controller
{
    public function building(Request $request){

    	$filters = [
    		'l_id' => number_format($request->get('l_id')),
    		'g_id' => number_format($request->get('g_id')),
    		'b_id' => number_format($request->get('b_id')),
    	];


// dd($filters);


    	
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

    	$labour = Labour::get()->groupBy('building_id');
    	$building = Building::get();
    	return view('report.buildingCost',compact(['labour','building']));
    }

    public function groupCostReport(){
    	$labour = Labour::get()->groupBy('group_id');
    	$group = Group::get();
    	return view('report.groupCost',compact(['labour','group']));
    }
}
