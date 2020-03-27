

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
                        <th style="width: 200px">Change</th>
                        <th >Job ID</th>
                        <th>Name</th>
                        <th>Labour Type</th>
                        <th>Group</th>
                        <th>Building</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($labour as $key => $data)

                    <tr>
                        <td >
                            <form action="{{route('labour.destroy',$data->id)}}" method="post" >
                                @csrf
                                {{method_field('delete')}}
                                <button class="btn btn-primary alert-danger fas fa-trash-alt" onclick="return confirm('Are you sure?')" type="submit"></button>
                                <a href="{{  route('labour.edit',$data->id)  }}"><i class=" btn btn-primary fa fa-edit"></i></a>
                                <a href="{{  route('labour.show',$data->id)  }}"><i class=" btn btn-primary"><b>i</b></i></a>
                                <a href="{{  route('labour.addAttendence',$data->id)  }}"><i class=" btn btn-primary">U</i></a>
                            </form>
                        </td>
                        <td>{{'EP-'}}{{$key}}</td>
                        <td>{{$data->name}}</td>
                        <td>
                            @foreach($labourType as $lt)

                                @if($lt->id == $data->labour_type)
                                {{$lt->name}}
                                @endif

                            @endforeach
                        </td>

                        <td>
                            @foreach($group as $lt)

                                @if($lt->id == $data->group_id)
                                {{$lt->name}}
                                @endif

                            @endforeach
                        </td>

                        <td>
                            @foreach($building as $lt)

                                @if($lt->id == $data->building_id)
                                {{$lt->name}}
                                @endif

                            @endforeach
                        </td>


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



