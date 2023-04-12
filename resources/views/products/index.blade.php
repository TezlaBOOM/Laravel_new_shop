@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
<div class="row">
  <div class="col-6">
    <h1>{{__('sklep.product.index_title')}}</h1>
  </div>
  <div class="col-6">
    <a class="float-right" href="{{ route('products.create') }}">
      <button type="button" class="btn btn-primary">{{__('sklep.button.add_product')}}</button>
    </a>

</div>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">{{__('sklep.product.fileds.name')}}</th>
        <th scope="col">{{__('sklep.product.fileds.description')}}</th>
        <th scope="col">{{__('sklep.product.fileds.amount')}}</th>
        <th scope="col">{{__('sklep.product.fileds.price')}}</th>
        <th scope="col">{{__('sklep.columns.fileds.category')}}</th>
        <th scope="col">{{__('sklep.columns.actions')}}</th>
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
        <td>@if(!is_null($product->category)){{$product->category->name}}@endif</td>
        <td>
        <a href="{{route('products.show', $product->id)}}">
            <button class="btn btn-primary btn-sm" > P </button>
          </a>
          <a href="{{route('products.edit', $product->id)}}">
            <button class="btn btn-success btn-sm" > E </button>
          </a>
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
  const deleteURL = "{{url('products')}}/";
  const confirmDelete = "{{__('sklep.messages.delete_confirm')}}";
@endsection
@section('js-files')
@endsection