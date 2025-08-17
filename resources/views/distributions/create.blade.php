@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Distribusi</h4>
            <a href="{{ route('distributions.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('distributions.store') }}" method="POST">
                @csrf

                {{-- Pilih Barista --}}
                <div class="mb-3">
                    <label for="barista" class="form-label">Pilih Barista</label>
                    <select name="barista_id" id="barista" class="form-select" required>
                        <option value="">-- Pilih Barista --</option>
                        @foreach($baristas as $barista)
                            <option value="{{ $barista->id }}">{{ $barista->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Produk --}}
                <div class="mb-3">
                    <label for="product" class="form-label">Pilih Produk</label>
                    <select name="product_id" id="product" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="total_qty" id="total_qty" class="form-control" min="1" required>
                </div>

                {{-- Catatan Opsional --}}
                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan</label>
                    <textarea name="notes" id="notes" class="form-control" rows="2" placeholder="Opsional..."></textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
