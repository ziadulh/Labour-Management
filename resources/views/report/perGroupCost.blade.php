@extends('admin.app')

@section('content')

<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with individual group</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>

              <td>Date</td>
              <td>Paid To</td>
              <td>Paid amount</td>
              <td>Building Name</td>
              <td>হাজিরা সংখ্যা</td>
            </tr>
          </thead>

          <tbody>

            @foreach($group_cost as $gp)
            <tr>
              <td>{{$gp->food_rate_date}}</td>

              @foreach($labour as $lbr)
              @if($lbr->id == $gp->labour_id)
              <td>{{$lbr->name}}</td>
              @endif
              @endforeach

              <td>{{$gp->food_rate_paid}}</td>
              @foreach($building as $bl)
              @if($bl->id == $gp->building_id)
              <td>{{$bl->name}}</td>
              @endif
              @endforeach
              <td>{{$gp->attendence_number}}</td>
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












