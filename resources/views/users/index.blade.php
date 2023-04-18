@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
  @include('helpers.flash-messages')
    <div class="row">
        <div class="col-6">
            <h1>{{__('sklep.users.index_title')}}</h1>
        </div>
    </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">{{ __('Name') }}</th>
      <th scope="col">{{ __('Surname') }}</th>
      <th scope="col">{{ __('Email') }}</th>
      <th scope="col">{{ __('Phone Number') }}</th>
      <th scope="col">{{ __('Action') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->surname}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->phone_number}}</td>
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">
        <i class="fa-solid fa-trash"></i>
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
const deleteURL = "{{url('users/list')}}/";
const confirmDelete = "{{__('sklep.messages.delete_confirm')}}";
@endsection
@section('js-files')
@endsection