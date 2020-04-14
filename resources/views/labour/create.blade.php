

@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Labour Entry Form</h3>
        </div>

        <form role="form" class="prevent-multiple-submit" action="{{route('labour.store')}}" method="POST">
            @csrf
            <div class="card-body">
               
                <div class="form-group">
                    <label for="name"><span style="color:red">*</span>Name</label>
                    <input type="text" class="form-control" id="name" value="{{  old('name')  }}" name="name">
                </div>

                <div class="form-group">
                    <label for="joining_date"><span style="color:red">*</span>Joining Date</label>
                    <input type="date" class="form-control" id="joining_date" value="{{  old('joining_date')  }}" name="joining_date">
                </div>

                <div class="form-group">
                    <label for="labour_type"><span style="color:red">*</span>Labour Type</label>
                    <select class="form-control " id="labour_type" style="width: 100%;" name="labour_type">
                       @foreach($labourType as $lt)
                       <option value="{{$lt->id}}" > {{$lt->name}}</option>
                       @endforeach
                   </select>
               </div>

               <div class="form-group">
                <label for="group_id"><span style="color:red">*</span>Group</label>
                <select class="form-control " id="group_id" style="width: 100%;" name="group_id">
                   <option value="-1">Choose Group</option>
                   @foreach($group as $group)
                    <option value="{{$group->id}}" > {{$group->name}}</option>
                   @endforeach
               </select>
           </div>

           <div class="form-group">
            <label for="building_id"><span style="color:red">*</span>Building</label>
            <select id="building_id" class="form-control " style="width: 100%;" name="building_id">
               <!-- @foreach($building as $building)
               <option value="{{$building->id}}" > {{$building->name}}</option>
               @endforeach -->
           </select>
       </div>

       <div class="form-group">
        <label for="attendance_rate"><span style="color:red">*</span>Attendance Rate</label>
        <input type="text" class="form-control" id="attendance_rate" value="{{  old('attendance_rate')  }}" name="attendance_rate">
    </div>

    <!-- <div class="form-group">
        <label for="food_rate"><span style="color:red">*</span>Food Rate</label>
        <input type="text" class="form-control" id="food_rate" value="{{  old('food_rate')  }}" name="food_rate">
    </div> -->

    <div class="form-group">
        <label for="status"><span style="color:red">*</span>Status</label>
        <select class="form-control" id="status" style="width: 100%;" name="status">
            <option value="1" >Yes</option>
            <option value="0">No</option>
        </select>
    </div>
    
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary disable-submit-button">Submit</button>
</div>

</form>
</div>

</div>

@endsection

@section('js')
  <script>
    $(document).ready(function () {


      $('#group_id').on('change',function () {
            $('select[name="building_id"]').empty();
            var group_id_val =$(this).val();
            if(group_id_val){
                $.ajax({
                    type:'GET',
                    url:'{{route('findBuilding')}}',
                    data:{'id':group_id_val},
                    dataType:'json',
                    success:function(data) {
                        $('select[name="building_id"]').append('<option>Choose Building</option>');
                        $.each(data, function(key,value){
                            console.log(key);
                            $('select[name="building_id"]').append('<option value="'+key+'" >' + value +'</option>');
                        });
                    }
                });
            }
            else{
                $('select[name="building_id"]').empty();
            }
        });


      $('.prevent-multiple-submit').on('submit', function(){
            $('.disable-submit-button').attr('disabled','true');
        });



        

    });
</script>
@endsection
