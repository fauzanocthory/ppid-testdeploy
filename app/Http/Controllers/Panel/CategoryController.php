<?php


namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('panel.pages.categories.index');
    }

    public function data(Request $request)
    {
        $query = Category::query();
        return DataTables::of($query)
            ->addColumn('action', function ($category) use ($request) {

                return <<<HTML
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-update-category" data-id="{$category->id}" data-name="{$category->name}" data-description="{$category->description}">Edit</button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-category" data-id="{$category->id}" data-name="{$category->name}">Hapus</button>
                    HTML;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan.']);
        }

        return redirect()->route('panel.category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Kategori berhasil diperbarui.']);
        }
        return redirect()->route('panel.category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus.']);
        }
        return redirect()->route('panel.category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
