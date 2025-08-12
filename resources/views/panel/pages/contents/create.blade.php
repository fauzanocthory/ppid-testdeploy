@extends('panel.layouts.app')
@php
    $dashboardUrl = url()->to(Request::segment(1) . '/');
    $backUrl = url()->to(Request::segment(1) . '/' . Request::segment(2) . '/');
@endphp

@push('lower_styles')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/summernote/summernote-bs4.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Konten</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $dashboardUrl }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ $backUrl }}">Konten</a></li>
                            <li class="breadcrumb-item active">Tambah Konten</li>
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
                                <a href="{{ $backUrl }}" class="btn btn-outline-primary"><i
                                        class="fas fa-arrow-left fa-xs"></i> &nbsp;Konten
                                </a>
                            </div>
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-warning alert-dismissible pb-0">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5>Error!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form id="form-create-article" action="{{ route('panel.contents.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="card p-3 col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                                            <!-- Judul -->
                                            <div class="form-group">
                                                <label for="title">Judul <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>


                                            <!-- Deskripsi -->
                                            <div class="form-group">
                                                <label for="description">Deskripsi Singkat</label>
                                                <textarea name="description" id="description" class="form-control"
                                                    rows="3">{{ old('description') }}</textarea>
                                            </div>

                                            <!-- Body -->
                                            <div class="form-group">
                                                <label for="body">Isi Konten</label>
                                                <textarea name="body" id="body"
                                                    class="form-control">{{ old('body') }}</textarea>
                                            </div>

                                            <!-- Thumbnail -->
                                            <div class="form-group">
                                                <label for="thumbnail">Thumbnail</label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                            </div>
                                        </div>
                                        <div class="card p-3 col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                            <!-- Kategori -->
                                            <div class="form-group">
                                                <label for="category_id">Kategori <span class="text-danger">*</span></label>
                                                <select name="category_id" id="category_id" class="form-control" required>
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="attachment">Attachment</label>
                                                <div id="attachment-wrapper">
                                                    <div class="attachment-group mb-2">
                                                        <input type="text" name="attachments[0][name]"
                                                            class="form-control mb-1" placeholder="Nama Lampiran">
                                                        <input type="file" name="attachments[0][file]"
                                                            class="form-control mb-1">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-attachment">Hapus</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    id="add-attachment">Tambah Attachment</button>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="hyperlink">Link/URL Keluar</label>
                                                <div id="hyperlink-wrapper">
                                                    <div class="hyperlink-group mb-2">
                                                        <input type="text" name="hyperlinks[0][url]"
                                                            class="form-control mb-1" placeholder="URL">
                                                        <input type="text" name="hyperlinks[0][label]"
                                                            class="form-control mb-1" placeholder="Label">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    id="add-hyperlink">Tambah Link</button>

                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="embed">Embed</label>
                                                <div id="embed-wrapper">
                                                    <div class="embed-group mb-2">
                                                        <input type="text" name="embeds[0][url]" class="form-control mb-1"
                                                            placeholder="URL">
                                                        <input type="text" name="embeds[0][title]" class="form-control mb-1"
                                                            placeholder="Judul">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm" id="add-embed">Tambah
                                                    Embed</button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" id="btn-create-article"
                                            class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
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

@push('lower_scripts')
    <!-- Summernote -->
    <script src="{{ asset('assets/panel/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $(function () {
            // Summernote
            $('#body').summernote({
                height: 500,
                fontNames: ['Poppins', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                fontNamesIgnoreCheck: ['Poppins'], // supaya font Poppins tetap muncul walau tidak terdeteksi
                callbacks: {
                    onInit: function () {
                        // set default font ke Poppins
                        $('#summernote').summernote('fontName', 'Poppins');
                    }
                },
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            })
        })

        // Hyperlink
        let hyperlinkIndex = 1;

        $('#add-hyperlink').on('click', function () {
            const html = `
                                                                                    <div class="hyperlink-group mb-2">
                                                                                        <input type="text" name="hyperlinks[${hyperlinkIndex}][url]" class="form-control mb-1" placeholder="URL">
                                                                                        <input type="text" name="hyperlinks[${hyperlinkIndex}][label]" class="form-control mb-1" placeholder="Judul">
                                                                                        <button type="button" class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                                                    </div>
                                                                                `;
            $('#hyperlink-wrapper').append(html);
            hyperlinkIndex++;
        });

        $(document).on('click', '.remove-link', function () {
            $(this).closest('.hyperlink-group').remove();
        });

        // Embed
        let embedIndex = 1;

        $('#add-embed').on('click', function () {
            const html = `
                                                                                    <div class="embed-group mb-2">
                                                                                        <input type="text" name="embeds[${embedIndex}][url]" class="form-control mb-1" placeholder="URL">
                                                                                        <input type="text" name="embeds[${embedIndex}][title]" class="form-control mb-1" placeholder="Judul">
                                                                                        <button type="button" class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                                                    </div>`;
            $('#embed-wrapper').append(html);
            embedIndex++;
        });

        $(document).on('click', '.remove-link', function () {
            $(this).closest('.embed-group').remove();
        });

        // Attachment
        // Attachment
        let attachmentIndex = 1;

        $('#add-attachment').on('click', function () {
            const html = `
                                                            <div class="attachment-group mb-2">
                                                                <input type="text" name="attachments[${attachmentIndex}][name]" class="form-control mb-1" placeholder="Nama Lampiran">
                                                                <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control mb-1">
                                                                <button type="button" class="btn btn-danger btn-sm remove-attachment">Hapus</button>
                                                            </div>`;
            $('#attachment-wrapper').append(html);
            attachmentIndex++;
        });

        $(document).on('click', '.remove-attachment', function () {
            $(this).closest('.attachment-group').remove();
        });


    </script>
@endpush