@extends('layouts.app')

@section('content')
<div class="container">
    @include('helpers.flash-messages')
    <div class="row">
        <div class="col-6">
            <h1><i class="fas fa-clipboard-list"></i> Zamówienia</h1>
        </div>
    </div>
    <div class="row">
        <h2>Przelewy24</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena [PLN]</th>
                <th scope="col">Status</th>
                <th scope="col">Produkty</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td scope="row">{{ $order->id }}</td>
                    <td scope="row">{{ $order->quantity }}</td>
                    <td scope="row">{{ $order->price }} PLN</td>
                    <td scope="row">{{ $order->payment->status }}</td>
                    <td scope="row">
                        @foreach($order->products as $product)
                            <ul>
                                <li>{{ $product->name }} - {{$product->description}}</li>
                            </ul>
                        @endforeach 
                    </td> 
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h2>Paypal</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena [PLN]</th>
                <th scope="col">Status</th>
                <th scope="col">Produkty</th>
            </tr>
            </thead>
            <tbody>
    @foreach($paypal as $paypals)
                    <tr>
                        <td scope="row">{{ $paypals->id }}</td>
                        <td scope="row">{{ $paypals->quantity }}</td>
                        <td scope="row">{{ $paypals->amount }} PLN</td>
                        <td scope="row">{{ $paypals->payment_status }}</td>
                        <td scope="row">
                            @foreach($paypals->product as $products)
                                <ul>
                                    <li>{{ $products->name }} - {{$products->description}}</li>
                                </ul>
                            @endforeach 
                        </td> 
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Stripe</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena [PLN]</th>
                <th scope="col">Status</th>
                <th scope="col">Produkty</th>
            </tr>
            </thead>
            <tbody>
    @foreach($stripe as $stripes)
                    <tr>
                        <td scope="row">{{ $stripes->id }}</td>
                        <td scope="row">{{ $stripes->quantity }}</td>
                        <td scope="row">{{ $stripes->amount }} PLN</td>
                        <td scope="row">{{ $stripes->payment_status }}</td>
                        <td scope="row">
                            @foreach($stripes->product as $products)
                                <ul>
                                    <li>{{ $products->name }} - {{$products->description}}</li>
                                </ul>
                            @endforeach 
                        </td> 
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection