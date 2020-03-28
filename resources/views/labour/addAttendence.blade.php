

@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Labour হাজিরা Form</h3>
        </div>

        <form role="form" action="{{route('labour.addAttendenceStore',$id)}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="attendence"><span style="color:red">*</span> হাজিরা সংখ্যা </label>
                    <input type="text" class="form-control" id="attendence" value="{{  old('attendence')  }}" name="attendence">
                </div>

                <div class="form-group">
                    <label for="food_rate"> খোরাকী Paid <sub>(optional)</sub></label>
                    <input type="text" class="form-control" id="food_rate" value="{{  old('food_rate')  }}" name="food_rate">
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
