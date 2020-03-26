@extends('admin.app')

@section('content')
<section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                	<tr>
	                    <th>Building Name</th>
                      <th>Total Cost</th>
	                </tr>
                </thead>
                <tbody>
                  @foreach($labour as $lb)
                	   <tr>
                      <td>
                        @foreach($building as $bl)
                            @if($bl->id == $lb[0]->building_id)
                                {{$bl->name}}
                            @endif
                        @endforeach
                        

                        

                      </td>
                          @php
                                $sum = 0;
                                foreach($lb as $lb){
                                $sum = $sum + $lb->total_salary;
                              }
                          @endphp       
                      <td>{{$sum}}</td>
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












