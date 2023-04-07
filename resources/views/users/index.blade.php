@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Imie</th>
      <th scope="col">Nazwisko</th>
      <th scope="col">E-mail</th>
      <th scope="col">Akcje</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->surname}}</td>
      <td>{{$user->email}}</td>
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">
          X
        </button>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
{{$users->links()}}
</div>
@endsection
@section('javascript')
$(function(){
  $('.delete').click(function() {
          $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        method: "DELETE",
        url: "http://sklep.test/users/list/" + $(this).data("id"),
        //data: { id: $(this).data("id") }
      })
        .done(function( msg ) {
          window.location.reload();
        })
        .fail(function(response) {
          alert( "ERROR");
        });
   });
});
@endsection