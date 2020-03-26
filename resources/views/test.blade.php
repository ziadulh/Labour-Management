
@foreach($d as $d)
<p>{{$d->id}}</p>
<p>{{$d->email}}</p>
<p>{{$d->password}}</p>
<p>{{$d->created_at}}</p>
<p>{{$d->updated_at}}</p> <br><br>
@endforeach