@extends('admin.app')

@section('content')

<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with individual building</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>

              <td>Date</td>
              <td>Paid To</td>
              <td>Paid amount/(খোরাকী পেয়েছে)</td>
              <td>হাজিরা সংখ্যা</td>
              <td>Total খোরাকী পাবে</td>
            </tr>
          </thead>

          <tbody> 

            @foreach($building_cost as $bc)
            <tr>
              <td>{{$bc->food_rate_date}}</td>
              @foreach($labour as $lbr)
              @if($lbr->id == $bc->labour_id)
              <td>{{$lbr->name}}</td>
              @endif
              @endforeach

              <td>{{$bc->food_rate_paid}}</td>
              <td>{{$bc->attendence_number}}</td>
              <td>{{$bc->food_rate_will_get}}</td>
            </tr>
            @endforeach

            @foreach($sb_log as $sb_log)
            <tr>
              <td>{{$sb_log->month}}</td>
              @foreach($emp as $em)
              @if($em->id == $sb_log->employee_id)
              <td>{{$em->name}}</td>
              @endif
              @endforeach

              <td>{{$sb_log->salary}}</td>
              <td>Full time Employee</td>
              <td>Full time Employee</td>
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












