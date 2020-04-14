

@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Labour Type Create Form</h3>
        </div>

        <form role="form" class="prevent-multiple-submit" action="{{route('salarybasedemployee.store')}}" method="POST">
            @csrf
            <div class="card-body">
               
                <div class="form-group">
                    <label for="name"><span style="color:red">*</span>Type Name</label>
                    <input type="text" class="form-control" id="name" value="{{  old('name')  }}" name="name">
                </div>

                <div class="form-group">
                    <label for="building_id"><span style="color:red">*</span>Building</label>
                    <select id="building_id" class="form-control " style="width: 100%;" name="building_id">
                       @foreach($building as $building)
                            <option value="{{$building->id}}" > {{$building->name}}</option>
                       @endforeach
                   </select>
               </div>

               <div class="form-group">
                    <label for="salary"><span style="color:red">*</span>Salary Amount</label>
                    <input type="text" class="form-control" id="salary" value="{{  old('salary')  }}" name="salary">
                </div>


                <div class="form-group">
                    <label><span style="color:red">*</span>Status</label>
                    <select class="form-control " style="width: 100%;" name="status">
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
        $('.prevent-multiple-submit').on('submit', function(){
            $('.disable-submit-button').attr('disabled','true');
        });
    });
</script>
@endsection
