<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;

use Illuminate\Database\QueryException;

// Models
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('pages.admins.category.index', [
            'title' => 'Kategori',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admins.category.create', ['title' => 'Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $categoryRequests = $this->generateCode(new Category(), $request->validated());

        Category::create($categoryRequests);

        return redirect()
                ->route('admins.categories.index')
                ->with('alert-store-success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if($category) {
            return view('pages.admins.category.edit', [
                'title' => 'Kategori',
                'category' => $category
            ]);
        }

        return redirect()
                ->back()
                ->with('alert-not-found', 'Kategori ini tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $category->update($request->validated());

        return redirect()
                ->route('admins.categories.index')
                ->with('alert-update-success', 'Kategori berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category) {
            if($category->products()->count()) {
                return redirect()
                        ->back()
                        ->with('alert-restricted', 'Kategori ini masih memiliki produk, harap hapus semua produk yang dimiliki oleh kategori ini.');
            }

            $category->delete();

            return redirect()
                ->back()
                ->with('alert-delete-success', 'Kategori ini berhasil dihapus.');
        }

        return redirect()
                ->back()
                ->with('alert-not-found', 'Kategori ini tidak ditemukan.');
    }

    public function generateCode($categoryModel, $categoryRequests) {
        $recentCategoryCode = $categoryModel::orderBy('created_at', 'DESC')->first();
	
		$lastIncrementDigits = $recentCategoryCode ? substr($recentCategoryCode->code, -4) : 0;
		
		$categoryRequests['code'] = 'KTG' . str_pad($lastIncrementDigits + 1, 4, 0, STR_PAD_LEFT);

        return $categoryRequests;
    }
}
