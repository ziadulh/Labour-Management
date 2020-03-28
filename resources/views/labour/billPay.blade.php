

@extends('admin.app')

@section('content')


@include('messages.message')

<div class="col-md-6">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Labour Bill Payment</h3>
        </div>

        <form role="form" action="{{route('labour.billPayStore',$id)}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="attendence"><span style="color:red">*</span>Due Bill</label>
                    <input type="text" class="form-control"  value="{{$dueBill}}" readonly="">
                </div>

                <div class="form-group">
                    <label for="billPaymentAmount"><span style="color:red">*</span> Bill Payment <sub>(amount)</sub></label>
                    <input type="number" class="form-control" id="billPaymentAmount" value="{{  old('billPaymentAmount')  }}" max="{{$dueBill}}" name="billPaymentAmount">
                </div>

            </div>

            {{method_field('POST')}}

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

</div>

@endsection
