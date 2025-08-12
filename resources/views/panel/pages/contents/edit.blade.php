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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Konten</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $dashboardUrl }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ $backUrl }}">Konten</a></li>
                            <li class="breadcrumb-item active">Edit Konten</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ $backUrl }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left fa-xs"></i> &nbsp;Konten
                                </a>
                            </div>
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-warning alert-dismissible pb-0">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5>Error!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('panel.contents.update', $content->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="card p-3 col-lg-8">
                                            <!-- Judul -->
                                            <div class="form-group">
                                                <label>Judul <span class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title', $content->title) }}">
                                            </div>

                                            <!-- Deskripsi -->
                                            <div class="form-group">
                                                <label>Deskripsi Singkat</label>
                                                <textarea name="description" class="form-control"
                                                    rows="3">{{ old('description', $content->description) }}</textarea>
                                            </div>

                                            <!-- Body -->
                                            <div class="form-group">
                                                <label>Isi Konten</label>
                                                <textarea name="body" id="body"
                                                    class="form-control">{{ old('body', $content->body) }}</textarea>
                                            </div>

                                            <!-- Thumbnail -->
                                            <div class="form-group">
                                                <label>Thumbnail</label>
                                                @if($content->thumbnail)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $content->thumbnail) }}"
                                                            class="img-thumbnail" style="max-height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="thumbnail" class="form-control">
                                            </div>
                                        </div>

                                        <div class="card p-3 col-lg-4">
                                            <!-- Kategori -->
                                            <div class="form-group">
                                                <label>Kategori <span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $content->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Lampiran Lama -->
                                            <div class="form-group">
                                                <label>Lampiran Lama</label>
                                                @if($content->attachments && $content->attachments->count())
                                                    <ul class="list-group mb-2" id="old-attachments">
                                                        @foreach($content->attachments as $att)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                <a href="{{ asset('storage/' . $att->filepath) }}"
                                                                    target="_blank">{{ $att->filename }}</a>
                                                                <button type="button" class="btn btn-sm btn-danger btn-remove-old"
                                                                    data-id="{{ $att->id }}">
                                                                    &times;
                                                                </button>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-muted">Tidak ada lampiran lama</p>
                                                @endif
                                            </div>

                                            <!-- Tempat simpan ID lampiran yang dihapus -->
                                            <input type="hidden" name="deleted_attachments" id="deleted_attachments">



                                            <!-- Tambah Attachment Baru -->
                                            <div class="form-group">
                                                <label>Tambah Lampiran Baru</label>
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
                                                    id="add-attachment">Tambah Lampiran</button>
                                            </div>

                                            <hr>

                                            <!-- Hyperlink -->
                                            <div class="form-group">
                                                <label>Link/URL Keluar</label>
                                                <div id="hyperlink-wrapper">
                                                    @foreach(old('hyperlinks', $content->hyperlinks ?? [['url' => '', 'label' => '']]) as $i => $link)
                                                        <div class="hyperlink-group mb-2">
                                                            <input type="text" name="hyperlinks[{{ $i }}][url]"
                                                                class="form-control mb-1" value="{{ $link['url'] ?? '' }}"
                                                                placeholder="URL">
                                                            <input type="text" name="hyperlinks[{{ $i }}][label]"
                                                                class="form-control mb-1" value="{{ $link['label'] ?? '' }}"
                                                                placeholder="Label">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    id="add-hyperlink">Tambah Link</button>
                                            </div>

                                            <hr>

                                            <!-- Embed -->
                                            <div class="form-group">
                                                <label>Embed</label>
                                                <div id="embed-wrapper">
                                                    @foreach(old('embeds', $content->embeds ?? [['url' => '', 'title' => '']]) as $i => $embed)
                                                        <div class="embed-group mb-2">
                                                            <input type="text" name="embeds[{{ $i }}][url]"
                                                                class="form-control mb-1" value="{{ $embed['url'] ?? '' }}"
                                                                placeholder="URL">
                                                            <input type="text" name="embeds[{{ $i }}][title]"
                                                                class="form-control mb-1" value="{{ $embed['title'] ?? '' }}"
                                                                placeholder="Judul">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm" id="add-embed">Tambah
                                                    Embed</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('lower_scripts')
    <!-- Summernote -->
    <script src="{{ asset('assets/panel/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>

        $(function () {
            let deletedAttachments = [];

            $(document).on('click', '.btn-remove-old', function () {
                let id = $(this).data('id');

                // Tambahkan ID ke array penghapusan
                deletedAttachments.push(id);
                $('#deleted_attachments').val(deletedAttachments.join(','));

                // Hapus elemen dari DOM
                $(this).closest('li').remove();
            });
        });

        $(function () {
            // Summernote
            $('#body').summernote({
                height: 500,
                fontNames: ['Poppins', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                fontNamesIgnoreCheck: ['Poppins'],
                callbacks: {
                    onInit: function () {
                        $('#body').summernote('fontName', 'Poppins');
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
            });

            // Ambil jumlah existing hyperlink dari blade
            let hyperlinkIndex = {{ isset($content->hyperlinks) ? count($content->hyperlinks) : 0 }};
            $('#add-hyperlink').on('click', function () {
                const html = `
                                                                <div class="hyperlink-group mb-2">
                                                                    <input type="text" name="hyperlinks[${hyperlinkIndex}][url]" class="form-control mb-1" placeholder="URL">
                                                                    <input type="text" name="hyperlinks[${hyperlinkIndex}][label]" class="form-control mb-1" placeholder="Judul">
                                                                    <button type="button" class="btn btn-danger btn-sm remove-link">Hapus</button>
                                                                </div>`;
                $('#hyperlink-wrapper').append(html);
                hyperlinkIndex++;
            });
            $(document).on('click', '.remove-link', function () {
                $(this).closest('.hyperlink-group').remove();
            });

            // Embed
            let embedIndex = {{ isset($content->embeds) ? count($content->embeds) : 0 }};
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
            let attachmentIndex = {{ isset($content->attachments) ? count($content->attachments) : 0 }};
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
        });
    </script>
@endpush