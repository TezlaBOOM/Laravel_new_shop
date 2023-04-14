@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('sklep.product.show_title')}}</div>

                <div class="card-body">
                    
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{__('sklep.product.fileds.name')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"maxlenght="500" class="form-control" name="name" value="{{ $product->name }}" disabled>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{__('sklep.product.fileds.description')}}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" maxlenght="1500" class="form-control" name="description" disabled>{{$product->description}}</textarea>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{__('sklep.product.fileds.amount')}}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" min="0" class="form-control" name="amount" value="{{ $product->amount }}" disabled>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{__('sklep.product.fileds.price')}}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" min="0" class="form-control" name="price" value="{{ $product->price }}" disabled>

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{__('sklep.product.fileds.category')}}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category_id">
                                    @if(!is_null($product->category))
                                        <option>{{$product->category->name}}</option>
                                    @else
                                        <option value="">brak</option>
                                    @endif                    
                                </select>
                            </div>
                        </div>

                        <div class="row justifly-content-center">

                            <div class="col-md-6">
                               @if(!is_null($product->image_path)) 
                                    <img src="{{asset('storage/' . $product->image_path)}}" alt="Zdjęcie produktu">
                                @endif
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
