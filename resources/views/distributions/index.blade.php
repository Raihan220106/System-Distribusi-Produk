@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Daftar Distribusi</h2>
    <a href="{{ route('distributions.create') }}" class="btn btn-primary mb-3">Tambah Distribusi</a>

    <table class="table table-bordered" id="distributionTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Barista</th>
                <th>Total Qty</th>
                <th>Estimasi</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Distribusi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div id="detailContent"></div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
    let table = $('#distributionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("distributions.index") }}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'barista', name: 'barista'},
            {data: 'total_qty', name: 'total_qty'},
            {data: 'estimated_result', name: 'estimated_result'},
            {data: 'notes', name: 'notes'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // Detail
    $(document).on('click', '.btn-detail', function() {
    let id = $(this).data('id');
    $.get('/distributions/' + id, function(data) {
        let html = '';
        data.details.forEach(function(detail, i) {
            html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${detail.product.name}</td>
                    <td>${detail.qty}</td>
                    <td>${detail.price}</td>
                    <td>${detail.total}</td>
                </tr>`;
        });
        $('#detailTable tbody').html(html);
        $('#detailModal').modal('show');
    });
});

    // Delete
    $(document).on('click', '.delete', function(){
        if(confirm('Yakin hapus distribusi ini?')){
            let id = $(this).data('id');
            $.ajax({
                url: '/distributions/'+id,
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(){
                    table.ajax.reload();
                }
            });
        }
    });
});
</script>

{{-- <script src="{{ asset('js/distributions.js') }}"></script> --}}
@endpush
