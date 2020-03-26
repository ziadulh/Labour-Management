
@extends('admin.app')

@section('content')

    @include('messages.message')

    <div class="card-body">
        <table class="table table-bordered">
            <thead>                  
                <tr>
                    <th style="width: 50%px">Information</th>
                    <th >Value</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                	<th>Name</th>
                	<td>{{$labour->name}}</td>   
                </tr>

                <tr>
                	<th>Attendance rate</th>
                	<td>{{$labour->attendance_rate}}</td>   
                </tr>

                <tr>
                	<th>Food Rate</th>
                	<td>{{$labour->food_rate}}</td>   
                </tr>

                <tr>
                	<th>Total Attendance</th>
                	<td>{{$labour->total_attendance}}</td>   
                </tr>

                <tr>
                	<th>Total Salary</th>
                	<td>{{$labour->total_salary}}</td>   
                </tr>

                <tr>
                	<th>Total Paid /Total Food rate Paid</th>
                	<td>{{$labour->total_paid}}</td>   
                </tr>

                <tr>
                    <th>Total Foot Rate</th>
                    <td>{{$labour->total_food_rate}}</td>   
                </tr>

                <tr>
                    <th>Due Foot Rate</th>
                    <td>{{$labour->due_foodrate}}</td>   
                </tr>

                <tr>
                	<th>Total Due</th>
                	<td>{{$labour->total_due}}</td>   
                </tr>


                
            </tbody>
        </table>
        <div class="card-footer">
            <a href="{{  route('labour.addAttendence',$labour->id)  }}"><i class=" btn btn-primary"> Update Information </i></a>
        </div>
    </div>
    
@endsection















<!-- 
@extends('admin.app')

@section('content')


    @include('messages.message')
    
    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Labour Create Form</h3>
            </div>

            <form role="form" action="{{route('labour.store')}}" method="POST">
            @csrf
                <div class="card-body">
                	
                    <div class="form-group">
                        <label for="name"> Name</label> : {{$labour->name}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Attendance rate</label> : {{$labour->attendance_rate}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Food rate</label> : {{$labour->food_rate}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Total attendance</label> : {{$labour->total_attendance}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Total salary</label> : {{$labour->total_salary}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Total paid</label> : {{$labour->total_paid}}
                    </div>

                    <div class="form-group">
                        <label for="name"> Total due</label> : {{$labour->total_due}}
                    </div>
                    
                </div>

                <div class="card-footer">
                    <a href="{{  route('labour.addAttendence',$labour->id)  }}"><i class=" btn btn-primary"> Add Attendence </i></a>
                </div>

            </form>
        </div>
        
    </div>
    
@endsection -->
