@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Distribution</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $distribution->name }}</h3>
            <p>{{ $distribution->description }}</p>
        </div>
    </div>

    <h4 class="mt-4">Products</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($distribution->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->pivot->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('distributions.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
