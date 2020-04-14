@extends('admin.app')

@section('content')

<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with individual group</h3>
        </div>

        <form action="{{route('cost.employeeBasedReport')}}" method="GET">
         From : <input type="date" name="from" value="{{$from}}"> To : <input type="date" name="to" value="{{$to}}">
          <select name="group">
            @foreach($group as $gp)
              <option {{$gp->id == $gp_trac? ' selected':''}}value="{{$gp->id}}">{{$gp->name}}</option>
            @endforeach
            
          </select> 

          <button type="submit">Go</button>
        </form>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>

              <td>Paid To</td>
              <td>Total Amount</td>
              <td>Total খোরাকী পাবে</td>
              <td>Paid amount(খোরাকী পেয়েছে)</td>
              <td>Due খোরাকী</td>
              <td>হাজিরা সংখ্যা</td>
              <td>Due Salary</td>
              
            </tr>
          </thead>

          <tbody>

            @foreach($employee_based_log as $lbl)
              <tr>

                <td>{{$lbl->name}}</td>
                <td>{{$lbl->total_amount}}</td>
                <td>{{$lbl->total_food_get}}</td>
                <td>{{$lbl->total_paid}}</td>
                <td>{{$lbl->total_food_get - $lbl->total_paid}}</td>
                <td>{{$lbl->total_attendence}}</td>
                <td>{{$lbl->total_amount - $lbl->total_paid}}</td>
                
              </tr>
            @endforeach
          </tbody>

        </table>


        <div class="form-row text-center">
            <div class="col-12">
                <a href="{{route('downloadXL')}}" class="btn btn-primary" aria-hidden="true">XL Download</a>
            </div>
        </div>


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












