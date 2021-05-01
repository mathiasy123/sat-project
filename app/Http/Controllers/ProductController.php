<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;

// Models
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();

        return view('pages.admins.product.index', [
            'title' => 'Produk',
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.admins.product.create', [
            'title' => 'Produk',
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $productRequests = $this->generateCode(new Product(), $request->validated());

        Product::create($productRequests);

        return redirect()
                ->route('admins.products.index')
                ->with('alert-store-success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->with('category')->first();
        
        if($product) {
            return view('pages.admins.product.edit', [
                'title' => 'Kategori',
                'categories' => $categories,
                'product' => $product
            ]);
        }

        return redirect()
                ->back()
                ->with('alert-not-found', 'Produk ini tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->validated());

        return redirect()
                ->route('admins.products.index')
                ->with('alert-update-success', 'Produk berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product) {
            if($product->galleries()->count()) {
                return redirect()
                        ->back()
                        ->with('alert-restricted', 'Produk ini masih memiliki gambar produk, harap hapus semua gambar produk yang dimiliki oleh produk ini.');
            }

            $product->delete();

            return redirect()
                ->back()
                ->with('alert-delete-success', 'Produk berhasil dihapus.');
        }

        return redirect()
                ->back()
                ->with('alert-not-found', 'Produk ini tidak ditemukan.');
    }

    public function showGalleries($id) {
        $product = Product::find($id, ['name']);
        $galleries = ProductGallery::with('product')->where('product_id', $id)->get();

        return view('pages.admins.product.show-galleries', [
            'title' => 'Produk',
            'product' => $product,
            'galleries' => $galleries
        ]);
    }

    public function generateCode($productModel, $productRequests) {
        $recentProductCode = $productModel::orderBy('created_at', 'desc')->first();
	
		$lastIncrementDigits = $recentProductCode ? substr($recentProductCode->code, -4) : 0;
		
		$productRequests['code'] = 'PRD' . str_pad($lastIncrementDigits + 1, 4, 0, STR_PAD_LEFT);

        return $productRequests;
    }
}
