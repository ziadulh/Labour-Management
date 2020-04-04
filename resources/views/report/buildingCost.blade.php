@extends('admin.app')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with all buildings</h3>
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

            @foreach($building as $key => $bl)
              <tr>
                <td><a href="{{route('perbuilding.cost',$bl->id)}}">{{$bl->name}}</a></td>
                @if(isset($log[$key]) && $bl->id == $log[$key]->building_id)
                  @foreach($total_array as $tbl => $tbl_cost)
                    @if($tbl == $bl->id)
                      <td>{{$tbl_cost + (isset($sl_arr[$bl->id]) ? $sl_arr[$bl->id] : 0)}}</td>
                      <td>{{$log[$key]->total_paid}} + {{(isset($sl_arr[$bl->id]) ? $sl_arr[$bl->id] : 0)}}(salary paid)</td>
                      <td>{{$tbl_cost - $log[$key]->total_paid}}</td>
                    @endif
                  @endforeach
                @else
                  <td>{{0}}</td>
                  <td>{{0}}</td>
                  <td>{{0}}</td>
                @endif
              </tr>
              
            @endforeach



            <!-- @foreach($log as $log)
              <tr>
                @foreach($building as $bl)
                  @if($bl->id == $log->building_id)
                    <td><a href="{{route('perbuilding.cost',$log->building_id)}}">{{$bl->name}}</a></td>
                  @endif
                @endforeach
                  <td>{{$log->total_food}}</td>
                  <td>{{$log->total_food - $log->total_paid}}</td>
              </tr>
            @endforeach -->
  

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

















