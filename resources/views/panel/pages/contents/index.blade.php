@extends('panel.layouts.app')
@php
    $backUrl = url()->to(Request::segment(1) . '/');
@endphp

@push('lower_styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Konten</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $backUrl }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Konten</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-md-6 -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('panel.contents.create') }}" type="button" class="btn btn-primary">Buat
                                    Konten
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="contents-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30%">Judul</th>
                                            <th width="30%">Slug</th>
                                            <th width="20%">Kategori</th>
                                            <th class="d-none"></th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('custom_html')
    <!-- Modal Delete Content -->
    <div class="modal fade" id="modal-delete-content" tabindex="-1" aria-labelledby="deleteContentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-content" method="POST">
                @csrf
                <input type="hidden" name="id" id="delete-content-id">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin ingin menghapus konten <strong id="delete-content-title"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="btn-delete-content">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Delete Content --}}
@endpush
@push('lower_scripts')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            window.contentTable = $('#contents-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('panel.contents.data') }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'updated_at', name: 'updated_at', visible: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[3, 'desc']], // index 3 = kolom updated_at
                language: {
                    url: '{{ asset('assets/panel/custom/datatables/id.json')}}'
                }
            });
        });
    </script>
    {{-- Start Content Delete Script --}}
    <script>
        $(function () {
            // Tangani klik tombol hapus
            $(document).on('click', '[data-target="#modal-delete-content"]', function () {
                const id = $(this).data('id');
                const title = $(this).data('title');

                $('#delete-content-id').val(id);
                $('#delete-content-title').text(title);
            });

            // Tangani submit form hapus
            $('#form-delete-content').on('submit', function (e) {
                e.preventDefault();

                const id = $('#delete-content-id').val();
                const url = `konten/${id}`; // Sesuaikan dengan route
                const $btn = $('#btn-delete-content');

                $btn.prop('disabled', true).text('Menghapus...');

                $.ajax({
                    url: url,
                    method: 'delete',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        $('#modal-delete-content').modal('hide');
                        contentTable.ajax.reload(); // Pastikan ini variabel datatable kamu
                        alert('Konten berhasil dihapus!');
                    },
                    error: function () {
                        alert('Gagal menghapus konten.');
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('Hapus');
                    }
                });
            });
        });
    </script>
    {{-- End Content Delete Script --}}
@endpush