

@extends('admin.app')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Labour Informations</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 200px">Action</th>
                <th >Job ID</th>
                <th>Name</th>
                <th>Salary</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sb_employee as $key => $data)

              <tr>
                <td >
                  <form action="{{route('salarybasedemployee.destroy',$data->id)}}" method="post" >
                    @csrf
                    {{method_field('delete')}}
                    <button class="btn btn-primary alert-danger fas fa-trash-alt" onclick="return confirm('Are you sure?')" type="submit"></button>
                    <a href="{{  route('salarybasedemployee.edit',$data->id)  }}"><i class=" btn btn-primary fa fa-edit"></i></a>
                    <!-- <a href="{{  route('salarybasedemployee.show',$data->id)  }}"><i class="btn btn-primary"><b>i</b></i></a> -->
                    <a class="btn btn-primary" href="{{  route('salarybasedemployee.addSalary',$data->id)  }}"><i class="fa fa-cutlery">B</i></a>
                  </form>
                </td>
                <td>SBE-{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->salary}}</td>
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



