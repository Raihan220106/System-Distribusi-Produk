@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-box-seam"></i> Distribusi Produk</h4>
            <a href="{{ route('distributions.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Distribusi
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle" id="table-distributions" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Barista</th>
                        <th>Total Qty</th>
                        <th>Estimasi</th>
                        <th>Notes</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- DataTables --}}
<script>
$(function(){
    $('#table-distributions').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        ajax: "{{ route('distributions.index') }}",
        columns:[
            {data:'created_at'},
            {data:'barista'},
            {data:'total_qty', className: "text-center fw-bold"},
            {
                data:'estimated_result',
                render: function(data){
                    return `<span class="badge bg-success">${data}</span>`;
                }
            },
            {data:'notes'},
            {
                data:'action', 
                orderable:false, 
                searchable:false,
                className:"text-center"
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari distribusi...",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(difilter dari total _MAX_ data)"
        }
    });
});
</script>
@endsection
