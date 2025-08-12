<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ContentController extends Controller
{
    public function index()
    {
        return view('panel.pages.contents.index');
    }

    public function data(Request $request)
    {
        $query = Content::select('contents.*', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'contents.category_id')
            ->with(['embeds', 'hyperlinks', 'attachments']);

        return DataTables::of($query)
            ->editColumn('category_name', function ($content) {
                return e($content->category_name);
            })
            ->addColumn('action', function ($content) {
                $url = route('contents.show', [
                    'categorySlug' => $content->category->slug ?? '',
                    'contentSlug' => $content->slug
                ]);
                $editUrl = route('panel.contents.edit', $content->id);
                return <<<HTML
                <a class="btn btn-sm btn-info" href="{$url}" target="_blank">Lihat</a>
                <a class="btn btn-sm btn-warning" href="{$editUrl}">Edit</a>
                <button class="btn btn-sm btn-danger" 
                        data-toggle="modal" 
                        data-target="#modal-delete-content"
                        data-id="{$content->id}"
                        data-title="{$content->title}">
                    Hapus
                </button>
            HTML;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        $categories = Category::all();
        return view('panel.pages.contents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'body' => 'nullable|string',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'body.string' => 'Isi konten harus berupa teks.',
        ]);

        $data = $request->only(['title', 'description', 'body', 'category_id']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            if (!$file->isValid()) {
                throw new \Exception('File upload tidak valid');
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file menggunakan Storage::put()
            $path = 'thumbnails/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));

            $data['thumbnail'] = $path;
        }




        $content = Content::create($data);
        // Simpan relasi tambahan jika ada
        if ($request->has('embeds')) {
            foreach ($request->input('embeds') as $embed) {
                if (!empty($embed['url'])) {
                    $content->embeds()->create(
                        [
                            'url' => $embed['url'],
                            'title' => $embed['title']
                        ]
                    );
                }
            }
        }

        if ($request->has('hyperlinks')) {

            foreach ($request->input('hyperlinks') as $link) {
                if (!empty($link['url'])) {
                    $content->hyperlinks()->create([
                        'url' => $link['url'],
                        'label' => $link['label'] ?? null,
                    ]);
                }
                ;
            }
        }


        if ($request->has('attachments')) {
            foreach ($request->attachments as $att) {
                if (!empty($att['file'])) {
                    $file = $att['file'];
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = 'attachments/' . $filename;
                        Storage::disk('public')->put($path, file_get_contents($file));

                        $content->attachments()->create([
                            'filename' => $att['name'] ?? $file->getClientOriginalName(),
                            'filepath' => $path,
                            'filetype' => $file->getClientMimeType(),
                        ]);
                    }
                }
            }
        }



        return redirect()->route('panel.contents.index')->with('success', 'Content created successfully.');
    }

    public function show(Content $content)
    {
        $content->load(['embeds', 'hyperlinks', 'attachments']);
        return view('panel.pages.contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        $categories = Category::all();
        $content->load(['category', 'embeds', 'hyperlinks', 'attachments']);
        return view('panel.pages.contents.edit', compact('categories', 'content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'body' => 'nullable|string',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'body.string' => 'Isi konten harus berupa teks.',
        ]);

        $data = $request->only(['title', 'description', 'body', 'category_id']);

        // Jika ada thumbnail baru
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            if (!$file->isValid()) {
                throw new \Exception('File upload tidak valid');
            }

            // Hapus thumbnail lama
            if ($content->thumbnail && Storage::disk('public')->exists($content->thumbnail)) {
                Storage::disk('public')->delete($content->thumbnail);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'thumbnails/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['thumbnail'] = $path;
        }

        // Update konten
        $content->update($data);

        // Update embeds
        $content->embeds()->delete();
        if ($request->has('embeds')) {
            foreach ($request->input('embeds') as $embed) {
                if (!empty($embed['url'])) {
                    $content->embeds()->create([
                        'url' => $embed['url'],
                        'title' => $embed['title']
                    ]);
                }
            }
        }

        // Update hyperlinks
        $content->hyperlinks()->delete();
        if ($request->has('hyperlinks')) {
            foreach ($request->input('hyperlinks') as $link) {
                if (!empty($link['url'])) {
                    $content->hyperlinks()->create([
                        'url' => $link['url'],
                        'label' => $link['label'] ?? null,
                    ]);
                }
            }
        }


        // Hapus attachments lama
        $deletedAttachments = array_filter(explode(',', $request->deleted_attachments));

        foreach ($deletedAttachments as $attachmentId) {
            $attachment = $content->attachments()->find($attachmentId);
            if ($attachment) {
                // Hapus file fisik
                if (Storage::disk('public')->exists($attachment->filepath)) {
                    Storage::disk('public')->delete($attachment->filepath);
                }
                // Hapus dari database
                $attachment->delete();
            }
        }


        // Upload attachments baru (jika ada)
        if ($request->has('attachments')) {
            foreach ($request->attachments as $att) {
                if (!empty($att['file'])) {
                    $file = $att['file'];
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = 'attachments/' . $filename;
                        Storage::disk('public')->put($path, file_get_contents($file));

                        $content->attachments()->create([
                            'filename' => $att['name'] ?? $file->getClientOriginalName(),
                            'filepath' => $path,
                            'filetype' => $file->getClientMimeType(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('panel.contents.index')->with('success', 'Content updated successfully.');
    }


    public function destroy(Request $request, $id)
    {
        $content = Content::with(['embeds', 'hyperlinks', 'attachments'])->findOrFail($id);

        // Hapus file thumbnail jika ada
        if ($content->thumbnail && Storage::disk('public')->exists($content->thumbnail)) {
            Storage::disk('public')->delete($content->thumbnail);
        }

        // Hapus attachments beserta file fisiknya
        foreach ($content->attachments as $attachment) {
            if ($attachment->filepath && Storage::disk('public')->exists($attachment->filepath)) {
                Storage::disk('public')->delete($attachment->filepath);
            }
            $attachment->delete();
        }

        // Hapus relasi lainnya
        $content->embeds()->delete();
        $content->hyperlinks()->delete();

        // Terakhir hapus konten utama
        $content->delete();

        if ($request->ajax()) {
            return response()->json(['success' => 'Content deleted successfully.']);
        }
        return redirect()->route('panel.contents.index')->with('success', 'Content deleted successfully.');
    }

}
