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
                        <h1 class="m-0">Kategori</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $backUrl }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-create-category">Buat Kategori
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="category-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Slug</th>
                                            <th>Aksi</th>
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
    {{-- Start Modal Create Category --}}
    <div class="modal fade" id="modal-create-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('panel.categories.store') }}" method="post" id="form-create-category">
                            @csrf
                            <div class="form-group">
                                <label class="required">Nama Kategori</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Kategori"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" id="" class="form-control"
                                    placeholder="Masukkan Deskripsi..."></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" form="form-create-category"
                        id="btn-create-category">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- End Modal Create Category --}}

    {{-- Start Modal Update Category --}}
    <div class="modal fade" id="modal-update-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" id="form-update-category">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="update-category-id">
                            <div class="form-group">
                                <label class="required">Nama Kategori</label>
                                <input type="text" id="update-category-name" class="form-control" name="name"
                                    placeholder="Masukkan Nama Kategori" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" id="update-category-description" class="form-control"
                                    placeholder="Masukkan Deskripsi..."></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" form="form-update-category"
                        id="btn-update-category">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- End Modal Update Category --}}
    {{-- Start Modal Delete Category --}}
    <!-- Modal Delete Category -->
    <div class="modal fade" id="modal-delete-category" tabindex="-1" aria-labelledby="deleteCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-category" method="POST">
                @csrf
                <input type="hidden" name="id" id="delete-category-id">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin ingin menghapus kategori <strong id="delete-category-name"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="btn-delete-category">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Delete Category --}}
@endpush

@push('lower_scripts')
    <script src="{{asset('assets/panel/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{asset('assets/panel/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function () {
            window.categoryTable = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('panel.categories.data') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'slug', name: 'slug' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                language: {
                    url: '{{ asset('assets/panel/custom/datatables/id.json')}}'
                }
            });
        });
    </script>

    <script>
        $(function () {
            // Inisialisasi validasi
            const $form = $('#form-create-category');

            $form.validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Nama kategori wajib diisi.",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Tangani tombol simpan (di luar form)
            $('#btn-create-category').on('click', function () {
                $('.form-group').each(function () {
                    $(this).find('.invalid-feedback').remove();
                    $(this).find('.is-invalid').removeClass('is-invalid');
                });
                if (!$form.valid()) return;

                let $btn = $(this);
                let formData = $form.serialize();

                $btn.prop('disabled', true).text('Menyimpan...');

                $.ajax({
                    url: $form.attr('action'),
                    method: $form.attr('method'),
                    data: formData,
                    success: function (res) {
                        alert('Kategori berhasil disimpan!');
                        $('#modal-create-category').modal('hide');
                        categoryTable.ajax.reload();
                    },
                    error: function (xhr) {
                        let res = xhr.responseJSON;
                        if (res && res.errors) {
                            $.each(res.errors, function (field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                            });
                        } else {
                            alert('Terjadi kesalahan. Coba lagi.');
                        }
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('Simpan');
                    }
                });
            });
        });
    </script>

    {{-- Start Category Update Script --}}
    <script>
        $(function () {
            const $form = $('#form-update-category');

            // Validasi form
            $form.validate({
                rules: {
                    name: { required: true },
                },
                messages: {
                    name: { required: "Nama kategori wajib diisi." },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Set data ke modal saat tombol Edit diklik
            $(document).on('click', '[data-toggle="modal"][data-target="#modal-update-category"]', function () {
                const $btn = $(this);
                $('#update-category-id').val($btn.data('id'));
                $('#update-category-name').val($btn.data('name'));
                $('#update-category-description').val($btn.data('description'));
            });

            // Tombol update diklik
            $('#btn-update-category').on('click', function () {

                $('.form-group').each(function () {
                    $(this).find('.invalid-feedback').remove();
                    $(this).find('.is-invalid').removeClass('is-invalid');
                });

                if (!$form.valid()) return;

                let $btn = $(this);
                let id = $('#update-category-id').val();
                let url = `kategori/${id}`;
                let formData = $form.serialize();

                $btn.prop('disabled', true).text('Menyimpan...');

                $.ajax({
                    url: url,
                    method: 'PUT', // Karena pakai @method('PUT') di dalam form
                    data: formData,
                    success: function () {
                        alert('Kategori berhasil diperbarui!');
                        categoryTable.ajax.reload();
                    },
                    error: function (xhr) {
                        let res = xhr.responseJSON;
                        if (res && res.errors) {
                            $.each(res.errors, function (field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                            });
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    },
                    complete: function () {
                        $('#modal-update-category').modal('hide');
                        $btn.prop('disabled', false).text('Simpan Perubahan');
                    }
                });
            });
        });
    </script>
    {{-- End Category Update Script --}}

    {{-- Start Category Delete Script --}}
    <script>
        $(function () {
            // Tangani klik tombol hapus
            $('#category-table').on('click', '[data-target="#modal-delete-category"]', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#delete-category-id').val(id);
                $('#delete-category-name').text(name);

            });

            // Tangani submit form hapus
            $('#form-delete-category').on('submit', function (e) {
                e.preventDefault();

                const id = $('#delete-category-id').val();
                const url = `kategori/${id}`;
                const $btn = $('#btn-delete-category');

                $btn.prop('disabled', true).text('Menghapus...');

                $.ajax({
                    url: url,
                    method: 'delete',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        $('#modal-delete-category').modal('hide');
                        categoryTable.ajax.reload();
                        alert('Kategori berhasil dihapus!');
                    },
                    error: function () {
                        alert('Gagal menghapus kategori.');
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('Hapus');
                    }
                });
            });
        });
    </script>

    {{-- End Category Delete Script --}}

@endpush