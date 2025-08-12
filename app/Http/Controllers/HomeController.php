<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $informasiSertaMertaCategory = Category::where('slug', 'informasi-serta-merta')->first();

        $informasiSertaMertaContents = collect(); // default kosong

        if ($informasiSertaMertaCategory) {
            $informasiSertaMertaContents = Content::where('category_id', $informasiSertaMertaCategory->id)
                ->select('id', 'title', 'slug')
                ->limit(10)
                ->get();
        }

        return view('pages.home', compact('informasiSertaMertaCategory', 'informasiSertaMertaContents'));
    }



    public function show($categorySlug, $contentSlug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        $informasiSertaMertaCategory = Category::where('slug', 'informasi-serta-merta')->firstOrFail();
        $informasiSertaMertaContents = Content::where('category_id', $informasiSertaMertaCategory->id)->select('id', 'title', 'slug')->limit(5)->get();

        // Cari konten berdasarkan slug DAN kategori_id
        $content = Content::with(['attachments', 'hyperlinks', 'embeds'])
            ->where('slug', $contentSlug)
            ->where('category_id', $category->id)
            ->firstOrFail();
        return view('pages.content', compact('content', 'category', 'informasiSertaMertaCategory', 'informasiSertaMertaContents'));
    }

    public function contentByCategory($categorySlug, Request $request)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        $contents = collect();
        $hasNext = false;
        $search = trim($request->query('search', ''));
        $page = 1;
        if ($category) {
            $perPage = 5;
            $page = max(1, (int) $request->query('page', 1));
            $skip = ($page - 1) * $perPage;

            $query = Content::where('category_id', $category->id)
                ->select('id', 'title', 'slug', 'description', 'body', 'created_at')
                ->orderBy('created_at', 'desc');

            // Filter kalau ada search
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            }

            $query = $query->skip($skip)
                ->take($perPage + 1) // ambil 1 lebih banyak untuk cek Next
                ->get();

            $hasNext = $query->count() > $perPage;
            $contents = $query->take($perPage);
        }

        // Tetap load "Informasi Serta Merta" max 10
        $informasiSertaMertaCategory = Category::where('slug', 'informasi-serta-merta')->first();
        $informasiSertaMertaContents = collect();

        if ($informasiSertaMertaCategory) {
            $informasiSertaMertaContents = Content::where('category_id', $informasiSertaMertaCategory->id)
                ->select('id', 'title', 'slug')
                ->limit(10)
                ->get();
        }

        return view('pages.content_by_category', compact(
            'contents',
            'category',
            'informasiSertaMertaCategory',
            'informasiSertaMertaContents',
            'page',
            'hasNext',
            'search'
        ));
    }


}
