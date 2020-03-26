@extends('admin.app')

@section('content')

    @include('messages.message')

    <div class="card-body">
        <table class="table table-bordered">
            <thead>                  
                <tr>
                    <th>Change</th>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $data)

                    <tr>
                        <td >
                            <form action="{{route('group.destroy',$data->id)}}" method="post" >
                                @csrf
                                {{method_field('delete')}}
                                <button class="btn btn-primary alert-danger fas fa-trash-alt" onclick="return confirm('Are you sure you want to delete the group and It\'s corresponding Building?')" type="submit"></button>
                                <a href="{{  route('group.edit',$data->id)  }}"><i class=" btn btn-primary fa fa-edit"></i></a>
                            </form>
                        </td>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                    </tr>
                    
                @endforeach
                
            </tbody>
        </table>
    </div>
    
@endsection

