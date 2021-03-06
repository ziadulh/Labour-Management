@extends('admin.app')

@section('content')


	@include('messages.message')

	<div class="col-md-6">

	    <div class="card card-primary">

	        <div class="card-header">
	            <h3 class="card-title">Pay Bill</h3>
	        </div>

	        <form role="form" class="prevent-multiple-submit"  action="{{route('group.payGroupBillToLog',$id)}}" method="POST">
	            @csrf
	            <div class="card-body">
	               
	                <div class="form-group">
	                    <label for="pay_amount"><span style="color:red">*</span>Enter Amount</label>
	                    <input type="text" class="form-control" id="pay_amount" value="{{  old('pay_amount')  }}" name="pay_amount">
	                </div>

	                <div class="form-group">
	                    <label for="payment_date"><span style="color:red">*</span>Payment Date</label>
	                    <input type="date" class="form-control" id="payment_date" value="{{  old('payment_date')  }}" name="payment_date">
	                </div>

	                <div class="form-group">
	                    <label for="description"><span style="color:red">*</span>Description</label>
	                    <textarea class="form-control" name="description"><?php echo htmlspecialchars(old('description')); ?></textarea>
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