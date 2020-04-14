

@extends('admin.app')

@section('content')


    @include('messages.message')
    
    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Building Edit Form</h3>
            </div>

            <form role="form" class="prevent-multiple-submit" action="{{route('building.update',$building->id)}}" method="POST">
            @csrf
                <div class="card-body">
                	
                    <div class="form-group">
                        <label for="name"><span style="color:red">*</span>Building Name</label>
                        <input type="text" class="form-control" id="name" value="{{ $building->name }}" name="name">
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">*</span>Select Group</label>
                        <select class="form-control " style="width: 100%;" name="group_id">
                            @foreach($group as $gd)
                                <option {{ ($gd->id == $building->group_id) ? 'selected' : '' }} value="{{$gd->id}}" >{{$gd->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">*</span>Status</label>
                        <select class="form-control " style="width: 100%;" name="status">
                            <option {{ ($building->status == 1) ? 'selected' : '' }} value="1" >Yes</option>
                            <option {{ ($building->status == 0) ? 'selected' : '' }} value="0">No</option>
                        </select>
                    </div>
                    
                </div>

                {{method_field('PUT')}}

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
