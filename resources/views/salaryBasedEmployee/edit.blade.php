




@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Update Group</h3>
        </div>

        <form role="form" action="{{route('salarybasedemployee.update',$sb_employee->id)}}" method="POST">
            @csrf
            <div class="card-body">
                		<div class="form-group">
		                    <label for="name"><span style="color:red">*</span>Name</label>
		                    <input type="text" class="form-control" id="name" value="{{  $sb_employee->name  }}" name="name">
		                </div>

		                <div>

                            <label for="building_id"><span style="color:red">*</span>Building</label>
		                    <select id="building_id" class="form-control " style="width: 100%;" name="building_id">
		                       @foreach($building as $building)
		                            <option {{$building->id == $sb_employee->building_id?'selected':''}} value="{{$building->id}}" > {{$building->name}}</option>
		                       @endforeach
		                   </select>
		               </div>

		               <div class="form-group">
		                    <label for="salary"><span style="color:red">*</span>Salary Amount</label>
		                    <input type="text" class="form-control" id="salary" value="{{  $sb_employee->salary  }}" name="salary">
		                </div>

                        <div class="form-group">
                            <label><span style="color:red">*</span>Status</label>
                            <select class="form-control " style="width: 100%;" name="status">
                                <option {{ ($sb_employee->status == 1) ? 'selected' : '' }} value="1" >Yes</option>
                                <option {{ ($sb_employee->status == 0) ? 'selected' : '' }} value="0">No</option>
                            </select>
                            
                        </div>
            </div>

            {{method_field('PUT')}}

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
    
</div>

@endsection

