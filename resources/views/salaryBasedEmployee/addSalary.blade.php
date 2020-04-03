

@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Add salary</h3>
        </div>

        <form role="form" action="{{route('salarybasedemployee.addSalaryStore',$id)}}" method="POST">
            @csrf
            <div class="card-body">
               
                <div class="form-group">
                    <label for="salary"><span style="color:red">*</span>Salary amount</label>
                    <input type="text" class="form-control" id="salary" value="{{  old('salary')  }}" name="salary">
                </div>

                <div class="form-group">
                    <label for="month"><span style="color:red">*</span>Month</label>
                    <input type="text" class="form-control" id="month" value="{{  old('month')  }}" name="month">
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
    
</div>

@endsection
