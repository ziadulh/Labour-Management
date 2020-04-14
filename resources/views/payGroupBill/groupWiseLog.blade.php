@extends('admin.app')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with all groups</h3>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>
               <th>Group Name</th>
               <th>Total Amount</th>
               <th>Total Paid</th>
               <th>Total Due</th>
               <th>Status</th>
             </tr>
           </thead>
           <tbody>

            @foreach($data as $dt)
              <tr>

                <td><a href="{{route('group.payGroupLogView',$dt->id)}}">{{$dt->name}}</a></td>
                <td>{{$dt->total_amount}}</td>
                <td>{{$dt->total_paid}}</td>
                <td>{{$dt->total_amount - $dt->total_paid}}</td>
                <td>{{($dt->total_amount - $dt->total_paid) == 0?'paid':'Not paid'}}</td>

                
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












