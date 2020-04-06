

@extends('admin.app')

@section('content')


@include('messages.message')



<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">Update Labour Information</h3>
    </div>

    <form role="form" action="{{route('labour.update',$labour->id)}}" method="POST">
        @csrf
        <div class="card-body">

            <section class="content">
              <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="joining_date"><span style="color:red">*</span>Joining date</label>
                            <input type="date" class="form-control" id="joining_date" value="{{ $labour->joining_date }}" name="joining_date">
                        </div>
                        <div class="form-group">
                            <label for="name"><span style="color:red">*</span>Full Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $labour->name }}" name="name">
                        </div>

                        <div class="form-group">
                            <label for="joining_date"><span style="color:red">*</span>Job ID</label>
                            <input type="text" class="form-control" id="id" value="EP-{{ $labour->id }}" name="id" readonly>
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="labour_type"><span style="color:red">*</span>Labour type</label>
                            <select id="group_id" class="form-control " style="width: 100%;" name="labour_type">
                                @foreach($labour_type as $labour_type)
                                <option value="{{$labour_type->id}}" {{ ($labour_type->id == $labour->labour_type)? 'selected' : '' }} > {{$labour_type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="group_id"><span style="color:red">*</span>Group</label>
                            <select id="group_id" class="form-control " style="width: 100%;" name="group_id" disabled="">
                                @foreach($group as $group)
                                <option value="{{$group->id}}" {{ ($group->id == $labour->group_id)? 'selected' : '' }}> {{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="building_id"><span style="color:red">*</span>Building</label>
                            <select id="building_id" class="form-control " style="width: 100%;" name="building_id">
                                @foreach($building as $building)
                                <option value="{{$building->id}}" {{ ($building->id == $labour->building_id)? 'selected' : '' }}> {{$building->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="attendance_rate"><span style="color:red">*</span>হাজিরা Rate</label>
                            <input type="text" class="form-control" id="attendance_rate" value="{{ $labour->attendance_rate }}" name="attendance_rate">
                        </div>



                        <!-- <div class="form-group">
                            <label for="food_rate"><span style="color:red">*</span> খোরাকী Rate</label>
                            <input type="text" class="form-control" id="food_rate" value="{{ $labour->food_rate }}" name="food_rate">
                        </div> -->

                        <div class="form-group">
                            <label for="total_paid"><span style="color:red">*</span>Total  খোরাকী Paid</label>
                            <input type="text" class="form-control" id="total_paid" value="{{ $labour->total_paid }}" name="total_paid">
                        </div>



                    </div>




                    <div class="col-md-4" style="background-color: lightblue">

                        <div class="form-group">
                            <label for="total_attendance"><span style="color:red">*</span> Total হাজিরা </label>
                            <input type="text" class="form-control" id="total_attendance" value="{{ $labour->total_attendance }}" name="total_attendance">
                        </div>


                        <div class="form-group">
                            <label for="total_salary"><span style="color:red">*</span> Total বেতন </label>
                            <input type="text" class="form-control" id="total_salary" value="{{ $labour->total_salary }}" name="total_salary" readonly>
                        </div>



                        <div class="form-group">
                            <label for="total_due"><span style="color:red">*</span> Due বেতন </label>
                            <input type="text" class="form-control" id="total_due" value="{{ $labour->total_due }}" name="total_due" readonly>
                        </div>



                        <div class="form-group">
                            <label for="total_food_rate"><span style="color:red">*</span> Total খোরাকী </label>
                            <input type="text" class="form-control" id="total_food_rate" value="{{ $labour->total_food_rate }}" name="total_food_rate" readonly>
                        </div>

                        <div class="form-group">
                            <label for="due_foodrate"><span style="color:red">*</span> Due খোরাকী </label>
                            <input type="text" class="form-control" id="due_foodrate" value="{{ $labour->total_food_rate - $labour->total_paid }}" name="due_foodrate" readonly>
                        </div>

                        <div class="form-group">
                            <label><span style="color:red">*</span>Status</label>
                            <select class="form-control " style="width: 100%;" name="status">
                                <option {{ ($labour->status == 1) ? 'selected' : '' }} value="1" >Yes</option>
                                <option {{ ($labour->status == 0) ? 'selected' : '' }} value="0">No</option>
                            </select>
                            
                        </div>



                    </div>




                </div>
            </div>
        </section>






    </div>

    {{method_field('PUT')}}

    <div class="card-footer">
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    </div>

</form>
</div>



@endsection
