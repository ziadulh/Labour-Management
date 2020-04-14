

@extends('admin.app')

@section('content')


    @include('messages.message')
    
    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Pay bill</h3>
            </div>

            <form role="form" class="prevent-multiple-submit" action="{{route('group.partialBillPayStore',$id)}}" method="POST">
            @csrf
                <div class="card-body">
                	
                    <div class="form-group">
                        <label for="amount"><span style="color:red">*</span>Enter amount</label>
                        <input type="text" class="form-control" id="amount" value="{{  old('amount')  }}" name="amount">
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
