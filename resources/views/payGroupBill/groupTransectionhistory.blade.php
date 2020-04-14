@extends('admin.app')

@section('content')

@include('messages.message')
<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with all group transection</h3>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>
               <th>Group</th>
               <th>Description</th>
               <th>Total Amount</th>
               <th>Total Paid</th>
               <th>Total Due</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>

            @foreach($group_log_data as $key => $gl)
            <tr>

              <td><a href="{{route('group.partialBillPay',$gl->groupid)}}"></a>{{$gl->groupname}}</td>
              <td>{{$gl->description}}</td>
              <td>{{$gl->total_amount}}</td>
              <td>{{($gl->total_paid + $gl->last_paid)}}</td>
              <td>{{$gl->total_amount - ($gl->total_paid + $gl->last_paid)}}</td>
              <td>@if($gl->total_amount != ($gl->total_paid + $gl->last_paid))<a href="{{route('group.partialBillPay',$gl->groupid)}}" class="btn btn-primary">Pay Bill</a>@endif @if($gl->total_amount == ($gl->total_paid + $gl->last_paid)) <a href="{{route('group.TransectionHistoryDelete',$gl->groupid)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>@endif</td>
              
              
            </tr>

            @endforeach


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</section>
@endsection

@section('cs')
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('js')
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection