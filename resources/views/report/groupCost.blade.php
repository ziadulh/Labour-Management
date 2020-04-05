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
               <th>Building Name</th>
               <th>Total Amount</th>
               <th>Total Cost</th>
               <th>Total Due</th>
             </tr>
           </thead>
           <tbody>

            @foreach($group as $key => $gl)
            <tr>
              <td><a href="{{route('pergroup.cost',$gl->id)}}">{{$gl->name}}</a></td>
              @if(isset($log[$key]))
              @foreach($total_array as $tgl => $tgl_cost)

              @if($tgl == $gl->id)
              <td>{{$tgl_cost}}</td>
              <td>{{$log[$key]->total_paid}}</td>
              <td>{{$tgl_cost - $log[$key]->total_paid}}</td>
              @endif
              @endforeach
              @else
              <td>{{0}}</td>
              <td>{{0}}</td>
              <td>{{0}}</td>
              @endif
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












