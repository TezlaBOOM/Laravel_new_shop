@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
<div class="row">
  <div class="col-6">
    <h1>Lista produktów</h1>
  </div>
  <div class="col-6">
    <a class="float-right" href="{{ route('products.create') }}">
      <button type="button" class="btn btn-primary">Dodaj produkt</button>
    </a>

</div>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Opis</th>
        <th scope="col">Ilość</th>
        <th scope="col">Cena</th>
        <th scope="col">Akcje</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <th scope="row">{{$product->id}}</th>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->amount}}</td>
        <td>{{$product->price}}</td>
        <td>
          <button class="btn btn-danger btn-sm delete" data-id="{{$product->id}}">
            X
          </button>
        </td>
      </tr>
  @endforeach
    </tbody>
  </table>
</div>

{{$products->links()}}
</div>
@endsection
@section('javascript')
@endsection
@section('js-files')
@endsection