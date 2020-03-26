

@extends('admin.app')

@section('content')


    @include('messages.message')
    
    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Labour Create Form</h3>
            </div>

            <form role="form" action="{{route('labourType.store')}}" method="POST">
            @csrf
                <div class="card-body">
                	
                    <div class="form-group">
                        <label for="name"><span style="color:red">*</span>Type Name</label>
                        <input type="text" class="form-control" id="name" value="{{  old('name')  }}" name="name">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        
    </div>
    
@endsection
