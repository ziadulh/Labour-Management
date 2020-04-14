<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Group_log;
use App\Group_archive;
use App\Salary_log;
use App\Group;
use App\Labour;

class PayGroupBill extends Controller
{

	public function payBillView($id)
	{
		$group = Group::where('id',$id)->first();
		return view('payGroupBill.view',compact(['group']));
	}

     public function payBill(Request $request, $id)
     {

        $request->validate(['pay_amount' => 'required | integer', 'payment_date' => 'required' , 'description' => 'required']);

        $group_based_log = DB::table('salary_logs')
    		->where('salary_logs.group_id','=',$id)
            ->join('labours', 'labours.id', '=', 'salary_logs.labour_id')
            ->selectRaw('salary_logs.labour_id as id, sum(salary_logs.attendence_number) as total_attendence, sum(salary_logs.food_rate_will_get) as total_food_get, sum(salary_logs.attendence_number * labours.attendance_rate) as total_amount, sum(salary_logs.food_rate_paid) as total_paid, labours.name as name')
            ->groupBy('labours.id','salary_logs.labour_id')
            ->orderBy('labours.id', 'asc')
            ->get();

            $group_log_data = [];
 
            $t_am = 0; $t_paid = 0; $t_due = 0;

            foreach ($group_based_log as $key => $gbl) {
            	$t_am = $gbl->total_amount + $t_am;
            	$t_paid = $t_paid + $gbl->total_paid;
            }

            $group_log_data['group_id'] = $id;
            $group_log_data['payment_date'] = $request->input('payment_date');
            $group_log_data['description'] = $request->input('description');
            $group_log_data['total_amount'] = $t_am;
            $group_log_data['total_paid'] = $t_paid;
            $group_log_data['total_due'] = $t_am - ($t_paid + $request->input('pay_amount'));
            $group_log_data['last_paid'] = $request->input('pay_amount');
            
            Group_log::create($group_log_data);

            $s_log = Salary_log::where('group_id',$id)->get();
            foreach ($s_log as $key => $value) {
            	$data = array(
            		"labour_id" => $value->labour_id,
            		"group_id" => $value->group_id,
            		"building_id" => $value->building_id,
            		"attendence_number" => $value->attendence_number,
            		"food_rate_will_get" => $value->food_rate_will_get,
            		"food_rate_paid" => $value->food_rate_paid,
            		"food_rate_date" => $value->food_rate_date,
            	);

            	Group_archive::create($data);
            	(Salary_log::find($value->id))->delete();	
            }

            foreach ($group_based_log as $key => $gbl) {
            	labour::where('id', $gbl->id)
				        ->update([

				            'total_food_rate' => 0,
				            'total_attendance' => 0,
				            'total_salary' => 0,
				            'total_paid' => 0,
				            'total_due' => 0,

				        ]);
            }


            return redirect(route('groupCost.report'))->with('success', 'Grouply bill paid');
    }

    /*public function viewGroupLog(){
        $data = DB::table('group_logs')
                 ->selectRaw('sum(group_logs.total_amount) as total_amount, sum(group_logs.total_paid) as total_paid, groups.name as name, group_logs.group_id as id')
                 ->join('groups', 'groups.id', '=', 'group_logs.group_id')
                 ->groupBy('group_logs.group_id','groups.name')
                 ->orderBy('group_logs.group_id', 'asc')
                 ->get();
        return view('payGroupBill.groupWiseLog',compact(['data']));
    }

    public function payGroupLogView($id){
        return view('payGroupBill.payBillToGroupLog',compact(['id']));
    }

    public function payGroupBillToLog(Request $request, $id){
        $data = array(
            "group_id" => $id,
            "payment_date" => $request->input('payment_date'),
            "description" => $request->input('description'),
            "total_paid" => $request->input('pay_amount'),
            "total_amount" => 0,
            "total_due" => 0,
            "last_paid" => $request->input('pay_amount'),

        );

        Group_log::create($data);

        return redirect(route('group.viewGroupLog'));
    }*/


    public function groupTransectionHistory(){
        $group_log_data = DB::select(DB::raw(" SELECT groups.name as groupname,  group_logs.id as groupid, group_logs.description as description, group_logs.total_amount as total_amount, group_logs.total_paid as total_paid, group_logs.last_paid as last_paid
            FROM group_logs
            LEFT JOIN groups
            ON group_logs.group_id = groups.id
            ORDER BY group_logs.id DESC
            ")); 
        return view('payGroupBill.groupTransectionhistory',compact('group_log_data'));
    }

    public function partialGroupBillPay($id){

        return view('payGroupBill.partialGroupBillPay', compact('id'));

    }

    public function partialGroupBillPayStore(Request $request, $id){

        $request->validate(['amount' => 'required | integer']);

        Group_log::where('id', $id)
          ->update([
            'last_paid' => Group_log::find($id)->last_paid + $request->input('amount'),
          ]);

          return redirect(route('group.TransectionHistory'))->with('success', 'Your group transection has been updated!');

    }

    public function groupTransectionHistoryDelete(Request $request, $id){

        (Group_log::find($id))->delete();

          return redirect(route('group.TransectionHistory'))->with('success', 'Your group transection data has been deleted!');

    }
}
