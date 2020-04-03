

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
                    <label for="food_rate_date"><span style="color:red">*</span> তারিখ </label>
                    <input type="date" class="form-control" id="food_rate_date" value="{{  old('food_rate_date')  }}" name="food_rate_date">
                </div>

                <div class="form-group">
                    <label for="attendence"><span style="color:red">*</span> হাজিরা সংখ্যা </label>
                    <input type="text" class="form-control" id="attendence" value="{{  old('attendence')  }}" name="attendence">
                </div>

                <div class="form-group">
                    <label for="food_rate_will_get"><span style="color:red">*</span> নির্দিষ্ট দিনের মোট খোরাকি  </label>
                    <input type="text" class="form-control" id="food_rate_will_get" value="{{  old('food_rate_will_get')  }}" name="food_rate_will_get">
                </div>

                <div class="form-group">
                    <label for="food_rate"> খোরাকী Paid <sub>(optional)</sub></label>
                    <input type="text" class="form-control" id="food_rate" value="{{  old('food_rate')  }}" name="food_rate">
                </div>

                <div class="form-group">
                    <label for="building_id"><span style="color:red">*</span>Labour Type</label>
                    <select class="form-control " id="building_id" style="width: 100%;" name="building_id">
                       @foreach($building as $bld)
                       <option value="{{$bld->id}}" > {{$bld->name}}</option>
                       @endforeach
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
